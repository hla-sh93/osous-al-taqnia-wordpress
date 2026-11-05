"""Check what the site exposes to a visitor.

Security headers on pages; XML-RPC off; user names not listed by the REST API, the
author archive or ?author=N; the WordPress version not printed; no PHP file in the theme
runs when opened directly; no tool, secret or source file inside the theme folder.

Run:  python tools/verify_security.py
Passing looks like:  10 checks, 0 problems
"""

from __future__ import annotations

import sys
import urllib.error
import urllib.request
from pathlib import Path

SITE = "http://localhost:8100"
THEME = Path(__file__).resolve().parent.parent / "theme" / "osous"


class NoRedirect(urllib.request.HTTPRedirectHandler):
    def redirect_request(self, *args, **kwargs):  # noqa: ANN002, ANN003
        return None


OPENER = urllib.request.build_opener(NoRedirect)


def get(path: str, data: bytes | None = None) -> tuple[int, dict, str]:
    try:
        with OPENER.open(urllib.request.Request(SITE + path, data=data), timeout=30) as r:
            return r.status, dict(r.headers), r.read().decode("utf-8", "replace")
    except urllib.error.HTTPError as error:
        return error.code, dict(error.headers), error.read().decode("utf-8", "replace")


def main() -> int:
    problems: list[str] = []
    checks = 0

    def check(ok: bool, label: str) -> None:
        nonlocal checks
        checks += 1
        print(f"{'ok' if ok else 'FAIL':5s} {label}")
        if not ok:
            problems.append(label)

    status, headers, body = get("/")
    check(
        headers.get("X-Content-Type-Options") == "nosniff"
        and headers.get("X-Frame-Options") == "SAMEORIGIN"
        and "strict-origin" in headers.get("Referrer-Policy", "")
        and "camera=()" in headers.get("Permissions-Policy", ""),
        "security headers on pages",
    )
    check('name="generator"' not in body and "ver=7." not in body and "?ver=6." not in body, "WordPress version not printed")
    check("X-Pingback" not in headers, "no X-Pingback header")

    # Only XML-RPC's own introspection (system.*) is built in and cannot be removed; it
    # exposes nothing. Pingbacks and every WordPress method must be gone.
    refused = []
    for method in ("pingback.ping", "wp.getUsersBlogs", "metaWeblog.getRecentPosts"):
        status, _, body = get("/xmlrpc.php", f"<?xml version='1.0'?><methodCall><methodName>{method}</methodName></methodCall>".encode())
        refused.append("does not exist" in body or status in (403, 404, 405))
    check(all(refused), "XML-RPC: pingbacks and WordPress methods removed")

    status, _, _ = get("/wp-json/wp/v2/users")
    check(status in (401, 403, 404), "REST API does not list users")
    status, headers, _ = get("/?author=1")
    check(status in (301, 302) and "author" not in headers.get("Location", ""), "?author=1 does not reveal a user name")

    direct = [p for p in THEME.rglob("*.php") if "content" not in p.parts]
    leaking = [str(p.relative_to(THEME)) for p in direct if get("/wp-content/themes/osous/" + p.relative_to(THEME).as_posix())[2].strip()]
    check(not leaking, f"{len(direct)} theme PHP files print nothing when opened directly" + (f": {leaking}" if leaking else ""))

    forbidden = [p for p in THEME.rglob("*") if p.is_file() and (p.suffix in (".py", ".sh", ".env", ".map", ".log") or p.name.startswith("."))]
    check(not forbidden, "no tools, dotfiles or source maps inside the theme" + (f": {forbidden[:5]}" if forbidden else ""))

    status, _, body = get("/wp-content/themes/osous/content/")
    check(status in (403, 404) or "Index of" not in body, "no folder listings in the theme")

    status, _, body = get("/wp-login.php", b"log=nobody&pwd=wrong&wp-submit=Log+In")
    check("The user name or password is incorrect." in body and "is not registered" not in body, "failed log-in does not say which field was wrong")

    print(f"{checks} checks, {len(problems)} problems")
    return 1 if problems else 0


if __name__ == "__main__":
    sys.exit(main())
