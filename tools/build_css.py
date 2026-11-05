"""Build the theme's stylesheets from the Webflow export.

Keeps only the rules whose selectors match an element on at least one public page,
corrects Webflow's misspelt class and token names, and writes readable CSS, one file per
source layer so the cascade order of the original is preserved:

    base.css       normalize.css
    framework.css  webflow.css (the platform's layout primitives the markup relies on)
    tokens.css     the design tokens (:root custom properties)
    site.css       the site's own styles

Run:  python tools/build_css.py
"""

from __future__ import annotations

import re
import sys
from collections import Counter
from pathlib import Path

import tinycss2
from cssselect import GenericTranslator, SelectorError
from lxml import etree

sys.path.insert(0, str(Path(__file__).parent))
from common import ASSETS, CLASS_RENAMES, ID_RENAMES, REFERENCE, asset_filename, parse, public_pages, styled_pages  # noqa: E402

OUT = ASSETS / "css"

# Classes and states that scripts add at runtime: a selector that needs them still
# matches the markup once the script has run, so they are ignored when matching.
RUNTIME_CLASSES = re.compile(
    r"\.(w--open|w--current|w--tab-active|w--redirected-checked|w--redirected-focus|"
    r"w-mod-js|w-mod-ix3|w-mod-touch|active|is-open|is-active|swiper-[\w-]+)(?![\w-])"
)
SIMPLE_WHERE = re.compile(r":(?:where|is)\(((?:[.#][\w-]+)+)\)")
PSEUDO = re.compile(r"::?[a-zA-Z-]+(\((?:[^()]|\([^()]*\))*\))?")
BADGE = "w-webflow-badge"


def token_rename(name: str) -> str:
    """Turn a Webflow variable name into a plain one: --_theme---raddi--card -> --radius-card."""
    body = name[2:]
    body = re.sub(r"^_(theme|responsive|navbar)---", lambda m: "" if m.group(1) != "navbar" else "navbar-", body)
    body = body.replace("---", "-").replace("--", "-")
    body = body.replace("raddi", "radius").replace("blure", "blur")
    return "--" + body


class Matcher:
    """Answers 'does this selector match anything on any public page?', with a cache."""

    def __init__(self, pages: list[Path]):
        self.trees = [parse(p) for p in pages]
        self.cache: dict[str, bool] = {}
        self.translator = GenericTranslator()

    def matches(self, selector: str) -> bool:
        # :where(.x) / :is(.x) around one compound selector is a real requirement: inline it.
        # Anything else in parentheses (lists, :not) only narrows, so dropping it is safe.
        selector = SIMPLE_WHERE.sub(r"\1", selector)
        key = RUNTIME_CLASSES.sub("", PSEUDO.sub("", selector)).strip()
        key = re.sub(r"\s*([>+~])\s*$", "", key).strip() or "*"
        if key not in self.cache:
            self.cache[key] = self._query(key)
        return self.cache[key]

    def _query(self, selector: str) -> bool:
        try:
            xpath = self.translator.css_to_xpath(selector)
        except SelectorError:
            return True  # unknown syntax: keep the rule rather than guess
        compiled = etree.XPath(xpath)
        return any(compiled(tree) for tree in self.trees)


def split_selectors(prelude: str) -> list[str]:
    """Split a selector list on top-level commas (not those inside :is(...) etc.)."""
    parts, depth, cur = [], 0, ""
    for ch in prelude:
        if ch == "(":
            depth += 1
        elif ch == ")":
            depth -= 1
        if ch == "," and depth == 0:
            parts.append(cur.strip())
            cur = ""
        else:
            cur += ch
    if cur.strip():
        parts.append(cur.strip())
    return parts


def rename_selector(sel: str) -> str:
    for old, new in CLASS_RENAMES.items():
        sel = re.sub(rf"\.{re.escape(old)}(?![\w-])", f".{new}", sel)
    for old, new in ID_RENAMES.items():
        sel = re.sub(rf"#{re.escape(old)}(?![\w-])", f"#{new}", sel)
    return sel


TOKEN_NAMES: dict[str, str] = {}


def rename_vars(text: str) -> str:
    """Rename every custom property in a value or declaration name, recording the mapping."""

    def swap(match: re.Match) -> str:
        old = match.group(0)
        TOKEN_NAMES.setdefault(old, token_rename(old))
        return TOKEN_NAMES[old]

    return re.sub(r"(?<![\w-])--[\w-]+", swap, text)


def assert_unique_tokens() -> None:
    """Two Webflow names must never collapse into one plain name."""
    seen: dict[str, str] = {}
    for old, new in TOKEN_NAMES.items():
        if new in seen and seen[new] != old:
            raise SystemExit(f"token rename collision: {seen[new]} and {old} -> {new}")
        seen[new] = old


def format_declarations(tokens, indent: str) -> str:
    decls = tinycss2.parse_declaration_list(tokens, skip_comments=True, skip_whitespace=True)
    lines = []
    for d in decls:
        if d.type != "declaration":
            continue
        value = tinycss2.serialize(d.value).strip()
        value = re.sub(r"\s+", " ", value)
        # Webflow leaves references to variables that were deleted in the designer. The
        # browser discards those definitions and treats each use as invalid at computed-
        # value time, i.e. `unset`: say so plainly instead of shipping the broken name.
        if "<deleted" in d.name:
            continue
        if "deleted" in value and "var(" in value:
            value = "unset"
        important = " !important" if d.important else ""
        value = re.sub(r"url\((['\"]?)\.\./images/([^'\")]+)\1\)", lambda m: f'url("../images/{asset_filename(m.group(2))}")', value)
        name = rename_vars(d.name) if d.name.startswith("--") else d.lower_name
        lines.append(f"{indent}{name}: {rename_vars(value)}{important};")
    return "\n".join(lines)


class Builder:
    def __init__(self, matcher: Matcher):
        self.matcher = matcher
        self.stats = Counter()

    def rules(self, nodes, indent: str = "") -> list[str]:
        out = []
        for node in nodes:
            if node.type == "qualified-rule":
                block = self.qualified(node, indent)
                if block:
                    out.append(block)
            elif node.type == "at-rule":
                block = self.at_rule(node, indent)
                if block:
                    out.append(block)
        return out

    def qualified(self, node, indent: str) -> str | None:
        prelude = tinycss2.serialize(node.prelude).strip()
        self.stats["rules in"] += 1
        if BADGE in prelude:
            return None
        if prelude.startswith(("from", "to")) or re.match(r"^[\d.]+%", prelude):
            selectors = [prelude]  # keyframe step
        else:
            selectors = [s for s in split_selectors(prelude) if self.matcher.matches(s)]
        if not selectors:
            self.stats["rules dropped"] += 1
            return None
        body = format_declarations(node.content, indent + "  ")
        if not body:
            return None
        self.stats["rules kept"] += 1
        head = (",\n" + indent).join(rename_selector(s) for s in selectors)
        return f"{indent}{head} {{\n{body}\n{indent}}}"

    def at_rule(self, node, indent: str) -> str | None:
        name = node.lower_at_keyword
        prelude = re.sub(r"\s+", " ", tinycss2.serialize(node.prelude)).strip()
        if node.content is None:
            return f"{indent}@{name} {prelude};"
        if name in ("media", "supports", "keyframes", "-webkit-keyframes"):
            inner = self.rules(tinycss2.parse_rule_list(node.content, skip_comments=True, skip_whitespace=True), indent + "  ")
            if not inner:
                return None
            return f"{indent}@{name} {prelude} {{\n" + "\n\n".join(inner) + f"\n{indent}}}"
        body = format_declarations(node.content, indent + "  ")
        return f"{indent}@{name} {prelude} {{\n{body}\n{indent}}}"


def parse_sheet(text: str):
    return tinycss2.parse_stylesheet(text, skip_comments=True, skip_whitespace=True)


def inline_styles() -> str:
    """The site-wide <style> blocks Webflow writes into every page, once each, in page order."""
    seen, blocks = set(), []
    for page in public_pages():
        for style in parse(page).iter("style"):
            text = (style.text or "").strip()
            if text and text not in seen and BADGE not in text and "w-mod-ix3" not in text:
                seen.add(text)
                blocks.append(text)
    return "\n".join(blocks)


def header(title: str) -> str:
    return f"/**\n * {title}\n *\n * Generated by tools/build_css.py from the Webflow export. Do not edit by hand.\n */\n\n"


def main() -> None:
    OUT.mkdir(parents=True, exist_ok=True)
    builder = Builder(Matcher(styled_pages()))
    site_nodes = parse_sheet((REFERENCE / "css" / "osous-al-taqnia.webflow.css").read_text(encoding="utf-8"))
    root_nodes = [n for n in site_nodes if n.type == "qualified-rule" and tinycss2.serialize(n.prelude).strip() == ":root"]
    rest_nodes = [n for n in site_nodes if n not in root_nodes]

    files = {
        "base.css": ("Base: element defaults (normalize.css).", parse_sheet((REFERENCE / "css" / "normalize.css").read_text(encoding="utf-8"))),
        "framework.css": ("Framework: the layout primitives the markup relies on.", parse_sheet((REFERENCE / "css" / "webflow.css").read_text(encoding="utf-8"))),
        "tokens.css": ("Design tokens.", root_nodes),
        "site.css": ("Site styles.", rest_nodes + list(parse_sheet(inline_styles()))),
    }
    for name, (title, nodes) in files.items():
        blocks = builder.rules(nodes)
        (OUT / name).write_text(header(title) + "\n\n".join(blocks) + "\n", encoding="utf-8", newline="\n")
        print(f"{name:14s} {len(blocks):4d} blocks")
    assert_unique_tokens()
    s = builder.stats
    print(f"{len(TOKEN_NAMES)} custom properties renamed, 0 collisions")
    print(f"{s['rules in']} rules read, {s['rules kept']} kept, {s['rules dropped']} dropped (match no element on any of {len(styled_pages())} pages)")


if __name__ == "__main__":
    main()
