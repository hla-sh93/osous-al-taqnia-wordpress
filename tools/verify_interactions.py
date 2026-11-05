"""Use the menus and accordions on both sites as a visitor would, and compare the result.

Each step is done on the Webflow original and on WordPress; after each, the same
question is asked of both pages (is the panel showing, how tall is the answer...). The
answers must match.

Run:  python tools/verify_interactions.py
Passing looks like:  9 steps, 0 differences
"""

from __future__ import annotations

import sys
from pathlib import Path

from playwright.sync_api import sync_playwright

sys.path.insert(0, str(Path(__file__).parent))
from common import CLASS_RENAMES  # noqa: E402

REF = "http://127.0.0.1:8110"
WP = "http://localhost:8100"

VISIBLE = "(s) => { const e = document.querySelector(s); if (!e) return 'missing'; const r = e.getBoundingClientRect(); const cs = getComputedStyle(e); return cs.display !== 'none' && cs.visibility !== 'hidden' && r.height > 0 ? 'shown' : 'hidden'; }"
HEIGHT = "(s) => Math.round(document.querySelector(s).getBoundingClientRect().height)"

# (label, viewport width, page on each site, actions, question, selector)
STEPS = [
    ("mobile menu starts closed", 479, ("about.html", "about/"), [], VISIBLE, ".navbar-menu"),
    ("menu button opens the menu", 479, ("about.html", "about/"), [("click", ".btn-menu")], VISIBLE, ".navbar-menu"),
    ("a section opens its panel", 479, ("about.html", "about/"), [("click", ".btn-menu"), ("click", ".dd-menu-item:not(.hide-on-desktop) .menu-item-toggle")], VISIBLE, ".dd-menu-item:not(.hide-on-desktop) .menu"),
    ("a group opens its links", 479, ("about.html", "about/"), [("click", ".btn-menu"), ("click", ".dd-menu-item:not(.hide-on-desktop) .menu-item-toggle"), ("click", ".dd-menu-item:not(.hide-on-desktop) .dd-menu-list-toggle")], VISIBLE, ".dd-menu-item:not(.hide-on-desktop) .dd-menu-list-toggle + *"),
    ("menu button closes the menu", 479, ("about.html", "about/"), [("click", ".btn-menu"), ("wait", 400), ("click", ".btn-menu")], VISIBLE, ".navbar-menu"),
    ("desktop panel hidden at rest", 1440, ("about.html", "about/"), [], VISIBLE, ".dd-menu-item:not(.hide-on-desktop) .menu"),
    ("desktop hover shows the panel", 1440, ("about.html", "about/"), [("hover", ".dd-menu-item:not(.hide-on-desktop) .menu-item-toggle")], VISIBLE, ".dd-menu-item:not(.hide-on-desktop) .menu"),
    ("FAQ folded to its question", 1440, ("aml-compliance-software.html", "aml-compliance-software/"), [], HEIGHT, ".accordion"),
    ("FAQ opens on click", 1440, ("aml-compliance-software.html", "aml-compliance-software/"), [("click", ".accordion"), ("wait", 700)], HEIGHT, ".accordion"),
]


def original_names(selector: str) -> str:
    """The same selector with the original site's (misspelt) class names."""
    for old, new in CLASS_RENAMES.items():
        selector = selector.replace(f".{new}", f".{old}")
    return selector


def answer(browser, base: str, path: str, width: int, actions: list, question: str, selector: str):
    # Phone widths are used as on a phone: a touch screen, tapped.
    phone = width < 992
    context = browser.new_context(viewport={"width": width, "height": 900}, has_touch=phone, is_mobile=phone)
    page = context.new_page()
    rename = original_names if base == REF else (lambda s: s)
    page.goto(f"{base}/{path}", wait_until="load")
    page.wait_for_timeout(1500)
    for action, target in actions:
        if action == "wait":
            page.wait_for_timeout(target)
        else:
            element = page.locator(rename(target)).first
            element.scroll_into_view_if_needed()
            getattr(element, "tap" if phone and action == "click" else action)()
            page.wait_for_timeout(500)
    result = page.evaluate(question, rename(selector))
    context.close()
    return result


def main() -> int:
    differences = 0
    with sync_playwright() as pw:
        browser = pw.chromium.launch()
        for label, width, (ref_path, wp_path), actions, question, selector in STEPS:
            ref = answer(browser, REF, ref_path, width, actions, question, selector)
            wp = answer(browser, WP, wp_path, width, actions, question, selector)
            same = ref == wp
            differences += not same
            print(f"{'ok' if same else 'DIFFERS':8s} {width:5d}  {label:34s} original: {ref}  wordpress: {wp}")
        browser.close()
    print(f"{len(STEPS)} steps, {differences} differences")
    return 1 if differences else 0


if __name__ == "__main__":
    sys.exit(main())
