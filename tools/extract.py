"""Turn the Webflow export into the theme's content files.

For every public page it writes a manifest (title, search fields, the order of the page's
parts) and one HTML fragment per section. The parts every page shares -- preloader,
navigation, WhatsApp badge, footer -- are written once, under content/site/, after
proving they are identical on every page that has them.

Cleaning applied to all markup:
  * links to pages become {{page:<slug>}} and images {{theme}}/images/..., resolved by the
    theme at render time (pages are found by their content key, so a renamed slug keeps
    working);
  * Webflow's editor attributes (data-wf-*, data-w-id) and the "current page" markers are
    removed (the theme marks the current link itself);
  * misspelt class and id names are corrected (see common.py).

Run:  python tools/extract.py
"""

from __future__ import annotations

import copy
import hashlib
import re
import shutil
import sys
from collections import defaultdict
from pathlib import Path

from lxml import html

sys.path.insert(0, str(Path(__file__).parent))
from common import (  # noqa: E402
    ASSETS,
    CLASS_RENAMES,
    CONTENT,
    ID_RENAMES,
    NOT_PUBLIC,
    REFERENCE,
    SLUG_FIXES,
    TEMPLATES,
    asset_filename,
    parse,
    public_pages,
    slug_for,
    write_json,
)

# Shared parts, recognised by a CSS selector on a direct child of the page body.
SITE_PARTS = {
    "preloader": "section.preloader",
    "navbar": "div.navbar",
    "whatsapp": "a.whatsapp",
}
WRAPPERS = ("page-main", "page-wrap")
URL_ATTRS = ("href", "src", "data-src", "poster", "action")

# Parts of a section the theme fills itself at render time: the element is replaced by a
# {{<name>}} placeholder and the manifest item lists the slot.
SLOTS = {
    "posts": "div.w-dyn-list",
}

# Scripts a page needs: the markup that needs the script, and -- where the original site
# loaded the script on some pages only -- a phrase from that script, so a feature runs
# exactly where it ran before (the Microsoft 365 page has feature cards but no script).
FEATURES = {
    "swiper": (".swiper-container", None),
    "list-scroll": (".list-scroll", None),
    "overlapping-cards": (".overlapping-cards", "overlapping-cards.js"),
    "feature-scroll": (".split-section .feature-card", ("feature-card", "split-section.js")),
    "accordion": (".accordion", None),
    "contact-form": ("form", None),
}


class Extractor:
    def __init__(self) -> None:
        self.images: set[str] = set()
        self.problems: list[str] = []
        self.site_parts: dict[str, dict[str, list[str]]] = defaultdict(lambda: defaultdict(list))
        self.tags: dict[str, set[str]] = defaultdict(set)

    # --- cleaning -------------------------------------------------------------

    def clean(self, el: html.HtmlElement, page: str) -> html.HtmlElement:
        el = copy.deepcopy(el)
        # Embedded <style> blocks are compiled into site.css (build_css.py) and embedded
        # <script> blocks are rewritten as the theme's own scripts (assets/js/), so the
        # content carries neither -- nor the designer's HTML comments.
        for node in el.xpath(".//style | .//script | .//comment()"):
            node.drop_tree()
        # Forms post to WordPress: the theme fills in the address and the hidden fields.
        for form in el.iter("form"):
            form.set("method", "post")
            form.set("action", "{{form-action}}")
            form.text = "{{form-fields}}" + (form.text or "")
        for node in el.iter():
            if not isinstance(node.tag, str):
                continue
            for attr in list(node.attrib):
                if attr.startswith(("data-wf-", "fs-")) or attr in ("data-w-id", "aria-current", "bind", "sym-bind"):
                    del node.attrib[attr]
            classes = [c for c in (node.get("class") or "").split() if c != "w--current"]
            classes = [CLASS_RENAMES.get(c, c) for c in classes]
            if classes:
                node.set("class", " ".join(classes))
            elif "class" in node.attrib:
                del node.attrib["class"]
            if node.get("id") in ID_RENAMES:
                node.set("id", ID_RENAMES[node.get("id")])
            for attr in URL_ATTRS:
                if node.get(attr) is not None:
                    node.set(attr, self.url(node.get(attr), page))
            if node.get("srcset"):
                node.set("srcset", ", ".join(self.srcset_item(i, page) for i in node.get("srcset").split(",")))
            if node.get("style") and "images/" in node.get("style"):
                node.set("style", re.sub(r"url\((['\"]?)images/([^'\")]+)", lambda m: f"url({m.group(1)}{{{{theme}}}}/images/{asset_filename(m.group(2))}", node.get("style")))
            self.tags[node.tag].update(node.attrib.keys())
        return el

    def srcset_item(self, item: str, page: str) -> str:
        parts = item.strip().split()
        parts[0] = self.url(parts[0], page)
        return " ".join(parts)

    def url(self, value: str, page: str) -> str:
        value = value.strip()
        if value.startswith("images/"):
            name = asset_filename(value.split("?")[0][len("images/"):])
            self.images.add(name)
            return "{{theme}}/images/" + name
        match = re.fullmatch(r"([\w-]+\.html)(#[\w-]*)?", value)
        if match:
            target, anchor = match.group(1), match.group(2) or ""
            anchor = "#" + ID_RENAMES.get(anchor[1:], anchor[1:]) if anchor else ""
            if target in NOT_PUBLIC:
                self.problems.append(f"{page}: link to non-public page {value}")
                return "{{page:}}" + anchor
            if not (REFERENCE / target).exists():
                self.problems.append(f"{page}: link to missing page {value}")
            return "{{page:" + SLUG_FIXES.get(target, target[:-5]) + "}}" + anchor
        if value.startswith("#") and value[1:] in ID_RENAMES:
            return "#" + ID_RENAMES[value[1:]]
        return value

    # --- serialising ----------------------------------------------------------

    @staticmethod
    def serialise(el: html.HtmlElement, indent: str) -> str:
        """Outer HTML with the export's own indentation, shifted to column 0."""
        el = copy.deepcopy(el)
        el.tail = None
        text = html.tostring(el, encoding="unicode", method="html")
        lines = text.split("\n")
        out = [lines[0]]
        for line in lines[1:]:
            out.append(line[len(indent):] if line.startswith(indent) else line.lstrip(" ") if not line.strip() else line)
        return "\n".join(out).rstrip() + "\n"

    @staticmethod
    def indent_of(el: html.HtmlElement) -> str:
        prev = el.getprevious()
        before = prev.tail if prev is not None else el.getparent().text
        return (before or "").rsplit("\n", 1)[-1] if before and "\n" in before else ""

    # --- pages ----------------------------------------------------------------

    def site_part_name(self, el: html.HtmlElement) -> str | None:
        for name, selector in SITE_PARTS.items():
            if el in el.getparent().cssselect(":scope > " + selector):
                return name
        if el.cssselect(".fotter") and el.tag == "section":
            return "footer"
        return None

    @staticmethod
    def element_children(el: html.HtmlElement) -> list[html.HtmlElement]:
        return [c for c in el if isinstance(c.tag, str) and c.tag not in ("script", "style")]

    def items(self, container: html.HtmlElement, page: Path, key: str, state: dict) -> list[dict]:
        """The page tree below `container`: sections, the footer, and layout wrappers.

        The preloader, navigation and WhatsApp badge are fixed or hidden, so where they sit
        in the document changes nothing on screen: the theme prints them once, at the top
        of <body>, and they are only recorded here. The footer is in the flow (inside a
        flex wrapper on some pages), so it keeps its place in the tree.
        """
        out = []
        for child in self.element_children(container):
            if set((child.get("class") or "").split()) & set(WRAPPERS):
                out.append({"wrapper": {"tag": child.tag, "class": child.get("class")}, "items": self.items(child, page, key, state)})
                continue
            part = self.site_part_name(child)
            cleaned = self.clean(child, page.name)
            slots = self.cut_slots(cleaned)
            markup = self.serialise(cleaned, self.indent_of(child))
            if part == "footer":
                markup, surface = self.footer_surface(markup)
                self.site_parts[part][markup].append(page.name)
                out.append({"part": "footer", "surface": surface})
            elif part:
                self.site_parts[part][markup].append(page.name)
                state["parts"].add(part)
            else:
                state["n"] += 1
                rel = f"{state['folder']}/{key}/{state['n']:02d}.html"
                (CONTENT / rel).parent.mkdir(parents=True, exist_ok=True)
                (CONTENT / rel).write_text(markup, encoding="utf-8", newline="\n")
                out.append({"section": rel, "slots": slots} if slots else {"section": rel})
        return out

    @staticmethod
    def cut_slots(el: html.HtmlElement) -> list[str]:
        """Replaces each slot's element with its {{<name>}} placeholder; returns the names."""
        found = []
        for name, selector in SLOTS.items():
            for target in el.cssselect(selector):
                placeholder = "{{" + name + "}}" + (target.tail or "")
                previous = target.getprevious()
                if previous is not None:
                    previous.tail = (previous.tail or "") + placeholder
                else:
                    parent = target.getparent()
                    parent.text = (parent.text or "") + placeholder
                target.getparent().remove(target)
                found.append(name)
        return found

    def page(self, path: Path, key: str | None = None, folder: str = "pages") -> dict:
        """The manifest of a public page, or of a template page when `key` is given."""
        root = parse(path)
        body = root.find("body")
        slug = slug_for(path) if key is None else ""
        key = key or slug or "home"
        state = {"n": 0, "parts": set(), "folder": folder}
        items = self.items(body, path, key, state)
        chrome = "navbar" in state["parts"]
        missing = {"navbar", "whatsapp"} - state["parts"]
        if chrome and missing:
            self.problems.append(f"{path.name}: page has no {', '.join(sorted(missing))} (the theme prints it anyway)")
        scripts = " ".join((el.get("src") or "") + (el.text or "") for el in root.iter("script"))
        features = [
            name
            for name, (selector, phrase) in FEATURES.items()
            if body.cssselect(selector) and (phrase is None or any(p in scripts for p in ([phrase] if isinstance(phrase, str) else phrase)))
        ]
        settings = {}
        if "feature-scroll" in features:
            # The Microsoft 365 page's copy of the script slides faster, with GSAP's default ease.
            quick = "split-section.js" in scripts
            settings["feature-scroll"] = {"duration": 0.4 if quick else 0.6, "ease": "power1.out" if quick else "power2.inOut"}

        meta = lambda sel: (root.xpath(f"string({sel})") or "").strip()  # noqa: E731
        manifest = {
            "key": key,
            "slug": slug,
            "source": path.name,
            "title": meta("//title"),
            "description": meta('//meta[@name="description"]/@content'),
            "og_title": meta('//meta[@property="og:title"]/@content'),
            "og_description": meta('//meta[@property="og:description"]/@content'),
            "body_class": body.get("class") or "",
            "chrome": chrome,
            "preloader": "preloader" in state["parts"],
            "features": features,
            "settings": settings,
            "items": items,
        }
        if folder == "pages" and not manifest["description"]:
            self.problems.append(f"{path.name}: no meta description in the export")
        return manifest

    @staticmethod
    def footer_surface(markup: str) -> tuple[str, str]:
        """The footer sits on a white surface everywhere but the home page: a parameter."""
        lines = markup.split("\n", 2)
        surface = "c-surface-white" if ' c-surface-white"' in lines[1] else ""
        without = lines[1].replace(" c-surface-white", "")
        lines[1] = re.sub(r'(class="[^"]*)"', r'\1 {{surface}}"', without, count=1)
        return "\n".join(lines), surface

    # --- output ---------------------------------------------------------------

    def write_site_parts(self) -> None:
        for part, variants in self.site_parts.items():
            if len(variants) != 1:
                sizes = {hashlib.md5(m.encode()).hexdigest()[:6]: len(p) for m, p in variants.items()}
                raise SystemExit(f"site part '{part}' differs between pages: {sizes}")
            markup = next(iter(variants))
            (CONTENT / "site" / f"{part}.html").parent.mkdir(parents=True, exist_ok=True)
            (CONTENT / "site" / f"{part}.html").write_text(markup, encoding="utf-8", newline="\n")

    def copy_images(self) -> None:
        """Copies every picture the theme uses, under its clean name: those in the markup,
        those the stylesheets use as backgrounds (so build_css.py runs first), and the
        site icons."""
        dest = ASSETS / "images"
        sources: dict[str, Path] = {}
        for source in (REFERENCE / "images").iterdir():
            clean = asset_filename(source.name)
            if clean in sources:
                raise SystemExit(f"two pictures would share the name {clean}: {sources[clean].name}, {source.name}")
            sources[clean] = source
        in_css = {
            name
            for sheet in (ASSETS / "css").glob("*.css")
            for name in re.findall(r'url\("\.\./images/([^"]+)"\)', sheet.read_text(encoding="utf-8"))
        }
        if dest.exists():
            shutil.rmtree(dest)
        dest.mkdir(parents=True)
        for name in sorted(self.images | in_css | {"favicon.png", "webclip.jpg"}):
            if name not in sources:
                self.problems.append(f"missing image {name}")
                continue
            shutil.copy2(sources[name], dest / name)

    @staticmethod
    def write_redirects() -> None:
        """Old address -> content key, for every page whose address was corrected."""
        moved = {source[:-5]: slug for source, slug in SLUG_FIXES.items() if slug and source[:-5] != slug}
        write_json(CONTENT / "redirects.json", moved)

    def write_allowed_html(self) -> None:
        write_json(CONTENT / "allowed-html.json", {t: sorted(a) for t, a in sorted(self.tags.items())})


def swap_in(built: Path, live: Path) -> None:
    """Replaces the live content folder with the freshly built one in two renames, so the
    site never reads a half-written folder."""
    retired = live.with_name(live.name + ".old")
    if retired.exists():
        shutil.rmtree(retired)
    if live.exists():
        live.rename(retired)
    built.rename(live)
    if retired.exists():
        shutil.rmtree(retired)


def main() -> None:
    global CONTENT  # noqa: PLW0603 -- every writer below builds into the staging folder
    live = CONTENT
    CONTENT = live.with_name(live.name + ".next")
    if CONTENT.exists():
        shutil.rmtree(CONTENT)
    ex = Extractor()
    manifests = [ex.page(p) for p in public_pages()]
    for m in manifests:
        write_json(CONTENT / "pages" / f"{m['key']}.json", m)
    for source, key in TEMPLATES.items():
        write_json(CONTENT / "templates" / f"{key}.json", ex.page(REFERENCE / source, key, "templates"))
    ex.write_site_parts()
    ex.copy_images()
    ex.write_allowed_html()
    ex.write_redirects()
    swap_in(CONTENT, live)
    CONTENT = live
    sections = sum(1 for m in manifests for i in m["items"] if "section" in i)
    print(f"{len(manifests)} pages, {sections} sections, {len(ex.site_parts)} shared parts, {len(ex.images)} images")
    print(f"{len(ex.problems)} notes:")
    for p in ex.problems:
        print("  -", p)


if __name__ == "__main__":
    main()
