"""Compare the layout of every WordPress page with its Webflow source in a real browser.

Each page is loaded on both sites at 1440x900 and 479x900, scrolled through once so every
scroll effect has played, then measured: the page height and the box (x, y, width,
height) of every heading, paragraph, picture, link and section, in document order.
A box that moved or changed size by more than 1px is a difference.

Needs the reference served on port 8110 (python -m http.server 8110 --directory reference).

Run:  python tools/verify_layout.py [--widths 1440,479] [page.html ...]
Every failed file (4xx/5xx) and every script error on the WordPress page also counts.

Passing looks like:  done at 1440x900 -- 0 of 66 pages differ
"""

from __future__ import annotations

import argparse
import json
import sys
from pathlib import Path

from playwright.sync_api import sync_playwright

sys.path.insert(0, str(Path(__file__).parent))
from common import CLASS_RENAMES, CONTENT, REFERENCE, public_pages, slug_for  # noqa: E402

MEASURE = """
() => {
  // Fixed parts, rows that scroll sideways for ever and carousel slides have no stable position.
  const chrome = '.navbar, .navbar *, .whatsapp, .whatsapp *, .preloader, .preloader *, .marquee-wrapper *, .marquee-row, .marquee-row *, .swiper-wrapper *';
  // Classes scripts toggle while scrolling describe a moment, not the layout.
  const transient = new Set(['active', 'active2', 'is-open', 'w--open']);
  document.querySelectorAll('.list-item.active, .list_item_2.active').forEach((el) => el.classList.remove('active'));
  const nodes = [...document.querySelectorAll('section, h1, h2, h3, h4, p, img, a, .btn, .card, .cell, .footer, .fotter')]
    .filter((el) => !el.matches(chrome));
  return {
    height: document.documentElement.scrollHeight,
    boxes: nodes.map((el) => {
      const r = el.getBoundingClientRect();
      const label = el.tagName.toLowerCase() + '.' + [...el.classList].filter((c) => !transient.has(c)).slice(0, 3).join('.');
      return [label, Math.round(r.left), Math.round(r.top + window.scrollY), Math.round(r.width), Math.round(r.height)];
    }),
  };
}
"""

SETTLE = """
async () => {
  await document.fonts.ready;
  const step = Math.round(window.innerHeight / 2);
  for (let y = 0; y < document.documentElement.scrollHeight; y += step) {
    window.scrollTo(0, y);
    await new Promise((r) => setTimeout(r, 60));
  }
  window.scrollTo(0, document.documentElement.scrollHeight);
  await new Promise((r) => setTimeout(r, 1800));
  window.scrollTo(0, 0);
  // Pinned sections freeze the size they last measured; on the original site that depends
  // on when lazy pictures arrived. Measure both sites after one more refresh.
  // The highlighted list card is 2px taller: clear the highlight before pins re-measure.
  document.querySelectorAll('.list-item.active, .list_item_2.active').forEach((el) => el.classList.remove('active'));
  if (window.ScrollTrigger) window.ScrollTrigger.refresh();
  await new Promise((r) => setTimeout(r, 400));
  // Pictures inside closed menus never load (they are lazy and hidden): wait at most 3s.
  const pending = [...document.images].filter((img) => !img.complete && img.offsetParent !== null);
  await Promise.race([
    Promise.all(pending.map((img) => new Promise((r) => { img.onload = img.onerror = r; }))),
    new Promise((r) => setTimeout(r, 3000)),
  ]);
}
"""


def has_slots(page: Path) -> bool:
    """Whether the theme fills part of this page with live content."""
    manifest = json.loads((CONTENT / "pages" / f"{slug_for(page) or 'home'}.json").read_text(encoding="utf-8"))

    def walk(items):
        return any(item.get("slots") or walk(item.get("items", [])) for item in items)

    return walk(manifest["items"])


def watch(tab) -> list[str]:
    """Collects, for the page loaded next, every failed file and every script error."""
    errors: list[str] = []
    tab.on("response", lambda r: errors.append(f"{r.status} {r.url}") if r.status >= 400 else None)
    # A request the browser abandons because the check moves on (ERR_ABORTED) is not a fault.
    tab.on("requestfailed", lambda r: errors.append(f"failed {r.url} ({r.failure})") if "ERR_ABORTED" not in (r.failure or "") else None)
    tab.on("pageerror", lambda e: errors.append(f"script error: {e}"))
    tab.on("console", lambda m: errors.append(f"console {m.type}: {m.text[:140]}") if m.type == "error" else None)
    return errors


def measure(page, url: str) -> dict:
    """Loads, settles, then measures until two readings in a row agree (at most 6)."""
    page.goto(url, wait_until="load", timeout=90000)
    page.evaluate(SETTLE)
    result = page.evaluate(MEASURE)
    for _ in range(5):
        page.wait_for_timeout(500)
        again = page.evaluate(MEASURE)
        if again == result:
            break
        result = again
    for box in result["boxes"]:
        tag, *classes = box[0].split(".")
        box[0] = ".".join([tag] + [CLASS_RENAMES.get(c, c) for c in classes])
    return result


def compare(ref: dict, wp: dict) -> list[str]:
    problems = []
    if abs(ref["height"] - wp["height"]) > 1:
        problems.append(f"page height {ref['height']} -> {wp['height']}")
    if len(ref["boxes"]) != len(wp["boxes"]):
        problems.append(f"{len(ref['boxes'])} boxes -> {len(wp['boxes'])}")
    for a, b in zip(ref["boxes"], wp["boxes"]):
        if a[0] != b[0]:
            problems.append(f"order: {a[0]} vs {b[0]}")
            break
        if any(abs(x - y) > 1 for x, y in zip(a[1:], b[1:])):
            problems.append(f"{a[0]} {a[1:]} -> {b[1:]}")
    return problems


def main() -> int:
    parser = argparse.ArgumentParser()
    parser.add_argument("--wp", default="http://localhost:8100")
    parser.add_argument("--ref", default="http://127.0.0.1:8110")
    parser.add_argument("--widths", default="1440,479")
    parser.add_argument("pages", nargs="*")
    args = parser.parse_args()
    pages = [REFERENCE / p for p in args.pages] if args.pages else public_pages()
    live = [p for p in pages if has_slots(p)]
    for page in live:
        print(f"skipped  {page.name}: shows live content (the blog's posts); tools/verify_blog.py checks it")
    pages = [p for p in pages if p not in live]

    exit_code = 0
    with sync_playwright() as pw:
        browser = pw.chromium.launch()
        for width in (int(w) for w in args.widths.split(",")):
            context = browser.new_context(viewport={"width": width, "height": 900})
            ref_tab, wp_tab = context.new_page(), context.new_page()
            wp_errors = watch(wp_tab)
            failed = 0
            for page in pages:
                slug = slug_for(page)
                ref = measure(ref_tab, f"{args.ref}/{page.name}")
                wp_errors.clear()
                wp = measure(wp_tab, f"{args.wp}/{slug}/" if slug else f"{args.wp}/")
                # Swiper itself warns that the original's three-slide carousels are too
                # short to loop; that warning is the original design's, not a fault here.
                problems = compare(ref, wp) + [e for e in wp_errors if "Swiper Loop Warning" not in e]
                failed += bool(problems)
                print(f"{'ok' if not problems else 'DIFFERS':8s} {width}  {page.name:42s} {len(ref['boxes']):4d} boxes  {len(problems):3d} differences")
                for line in problems[:6]:
                    print("             ", line)
            print(f"done at {width}x900 -- {failed} of {len(pages)} pages differ")
            exit_code |= bool(failed)
            context.close()
        browser.close()
    return exit_code


if __name__ == "__main__":
    sys.exit(main())
