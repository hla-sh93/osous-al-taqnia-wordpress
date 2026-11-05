# Working on this project

Read this before changing anything. Companion: [README.md](README.md).

## Rules

1. **Correctness is measured, never eyeballed.** Every change ends with `tools/check.sh`
   (or `--quick` plus the browser checks it touches) and its output. A check passes only by
   its counted sentence; a table, one row per page, beats one "all green".
2. **`reference/` is never edited.** It is the Webflow export and the source of truth.
3. **Generated files are never edited by hand:** `theme/osous/content/`,
   `theme/osous/assets/css/{base,framework,tokens,site}.css`, `theme/osous/assets/images/`.
   Change `tools/build_css.py` or `tools/extract.py` and run `python tools/build.py`.
4. **No Webflow runtime, no CDN, no CodeSandbox.** Behaviour lives in `assets/js/`, hover and
   open states in `assets/css/interactions.css`.
5. **One source for everything.** Shared parts in `content/site/`, every script in the table
   in `inc/assets.php`, every allowed tag in the generated allow-list, every page found by
   its content key. No copy-paste: `jscpd` runs in the checks.
6. **WordPress Coding Standards, zero warnings.** A `phpcs:ignore` is only for what the sniff
   cannot know, with the reason after `--` on the same line. Escaping helpers that filter
   through `wp_kses()` are listed in `phpcs.xml.dist` instead of ignoring each echo.
7. **Never touch another project's stack.** This project is `osous-wp` on ports 8100 (site)
   and 8045 (mail). `osous` (8080/8081/8025) and `harlow` belong to other projects: check
   `docker compose ls` before anything that removes containers or volumes.
8. **Commits are authored by the owner only**, in short plain messages.

## Hazards met, and how they were caught

| hazard | caught by | fix |
|---|---|---|
| CSS background pictures (37) never copied: only `<img>` pictures were collected | a page's failed-file list in the layout check | `extract.py` reads the built stylesheets for `url(../images/...)` |
| Webflow's embedded `<script>` blocks left in the content; the HTML filter mangled `=>` into `=&gt;` | script error on the e-commerce page in the layout check | the extractor drops embedded scripts, styles and comments; their behaviour is in `assets/js/` |
| A third CodeSandbox script (`split-section.js`) on one page only | the Microsoft 365 page's height in the layout check | list every external script across all pages before porting |
| A feature turned on by markup alone (feature cards without their script) | page height on the Microsoft 365 page | `FEATURES` needs the markup and the original's script |
| Reveal animations never played on elements clipped by a parent or off to the side | boxes 100px left of where they belong | reveal by the box's vertical position (as Webflow did), not IntersectionObserver |
| Pinned heading height frozen at whatever height pictures had when measured | the same page measuring 975, then 1004 on the original | re-measure pins when list pictures load; the layout check refreshes both sites before measuring |
| `:where(.w-variant-…)` stripped as a pseudo-class, so rules for unused variants were kept | 210 variant rules in the output | inline `:where/:is` around one compound selector before matching |
| Webflow references to deleted variables (`<deleted\|variable-…>`) | grep of the built CSS | written as `unset`, the browser's own reading |
| Text 1–3px wider: fonts declared as a weight range | per-heading width comparison | declare each weight separately, exactly as Google Fonts does |
| `wordpress@localhost` refused by PHPMailer (no dot in the host) | the contact check's delivery step | local mu-plugin sets a sender with a dot (local only) |
| Every link to `/blog/` marked current on blog page 2, including "Previous" and "1" | `verify_blog.py` | slots are filled after the design's links are marked |
| Regenerating content left the live site reading a half-written folder (PHP warnings) | the PHP debug log | build into `content.next`, then swap in two renames |
| Windows wrote CRLF into generated files | `phpcs` (line endings) | every writer passes `newline="\n"`; `.gitattributes` enforces LF |
| XML-RPC "disabled" still answered pingbacks | `verify_security.py` | remove every method (`xmlrpc_methods`) |
| The contact rate limit tripped by repeated test runs | the contact check failing on its second run | the check clears the limit first, then tests it explicitly |

## Checks and what passing looks like

See the table in README.md. Browser checks need the reference served on port 8110:
`python -m http.server 8110 --bind 127.0.0.1 --directory reference`.

## Local data

`_local/` (ignored by git) holds posts fetched from the live site's public REST API for
testing the blog; `tools/import-posts.php` puts them into the local WordPress.

## Since 0.2.0

- **Theme and plugin are separate on purpose.** The theme is how the site looks (and its
  content); `plugins/osous-site` is site-wide protection that must not disappear when the
  theme changes. WordPress's Theme Check flags head cleanup inside a theme as plugin territory.
- **The theme installs its own pages** on activation (`inc/install.php`), the same code as
  Appearance → Site pages and `wp osous install-pages`.
- **Picture names are cleaned** (`common.asset_filename`) the same way in the markup, the
  stylesheets and the copied files; two pictures that would share a name stop the build.
- **Escapes written through shell heredocs turned `\1` and `\n` into control characters and
  line breaks** three times. Write such code with the editor, and grep for `\x01` after.
- **Every delivery is tested on a clean WordPress:** `python tools/package.py && tools/handoff-test.sh`.
