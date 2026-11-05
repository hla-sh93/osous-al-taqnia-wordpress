"""Build everything the theme generates from the Webflow export, in order.

    1. build_css.py  the stylesheets (extract.py reads them to find background pictures)
    2. extract.py    the content files and the pictures

Run:  python tools/build.py
"""

import build_css
import extract

if __name__ == "__main__":
    build_css.main()
    extract.main()
