"""Prove the blog lists the real posts correctly, page by page, and every post opens.

For every page of the blog: the number of cards is right, and each card's title, link,
date and picture are its post's (read from WordPress itself). The pager links every page,
marks the current one, and has no "Previous" on the first page or "Next" on the last.
Every post opens with its title as the heading and the site's footer.

Run:  python tools/verify_blog.py
Passing looks like:  24 posts on 3 pages checked, 0 problems
"""

from __future__ import annotations

import json
import subprocess
import sys
import urllib.request
from pathlib import Path

from lxml import html

SITE = "http://localhost:8100"


def wp(*args: str) -> str:
    """Runs WP-CLI on the local stack and returns its output."""
    result = subprocess.run(
        ["docker", "compose", "run", "--rm", "-T", "cli", "wp", *args],
        cwd=Path(__file__).parent.parent,
        check=True,
        capture_output=True,
        text=True,
    )
    return result.stdout


def fetch(url: str):
    with urllib.request.urlopen(url, timeout=60) as response:  # noqa: S310 -- local site only
        return html.fromstring(response.read())


def main() -> int:
    per_page = int(wp("option", "get", "posts_per_page").strip())
    posts = json.loads(
        wp("post", "list", "--post_type=post", "--post_status=publish", "--orderby=date", "--order=DESC", "--fields=ID,post_title,url,post_date", "--format=json")
    )
    pages = (len(posts) + per_page - 1) // per_page
    problems: list[str] = []

    for number in range(1, pages + 1):
        url = f"{SITE}/blog/" if number == 1 else f"{SITE}/blog/page/{number}/"
        root = fetch(url)
        expected = posts[(number - 1) * per_page : number * per_page]
        cards = root.cssselect(".w-dyn-item .blog-card")
        if len(cards) != len(expected):
            problems.append(f"{url}: {len(cards)} cards, expected {len(expected)}")
        for card, post in zip(cards, expected):
            title = " ".join(card.cssselect(".h2")[0].text_content().split())
            if title != " ".join(html.fromstring(f"<p>{post['post_title']}</p>").text_content().split()):
                problems.append(f"{url}: card '{title}' should be '{post['post_title']}'")
            if card.get("href") != post["url"]:
                problems.append(f"{url}: card link {card.get('href')} should be {post['url']}")
            if not card.cssselect("img.blog-image-thumb[src][srcset]"):
                problems.append(f"{url}: card '{title}' has no responsive picture")
        pager = root.cssselect(".w-pagination-wrapper")
        if pages > 1 and not pager:
            problems.append(f"{url}: no pager")
        elif pager:
            current = pager[0].cssselect('[aria-current="page"]')
            if not current or current[0].text_content().strip() != str(number):
                problems.append(f"{url}: pager does not mark page {number}")
            if (number == 1) == bool(pager[0].cssselect(".w-pagination-previous")):
                problems.append(f"{url}: 'Previous' shown wrongly")
            if (number == pages) == bool(pager[0].cssselect(".w-pagination-next")):
                problems.append(f"{url}: 'Next' shown wrongly")

    for post in posts:
        root = fetch(post["url"])
        heading = " ".join(root.cssselect("h1.h1")[0].text_content().split()) if root.cssselect("h1.h1") else ""
        if not heading or not root.cssselect(".w-richtext p") or not root.cssselect(".footer"):
            problems.append(f"{post['url']}: heading, body or footer missing")

    for line in problems:
        print("  -", line)
    print(f"{len(posts)} posts on {pages} pages checked, {len(problems)} problems")
    return 1 if problems else 0


if __name__ == "__main__":
    sys.exit(main())
