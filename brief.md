# Brief: classic WordPress theme (approved 2026-11-08)

- **Mode:** BUILD (site to classic WordPress theme).
- **Goal:** the Osous site as a simple classic theme any WordPress developer understands, edited in the files.
- **Base:** the client's own theme (osous-webflow-theme-17.zip), fixed in place, structure kept.
- **Locked:** page-{slug}.php per page, shared header and footer, text in esc_html_e(), the meta table in functions.php, webflow.js and jQuery, the design and the copy.
- **Fixes in scope:**
  1. CodeSandbox scripts hosted in the theme.
  2. The inline script repeated on every page becomes one JS file.
  3. title-tag support, SEO plugins take over titles and meta.
  4. `__( '' )` removed.
  5. sym-bind, bind and data-wf--* designer attributes removed (the ones webflow.js reads stay).
  6. One template part for the blog hero; the post breadcrumb links to the real blog page.
  7. Pages created on theme activation.
  8. One version number (style.css), readme updated.
- **Out of scope:** design or copy changes, menu editing from the dashboard, speed work.
- **Done when:** every page renders like the original theme, nothing loads from CodeSandbox, PHP lint clean, the contact form sends (Mailpit), the zip installs on a clean WordPress.
- **Output:** D:\abbas\osous-al-taqnia-classic, branch `classic`, dist zip. English, LTR.
- **Stop:** after the fixes, with 5 sample pages shown for approval.
