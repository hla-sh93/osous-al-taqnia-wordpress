Osous Al Taqnia (Webflow) 1.1.2
================================

Converted from the Webflow export. A classic WordPress theme: one template per
page, with a shared header and footer.

Setup
-----
1. Appearance -> Themes -> Add New -> Upload Theme, choose this zip, Activate.
2. That's it. On activation the theme:
   - creates one page per template (the slug comes from the file name:
     page-cctv-company-iraq.php -> /cctv-company-iraq/), plus a "Home" page;
   - sets Settings -> Reading -> "A static page" to Home, unless a static front
     page is already set;
   - sets the permalinks to "Post name" when they are still "Plain";
   - publishes WordPress's own "Privacy Policy" draft, so /privacy-policy/
     shows the designed page.
   Pages that already exist are never changed. Activating again only adds the
   pages that are missing.
3. Contact form mail goes to the site's admin email. To change it, use the
   osous_contact_recipient filter. Most hosts need an SMTP plugin for wp_mail().
4. Optional spam protection: Appearance -> Customize -> Cloudflare Turnstile,
   enter the site key and the secret key. With no keys the form works without
   the challenge.

Where things are
----------------
- page-{slug}.php   one file per page; the text is in the file.
- front-page.php    the home page.
- header.php        <head>, preloader and the navigation menu.
- footer.php        the footer.
- single.php        a blog post. template-parts/ holds the blog list and hero.
- functions.php     page titles and descriptions (one table), scripts and
                    styles, the contact form.
- css/pages/        a page's own styles, {slug}.css, loaded on that page only.
- inc/              Turnstile and the page installer.
- js/               the site's own scripts (carousel, scrolling lists, split
                    section, overlapping cards, page scripts such as
                    dell-iraq.js); js/vendor/ holds jQuery, GSAP,
                    ScrollTrigger and Swiper. Nothing loads from other hosts
                    except Google Fonts (and Turnstile on the contact page).

Titles and SEO
--------------
The browser title and meta description of each page come from the table in
functions.php (osous_meta). Any SEO plugin (Yoast, Rank Math, All in One SEO,
SEOPress) takes over the title and the meta tags once it is active, so they can
be edited per page from the dashboard.

Blog posts
----------
Posts use single.php, laid out like the Webflow blog detail page: breadcrumb,
title, author and date, featured image (optional), then the post body. Set the
featured image to the cover picture. The post's excerpt is used as its
description.

The blog page lists the posts, 12 per page, newest first, with page links
under the list (?paged=2 and so on). Each card opens the post.
If you set the blog as the posts page (Settings -> Reading -> Posts page),
home.php shows the same design.

Not converted
-------------
- 401.html (Webflow password page)
- design-system.html (style guide, no site header or footer)
- detail_blogs.html (replaced by the single post template, see Blog posts)

Notes
-----
- Page titles for e-commerce, partners, mobile-app and website-design are the
  short titles from the Webflow drafts. Install an SEO plugin to set proper
  titles, or edit the table in functions.php.
- The slug "endpoint-secuirty-iraq" keeps the spelling of the live Webflow URL
  so existing links and search results still work.
