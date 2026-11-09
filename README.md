# Osous Al Taqnia: classic WordPress theme

The Osous Al Taqnia website as a classic WordPress theme, converted from the Webflow export.
One template per page, a shared header and footer, and the page text written in each template.

The theme itself is in [`osous-webflow/`](osous-webflow/); its [`readme.txt`](osous-webflow/readme.txt)
explains installation, where each part lives, titles and SEO, and the blog.

## Local development

Requirements: Docker Desktop.

```bash
cp .env.example .env        # then set your own passwords
docker compose up -d
tools/wp.sh core install --url=http://127.0.0.1:8200 --title="Osous Al Taqnia" \
  --admin_user=admin --admin_password=<password> --admin_email=admin@osous.test --skip-email
tools/wp.sh theme activate osous-webflow
```

- Site: http://127.0.0.1:8200 (the theme folder is mounted, edits show on reload).
- Mail from the contact form: http://127.0.0.1:8245 (Mailpit).
- Activating the theme creates every page and sets the home page.
- To test the blog with real posts, export them from a WordPress REST API
  (`/wp-json/wp/v2/posts?_embed&per_page=100`) to `tools/posts.json`, then run
  `tools/wp.sh eval-file /tools/import-posts.php /tools/posts.json` (existing slugs are skipped).
  Keep `posts.json` out of git.

## Release

1. Raise `Version` in `osous-webflow/style.css` (the theme reads its version from there).
2. `python tools/package.py` writes `dist/osous-webflow-<version>.zip`, ready for
   Appearance > Themes > Upload Theme.

## History

The earlier generator-based build is kept on `main` and under the tag `generator-final`.
