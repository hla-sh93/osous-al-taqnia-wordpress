"""Prove the contact form works and refuses what it should, on the local site.

Cases: a valid message is delivered (to Mailpit, with Reply-To); a bot that fills the
hidden field is told "sent" and nothing is delivered; a bad email, a missing required
field and a request without the security token are refused; the design's success and
error messages show. A sixth message from the same address within ten minutes is refused
(the limit is five).

Run:  python tools/verify_contact.py
Passing looks like:  8 checks, 0 problems
"""

from __future__ import annotations

import json
import subprocess
import sys
import urllib.request
from pathlib import Path

from playwright.sync_api import sync_playwright

SITE = "http://localhost:8100"
MAILPIT = "http://localhost:8045/api/v1"

VALID = {"name": "Test Visitor", "company": "Example Trading Co.", "email": "visitor@example.test", "mobile": "000", "message": "Hello from the contact form check."}


def mail_count() -> int:
    with urllib.request.urlopen(f"{MAILPIT}/messages", timeout=10) as r:  # noqa: S310 -- local Mailpit
        return int(json.load(r)["total"])


def latest_mail() -> dict:
    with urllib.request.urlopen(f"{MAILPIT}/message/latest", timeout=10) as r:  # noqa: S310
        return json.load(r)


def submit(page, values: dict, honeypot: str = "") -> str:
    page.goto(f"{SITE}/contact/", wait_until="load")
    for name, value in values.items():
        page.fill(f"#email-form [name={name}]", value)
    if honeypot:
        page.evaluate("v => document.querySelector('[name=website]').value = v", honeypot)
    # Bypass the browser's own checks, to prove the server refuses on its own.
    page.evaluate("document.querySelector('#email-form').noValidate = true")
    page.click("#email-form [type=submit]")
    page.wait_for_load_state("load")
    return page.url


def main() -> int:
    problems: list[str] = []
    checks = 0

    def check(ok: bool, label: str) -> None:
        nonlocal checks
        checks += 1
        print(f"{'ok' if ok else 'FAIL':5s} {label}")
        if not ok:
            problems.append(label)

    # Start from a clean submission limit (local site only).
    subprocess.run(["docker", "compose", "run", "--rm", "-T", "cli", "wp", "transient", "delete", "--all"], cwd=Path(__file__).parent.parent, check=True, capture_output=True)

    with sync_playwright() as pw:
        browser = pw.chromium.launch()
        page = browser.new_page()

        before = mail_count()
        url = submit(page, VALID)
        check("contact=sent" in url and page.is_visible(".w-form-done") and not page.is_visible("#email-form"), "valid message: success message shown, form hidden")
        mail = latest_mail()
        reply_to = (mail.get("ReplyTo") or [{}])[0].get("Address")
        check(mail_count() == before + 1 and reply_to == VALID["email"] and "Example Trading Co." in mail.get("Text", ""), "valid message: delivered with Reply-To")

        before = mail_count()
        url = submit(page, VALID, honeypot="https://spam.example")
        check("contact=sent" in url and mail_count() == before, "bot filling the hidden field: told sent, nothing delivered")

        url = submit(page, {**VALID, "email": "not-an-email"})
        check("contact=failed" in url and page.is_visible(".w-form-fail"), "bad email: refused, error message shown")

        url = submit(page, {**VALID, "company": ""})
        check("contact=failed" in url, "missing required field: refused")

        # A forged request without the token, straight to the handler.
        status = page.request.post(f"{SITE}/wp-admin/admin-post.php", form={"action": "osous_contact", **VALID}, max_redirects=0).headers.get("location", "")
        check("contact=failed" in status, "request without the security token: refused")

        # One message is counted so far; four more reach the limit, the sixth is refused.
        results = [submit(page, VALID) for _ in range(5)]
        check(all("contact=sent" in r for r in results[:4]) and "contact=failed" in results[4], "sixth message within ten minutes: refused")

        headers = page.request.get(f"{SITE}/contact/").headers
        check("no-cache" in headers.get("cache-control", ""), "contact page is not cached (its token stays fresh)")
        browser.close()

    print(f"{checks} checks, {len(problems)} problems")
    return 1 if problems else 0


if __name__ == "__main__":
    sys.exit(main())
