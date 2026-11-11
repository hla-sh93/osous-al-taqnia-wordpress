"""Build the installable theme zip: dist/osous-al-taqnia-classic-<version>.zip.
The theme folder inside the zip stays osous-webflow, so WordPress updates the installed theme.

Usage: python tools/package.py
"""
import pathlib
import re
import zipfile

ROOT = pathlib.Path(__file__).resolve().parent.parent
THEME = ROOT / 'osous-webflow'
SKIP = {'.DS_Store', 'Thumbs.db'}

version = re.search(r'^Version:\s*(\S+)', (THEME / 'style.css').read_text(encoding='utf8'), re.M).group(1)
out = ROOT / 'dist' / f'osous-al-taqnia-classic-{version}.zip'
out.parent.mkdir(exist_ok=True)

count = 0
with zipfile.ZipFile(out, 'w', zipfile.ZIP_DEFLATED) as zf:
    for path in sorted(THEME.rglob('*')):
        if path.is_file() and path.name not in SKIP:
            zf.write(path, pathlib.Path('osous-webflow') / path.relative_to(THEME))
            count += 1
print(f'{out.relative_to(ROOT)}: {count} files, {out.stat().st_size // 1024} KB')
