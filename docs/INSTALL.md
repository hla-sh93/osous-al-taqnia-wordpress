# Installing the Osous Al Taqnia website on WordPress

Version 0.2.0

## What is in the package

| File | What it is |
|---|---|
| `osous.zip` | The website theme: every page, the blog, the contact form, the 404 page |
| `osous-site.zip` | The companion plugin: security hardening and a quieter page head |
| `screenshot.png` | How the theme appears in Appearance → Themes |
| `source/` | The complete source code, the build tools and every check (for developers) |

## Requirements

- WordPress 6.5 or later (tested on 7.1), PHP 8.1 or later.
- Permalinks set to **Post name** (Settings → Permalinks).
- An upload limit of at least **32 MB**: the theme zip is about 14 MB because of the site's
  pictures. If the host's limit is lower, ask the host to raise it, or upload the `osous`
  folder to `wp-content/themes/` over SFTP.

## Before installing on a site that is already live

Take a full backup of the files and the database. The installation creates the missing
pages; a page that already exists with the same address is used in place (it keeps its ID
and address). Nothing is deleted.

## Steps

1. **Plugin:** Plugins → Add New Plugin → Upload Plugin → choose `osous-site.zip` →
   Install Now → Activate.
2. **Theme:** Appearance → Themes → Add New Theme → Upload Theme → choose `osous.zip` →
   Install Now → Activate.
3. **Pages:** activation installs the site's 66 pages and sets the home page and the blog
   page by itself. Appearance → **Site pages** shows how many are in place; the
   **Install the pages** button runs it again at any time.
4. **Permalinks:** Settings → Permalinks → Post name → Save.
5. Open the home page and a few pages to confirm.

## After installing

- **Contact form:** messages go to the administration email (Settings → General). Set up
  SMTP (for example with an SMTP plugin) so they are delivered reliably.
- **Cache plugins:** the contact page tells caches not to store it. If a cache plugin
  ignores that, exclude `/contact/` from the cache.
- **SEO plugin (optional):** the theme already prints each page's title, description and
  sharing tags. With Yoast SEO, Rank Math, All in One SEO or The SEO Framework active, the
  plugin takes over.
- **Blog:** existing posts appear automatically on the blog page in the site's design.

## Notes

- Page content ships with the theme in this version (it is not edited in WordPress yet).
- Some pages in the original design have no search description; they can be added in an
  SEO plugin.
