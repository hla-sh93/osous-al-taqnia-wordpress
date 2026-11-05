"""Build the delivery package for the client.

    dist/osous.zip                                 the theme, ready to upload
    dist/osous-site.zip                            the companion plugin, ready to upload
    dist/osous-al-taqnia-wordpress-<version>.zip   both, the screenshot, the installation
                                                   guides, and the complete source code

The source code is every file git tracks or would track (so nothing ignored: no secrets,
no dependencies, no local data). Each archive is checked after it is written.

Run:  python tools/package.py
"""

from __future__ import annotations

import re
import subprocess
import sys
import zipfile
from pathlib import Path

ROOT = Path(__file__).resolve().parent.parent
DIST = ROOT / "dist"
THEME = ROOT / "theme" / "osous"
PLUGIN = ROOT / "plugins" / "osous-site"
# Never shipped: secrets, dependencies (Composer's vendor/ at the root of the source),
# local data, half-built content, logs and tools' binaries.
FORBIDDEN = re.compile(r"(^|/)(\.env|node_modules|_local|content\.(next|old))(/|$)|/source/vendor/|\.(log|phar)$")


def version() -> str:
    match = re.search(r"^Version:\s*(\S+)", (THEME / "style.css").read_text(encoding="utf-8"), re.M)
    if not match:
        raise SystemExit("no Version in style.css")
    return match.group(1)


def zip_folder(folder: Path, target: Path) -> int:
    """Zips a folder under its own name (osous/..., as WordPress expects)."""
    files = sorted(p for p in folder.rglob("*") if p.is_file())
    with zipfile.ZipFile(target, "w", zipfile.ZIP_DEFLATED, compresslevel=9) as archive:
        for path in files:
            archive.write(path, f"{folder.name}/{path.relative_to(folder).as_posix()}")
    return len(files)


def source_files() -> list[str]:
    """Every file git tracks or would track, relative to the repository."""
    output = subprocess.run(
        ["git", "ls-files", "--cached", "--others", "--exclude-standard"],
        cwd=ROOT,
        check=True,
        capture_output=True,
        text=True,
    ).stdout
    return sorted(line for line in output.splitlines() if line and (ROOT / line).is_file())


def check(target: Path, expected: int) -> None:
    with zipfile.ZipFile(target) as archive:
        names = archive.namelist()
        bad = archive.testzip()
    leaks = [n for n in names if FORBIDDEN.search(n)]
    if bad or leaks or len(names) != expected:
        raise SystemExit(f"{target.name}: damaged={bad} leaks={leaks[:5]} files={len(names)}/{expected}")


def main() -> None:
    ver = version()
    DIST.mkdir(exist_ok=True)
    theme_zip, plugin_zip = DIST / "osous.zip", DIST / "osous-site.zip"
    check(theme_zip, zip_folder(THEME, theme_zip))
    check(plugin_zip, zip_folder(PLUGIN, plugin_zip))

    package = DIST / f"osous-al-taqnia-wordpress-{ver}.zip"
    sources = source_files()
    extras = {
        "osous.zip": theme_zip,
        "osous-site.zip": plugin_zip,
        "screenshot.png": THEME / "screenshot.png",
        "INSTALL.md": ROOT / "docs" / "INSTALL.md",
        "INSTALL-ar.md": ROOT / "docs" / "INSTALL-ar.md",
    }
    top = package.stem
    with zipfile.ZipFile(package, "w", zipfile.ZIP_DEFLATED, compresslevel=9) as archive:
        for name, path in extras.items():
            archive.write(path, f"{top}/{name}")
        for name in sources:
            archive.write(ROOT / name, f"{top}/source/{name}")
    check(package, len(extras) + len(sources))

    for path in (theme_zip, plugin_zip, package):
        print(f"{path.relative_to(ROOT).as_posix():48s} {path.stat().st_size / 1_048_576:6.1f} MB")
    print(f"version {ver}: theme, plugin and package built and checked ({len(sources)} source files)")


if __name__ == "__main__":
    sys.exit(main())
