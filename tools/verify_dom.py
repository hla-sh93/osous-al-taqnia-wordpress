"""Compare every WordPress page with its Webflow source, element by element.

Both sides are reduced to the same stream -- each element's tag, classes and meaningful
attributes, and every piece of text -- after applying to the source exactly the cleaning
the theme is meant to apply (the extractor's own code), with links resolved to the local
site. The navigation, preloader and WhatsApp badge are compared once, apart from the page
flow, because the theme prints them at the top of <body>.

Run:  python tools/verify_dom.py [--base http://localhost:8100] [page.html ...]
Passing looks like:  0 of 66 pages differ
"""

from __future__ import annotations

import argparse
import difflib
import re
import sys
import urllib.request
from pathlib import Path

from lxml import html

sys.path.insert(0, str(Path(__file__).parent))
from common import CLASS_RENAMES, REFERENCE, public_pages, slug_for  # noqa: E402
from extract import SLOTS, Extractor  # noqa: E402

ATTRS = ("href", "src", "srcset", "alt", "id", "type", "name", "placeholder", "action", "method", "target", "for", "value", "role")
CHROME_CLASSES = {"preloader", "navbar", "whatsapp"}
IGNORED_CLASSES = {"w--current"}


def fetch(url: str) -> str:
    with urllib.request.urlopen(url, timeout=60) as response:  # noqa: S310 -- local site only
        return response.read().decode("utf-8")


def resolve(value: str, base: str, theme_url: str) -> str:
    value = value.replace("{{theme}}", theme_url)
    return re.sub(r"\{\{page:([a-z0-9-]*)\}\}", lambda m: f"{base}/{m.group(1)}/" if m.group(1) else f"{base}/", value)


def is_chrome(el) -> bool:
    return bool(set((el.get("class") or "").split()) & CHROME_CLASSES) and el.getparent() is not None and el.getparent().tag in ("body", "div") and (
        el.getparent().tag == "body" or set((el.getparent().get("class") or "").split()) & {"page-main", "page-wrap"}
    )


def stream(root, base: str, theme_url: str, resolve_placeholders: bool) -> tuple[list[str], list[str]]:
    """(page flow, chrome) as lists of tokens."""
    flow: list[str] = []
    chrome: list[str] = []

    def walk(el, out):
        if not isinstance(el.tag, str) or el.tag in ("script", "style", "noscript", "link"):
            return
        if out is flow and is_chrome(el):
            target = chrome
        else:
            target = out
        classes = " ".join(sorted(c for c in (el.get("class") or "").split() if c not in IGNORED_CLASSES))
        attrs = []
        for a in ATTRS:
            v = el.get(a)
            if v is not None:
                v = " ".join(v.split())
                if resolve_placeholders:
                    v = resolve(v, base, theme_url)
                attrs.append(f"{a}={v}")
        target.append(f"<{el.tag} .{classes} {' '.join(attrs)}>")
        if el.text and el.text.strip():
            target.append("T:" + " ".join(el.text.split()))
        for child in el:
            walk(child, target)
            if child.tail and child.tail.strip():
                target.append("T:" + " ".join(child.tail.split()))
        target.append(f"</{el.tag}>")

    body = root.find("body")
    for child in body:
        walk(child, flow)
    return flow, chrome


def reference_tree(page: Path):
    """The source page after the theme's cleaning, as a tree."""
    ex = Extractor()
    root = html.parse(str(page)).getroot()
    body = root.find("body")
    cleaned = ex.clean(body, page.name)
    Extractor.cut_slots(cleaned)
    root.replace(body, cleaned)
    return root


def cut_rendered_slots(root) -> None:
    """The theme fills slots with live content (the blog's posts): compare around them."""
    body = root.find("body")
    if body is not None:
        Extractor.cut_slots(body)


def restore_form_placeholders(root) -> None:
    """Puts back the placeholders the theme fills in the contact form (its address and
    hidden fields, which contact-form.php owns and verify_contact.py tests)."""
    for form in root.iter("form"):
        form.set("action", "{{form-action}}")
        injected = form.xpath('./input[@type="hidden"] | ./div[contains(@class,"osous-hp")]')
        for node in injected:
            form.remove(node)
        form.text = "{{form-fields}}"


def wp_tree(url: str):
    root = html.fromstring(fetch(url))
    for el in root.xpath('//*[@id="wpadminbar"] | //div[contains(@class,"wp-site-blocks")]'):
        el.drop_tree()
    cut_rendered_slots(root)
    restore_form_placeholders(root)
    return root


def main() -> int:
    parser = argparse.ArgumentParser()
    parser.add_argument("--base", default="http://localhost:8100")
    parser.add_argument("pages", nargs="*")
    args = parser.parse_args()
    base = args.base.rstrip("/")
    theme_url = f"{base}/wp-content/themes/osous/assets"
    pages = [REFERENCE / p for p in args.pages] if args.pages else public_pages()

    failed = 0
    chrome_reference = None
    for page in pages:
        slug = slug_for(page)
        url = f"{base}/{slug}/" if slug else f"{base}/"
        ref_flow, ref_chrome = stream(reference_tree(page), base, theme_url, True)
        wp_flow, wp_chrome = stream(wp_tree(url), base, theme_url, False)
        diff = [d for d in difflib.unified_diff(ref_flow, wp_flow, lineterm="", n=0) if d[:1] in "+-" and d[:3] not in ("+++", "---")]
        # Chrome: the same parts, in any order (they are fixed or hidden).
        chrome_diff = sorted(set(ref_chrome) ^ set(wp_chrome))
        status = "ok" if not diff and not chrome_diff else "DIFFERS"
        if status != "ok":
            failed += 1
        print(f"{status:8s} {page.name:42s} {len(ref_flow):5d} tokens  {len(diff):3d} flow diffs  {len(chrome_diff):3d} chrome diffs")
        for line in (diff + [f"chrome {c}" for c in chrome_diff])[:8]:
            print("           ", line[:180])
    print(f"{failed} of {len(pages)} pages differ")
    return 1 if failed else 0


if __name__ == "__main__":
    sys.exit(main())
