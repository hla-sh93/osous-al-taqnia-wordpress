"""Shared paths, page list and parsing helpers for the build and check tools."""

from __future__ import annotations

import json
from functools import lru_cache
from pathlib import Path

from lxml import html

ROOT = Path(__file__).resolve().parent.parent
REFERENCE = ROOT / "reference"
THEME = ROOT / "theme" / "osous"
ASSETS = THEME / "assets"
CONTENT = THEME / "content"

# Webflow pages that are not part of the public site.
NOT_PUBLIC = {
    "401.html": "Webflow password page",
    "404.html": "replaced by the theme's 404 template",
    "design-system.html": "Webflow style guide",
    "detail_blogs.html": "Webflow CMS template, replaced by the single post template",
}

# Webflow pages the theme uses as templates: source file -> template key.
TEMPLATES = {
    "404.html": "not-found",
}

# Webflow pages whose markup the theme draws itself (dynamic templates): their styles
# are kept even though they are not pages of their own.
STYLE_ONLY = ["detail_blogs.html"]

# Source file name -> public slug, where they differ.
SLUG_FIXES = {
    "index.html": "",
    "endpoint-secuirty-iraq.html": "endpoint-security-iraq",
}

# Misspelt Webflow names, corrected everywhere (markup, CSS, scripts).
CLASS_RENAMES = {
    "fotter": "footer",
    "fotter_map": "footer-map",
    "navebar-menu": "navbar-menu",
    "accordion_qustion": "accordion-question",
    "magnatic": "magnetic",
}
ID_RENAMES = {
    "inquiery": "inquiry",
}


def public_pages() -> list[Path]:
    """Every reference page that becomes a WordPress page, sorted by name."""
    return sorted(
        p for p in REFERENCE.glob("*.html") if p.name not in NOT_PUBLIC
    )


def styled_pages() -> list[Path]:
    """Every page whose markup the stylesheets must cover."""
    extra = [REFERENCE / name for name in [*TEMPLATES, *STYLE_ONLY]]
    return public_pages() + extra


def slug_for(page: Path) -> str:
    """The WordPress slug a reference page is published under ('' = front page)."""
    return SLUG_FIXES.get(page.name, page.stem)


@lru_cache(maxsize=None)
def parse(path: Path) -> html.HtmlElement:
    """Parse an HTML file once and cache the tree. Callers must not mutate it."""
    return html.parse(str(path)).getroot()


def write_json(path: Path, data) -> None:
    """Write JSON with stable formatting, so generated files diff cleanly."""
    path.parent.mkdir(parents=True, exist_ok=True)
    path.write_text(
        json.dumps(data, ensure_ascii=False, indent=2) + "\n", encoding="utf-8", newline="\n"
    )
