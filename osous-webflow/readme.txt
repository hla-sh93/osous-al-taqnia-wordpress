Osous Al Taqnia (Webflow) 1.0.0
================================

Converted from the Webflow export. One template per page, with a shared
header and footer.

Setup
-----
1. Appearance -> Themes -> Add New -> Upload Theme, choose this zip, Activate.
2. Settings -> Permalinks -> Post name -> Save.
3. Create one page per Webflow page. The page slug is the Webflow file name
   without ".html" (e.g. "about", "cctv-company-iraq"). WordPress uses the
   matching template automatically: page-{slug}.php. The home page uses
   front-page.php and should be given the slug "home".
   Templates are also listed under Page Attributes as "Template Name".
4. Settings -> Reading -> "A static page": Homepage = "home".
5. Delete WordPress's default draft "Privacy Policy" page first, so the
   privacy-policy slug is free.
6. Contact form mail goes to the site's admin email. To change it, use the
   osous_contact_recipient filter. Most hosts need an SMTP plugin for wp_mail().

Blog posts
----------
Posts use single.php, laid out like the Webflow blog detail page: breadcrumb,
title, author and date, featured image (optional), then the post body. Set the
featured image to the cover picture. The post's excerpt is used as its
description.

The blog page lists the posts, 12 per page, newest first, with page links
under the list (?paged=2 and so on). Each card opens the post.
If you set the blog as the posts page (Settings -> Reading -> "A static page"
-> Posts page), home.php shows the same design.

Not converted
-------------
- 401.html (Webflow password page)
- design-system.html (style guide, no site header or footer)
- detail_blogs.html (replaced by the single post template, see Blog posts)

Scripts
-------
Local: jQuery 3.5.1, GSAP 3.15.0, ScrollTrigger 3.15.0, Swiper 11.2.10
(js/vendor/), webflow.js (js/).
Still remote:
- carousel.js (all pages), overlapping-cards.js (home page) and split-section.js
  (Office 365 page), all from the Webflow sandbox host 3kjjlt.csb.app.
To host any of these locally, save the file into js/vendor/ with the same
name as the remote file. The theme uses the local copy when it exists.
(carousel.js, overlapping-cards.js and split-section.js are the only ones
the local-first rule applies to.)

Notes
-----
- Page titles for e-commerce, partners, mobile-app and website-design are the
  short titles from the Webflow drafts. Set proper titles in the editor
  (Page -> Title) and the browser tab will use them.
- The contact form has no spam protection yet.
