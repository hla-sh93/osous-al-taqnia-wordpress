"""Print a compact outline of an HTML page: tag.class, depth-limited, with short text."""
import sys
from lxml import html

def walk(el, depth, maxd):
    if not isinstance(el.tag, str) or el.tag in ("script", "style", "path", "svg"):
        if el.tag == "svg":
            print("  " * depth + "svg")
        return
    cls = ".".join((el.get("class") or "").split())
    txt = (el.text or "").strip().replace("\n", " ")[:50]
    extra = ""
    for a in ("href", "src", "id"):
        if el.get(a):
            extra += f" {a}={el.get(a)[:50]}"
    print("  " * depth + f"{el.tag}{'.' + cls if cls else ''}{extra}" + (f"  «{txt}»" if txt else ""))
    if depth < maxd:
        for c in el:
            walk(c, depth + 1, maxd)

root = html.parse(sys.argv[1]).getroot()
sel = sys.argv[3] if len(sys.argv) > 3 else None
start = root.cssselect(sel)[0] if sel else root.find("body")
walk(start, 0, int(sys.argv[2]))
