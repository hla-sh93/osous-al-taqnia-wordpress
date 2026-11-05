# Osous Al Taqnia — WordPress theme

The Osous Al Taqnia website (osoustaqnia.com) as a classic WordPress theme, built from the
Webflow export of November 2026. Every page renders identically to the Webflow original,
measured page by page; nothing Webflow-specific is shipped (no `webflow.js`, no jQuery, no
CDN or CodeSandbox scripts).

**Status: version 0.1.0, not editable yet.** Page content lives in the theme's own files
(`theme/osous/content/`), generated from the export. Making it editable in WordPress is a
later version (see "What is left").

## What is in the repository

```
reference/        the Webflow export, untouched: the reference every check compares against
theme/osous/      the WordPress theme (this is what gets installed)
  functions.php     loads inc/: one file per concern
  inc/              setup, cleanup, security, content, render, assets, seo, contact form, WP-CLI
  header.php, footer.php, index.php, single.php
  template-parts/   the page fallback, the blog list (slot), its card and pager
  content/          GENERATED: page manifests, HTML fragments, the shared parts
  assets/css/       GENERATED except fonts.css and interactions.css
  assets/js/        the site's behaviour, rewritten from Webflow's interactions
  assets/images/    GENERATED: every picture the pages and stylesheets use
tools/            the build and every check (Python, Playwright, WP-CLI wrappers)
docker/           local-only WordPress add-ons (mail to Mailpit)
```

## How it works

- **One template for every designed view.** `index.php` asks `osous_current_manifest()` for
  the view's manifest (a page, the blog and its archives, the 404 page) and prints its tree
  of sections. Single posts use `single.php`, drawn from the Webflow article design.
- **Pages are known by a content key, never by slug.** Each WordPress page carries
  `_osous_content_key`; links in the content are `{{page:<key>}}` and resolve to the page's
  current address at render time, so renaming a page changes nothing else.
- **Shared parts exist once.** Navigation, footer, WhatsApp badge and preloader are one file
  each (`content/site/`), proven identical on every page by the extractor.
- **Everything printed is filtered** through `wp_kses()` with an allow-list generated from the
  content itself (`content/allowed-html.json`) plus the few attributes the templates add.
- **Scripts load only where needed.** One table in `inc/assets.php` lists every script and the
  feature that needs it; each page's manifest lists its features.

## Running it locally

Needs Docker, Python 3.12 with `lxml`, `cssselect`, `tinycss2` and `playwright`, and Node 20+.

```bash
cp .env.example .env            # then fill in the passwords
docker compose up -d
tools/wp.sh core install --url=http://localhost:8100 --title="Osous Al Taqnia" --admin_user=admin --admin_password=... --admin_email=admin@example.test --skip-email
tools/wp.sh rewrite structure '/%postname%/' --hard
tools/wp.sh theme activate osous
tools/wp.sh osous install-pages
```

Site: http://localhost:8100 · Mail (Mailpit): http://localhost:8045

To rebuild the theme's generated files from the export:

```bash
python tools/build.py
```

## Checks

```bash
npm install
php tools/composer.phar install     # or through Docker, see tools/phpcs.sh
python -m http.server 8110 --directory reference   # in another terminal, for the layout checks
tools/check.sh            # everything (about 20 minutes)
tools/check.sh --quick    # everything except the browser comparisons
```

| check | proves | passing looks like |
|---|---|---|
| PHP standards | WordPress Coding Standards + PHP 8.1 compatibility | `19 PHP files, 0 errors, 0 warnings` |
| JS lint | `@wordpress/eslint-plugin` | `7 scripts, 0 problems` |
| CSS lint | `@wordpress/stylelint-config` on the hand-written stylesheets | `2 hand-written stylesheets, 0 problems` |
| duplication | no copied code in the theme or tools (jscpd) | `Found 0 clones` |
| markup vs Webflow | every page's elements, text, links and pictures equal the export's | `0 of 66 pages differ` |
| contact form | delivery, refusals, honeypot, rate limit, no caching | `8 checks, 0 problems` |
| blog | every card is its post, the pager, every post opens | `24 posts on 3 pages checked, 0 problems` |
| security | headers, XML-RPC, user enumeration, theme folder | `10 checks, 0 problems` |
| PHP errors | the debug log stays empty after requesting every page | `PHP debug log empty after every page` |
| interactions | menus and accordions behave as on the original | `9 steps, 0 differences` |
| layout vs Webflow | every box on every page at 1440 and 479, no failed file, no script error | `done at 479x900 -- 0 of 65 pages differ` |

## Deliberate differences from the Webflow original

- **Misspelt names corrected** everywhere: `fotter` → `footer`, `navebar-menu` →
  `navbar-menu`, `magnatic` → `magnetic`, `accordion_qustion` → `accordion-question`,
  `#inquiery` → `#inquiry`, the `endpoint-secuirty-iraq` address → `endpoint-security-iraq`,
  and Webflow's variable names (`--_theme---raddi--card` → `--radius-card`).
- **Variables Webflow had deleted** but still referenced are written as `unset`, which is
  exactly what the browser did with them.
- **Pinned lists re-measure** when their pictures load. The original measured once, so a
  pinned heading's height depended on how fast pictures arrived.
- **Reveal-on-scroll, menus and hovers** are small scripts and CSS (`assets/js/site.js`,
  `assets/css/interactions.css`) instead of Webflow's runtime; keyboard users can open the
  desktop menus (focus) and the accordions (Enter/Space); `prefers-reduced-motion` turns the
  animations off.
- **The blog** lists the site's real WordPress posts in the Webflow card design (the Webflow
  export only had two sample posts) and pages them with WordPress.
- **The contact form** posts to WordPress (it posted nowhere once outside Webflow).
- **Fonts** are served from the theme instead of Google Fonts (same files, same rendering).

## Known upstream gaps (in the Webflow export itself)

- No meta description on: blog, contact, customer-onboarding, e-commerce, mobile-app,
  partners, privacy-policy, reconciliation-system, terms-conditions, website-design.
- Placeholder search titles on some pages ("e-commerce", "mobile app", "blog",
  "privacy policy").
- The three-slide carousels use Swiper's loop mode with too few slides; Swiper itself warns
  about it on the original too.

## Hosting notes

- **Page cache:** the contact page sends no-cache headers and `DONOTCACHEPAGE`; keep it out of
  any cache so its security token stays fresh.
- **Upload limit:** the theme zip is about 15 MB (pictures). Raise PHP's
  `upload_max_filesize` / `post_max_size` above that, or upload the theme folder over SFTP.
- **Mail:** the contact form uses `wp_mail()`; configure SMTP on the live site so messages
  are delivered reliably. Recipient: the site's admin email (filter `osous_contact_recipient`).
- **Server hardening** (TLS, HSTS, blocking `xmlrpc.php`, file permissions) belongs to the host.

## What is left

- Rename Webflow's `w-variant-<id>` classes to readable names (60 rules), with the checks
  proving zero change.
- Live deployment: full backup, staging copy, install, every check against staging, then live.
- Version 2: make every page editable in WordPress (blocks with Elementor-style controls).
