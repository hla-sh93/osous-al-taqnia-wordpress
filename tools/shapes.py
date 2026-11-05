"""Group every top-level section of the public pages by structural shape."""
import os, re, sys, collections, hashlib
from lxml import html

SKIP = {"401.html", "404.html", "design-system.html"}
CHROME = {"preloader", "navbar", "whatsapp"}

def norm_classes(el):
    return [c for c in (el.get("class") or "").split() if not c.startswith("w-variant-") and c not in ("w-container", "w-layout-blockcontainer", "w-inline-block")]

def shape(el, depth):
    if not isinstance(el.tag, str) or el.tag in ("script", "style"):
        return ""
    s = el.tag + "." + ".".join(norm_classes(el))
    if depth > 0:
        kids = [shape(c, depth - 1) for c in el if isinstance(c.tag, str)]
        # collapse repeated identical children
        out = []
        for k in kids:
            if out and out[-1][0] == k:
                out[-1][1] += 1
            else:
                out.append([k, 1])
        s += "(" + ",".join(k + ("*" if n > 1 else "") for k, n in out) + ")"
    return s

def sections(root):
    body = root.find("body")
    def top(el):
        for c in el:
            if not isinstance(c.tag, str) or c.tag in ("script", "style"):
                continue
            cls = set((c.get("class") or "").split())
            if cls & {"page-main", "page-wrap"}:
                yield from top(c)
            elif c.tag == "section" and not (c.get("class")) and len(c) and c[0].tag == "section":
                yield from top(c)
            elif c.get("id") == "inquiery":
                yield from top(c)
            else:
                yield c
    return list(top(body))

src = sys.argv[1]
groups = collections.defaultdict(list)
for f in sorted(os.listdir(src)):
    if not f.endswith(".html") or f in SKIP:
        continue
    root = html.parse(os.path.join(src, f)).getroot()
    for i, s in enumerate(sections(root)):
        cls = set(norm_classes(s))
        if cls & CHROME:
            continue
        sig = shape(s, 4)
        groups[sig].append(f"{f}#{i}")
print("distinct shapes:", len(groups))
for sig, v in sorted(groups.items(), key=lambda x: -len(x[1])):
    h = hashlib.md5(sig.encode()).hexdigest()[:6]
    print(f"{len(v):3d} {h} {v[0]:40s} {sig[:170]}")
