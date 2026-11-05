=== Osous ===
Contributors: osousaltaqnia
Requires at least: 6.5
Tested up to: 7.1
Requires PHP: 8.1
Stable tag: 0.2.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

The Osous Al Taqnia website.

== Description ==

The theme draws the Osous Al Taqnia website: its pages, its blog and articles, the contact
form and the 404 page, exactly as designed. Page content ships with the theme in
content/ and is put into WordPress automatically when the theme is activated.

== Installation ==

1. In the dashboard, go to Appearance → Themes → Add New Theme → Upload Theme, choose
   osous.zip and click Install Now, then Activate.
2. Activation creates the site's pages (existing pages with the same address are filled in
   place, nothing is deleted), sets the home page and the blog page.
3. Appearance → Site pages shows how many pages are in place and can install them again.

From the command line: `wp theme install osous.zip --activate` then `wp osous install-pages`.

== Frequently Asked Questions ==

= Who receives the contact form's messages? =

The site's administration email (Settings → General). A developer can change it with the
`osous_contact_recipient` filter.

= Does it work with an SEO plugin? =

Yes. The theme prints the search title, description and sharing tags itself; when Yoast SEO,
Rank Math, All in One SEO or The SEO Framework is active, the theme leaves them to it.

== Changelog ==

= 0.2.0 =
* The theme installs the site's pages itself when activated; Appearance → Site pages.
* Security hardening and head cleanup moved to the companion plugin Osous Site.
* Theme screenshot, translation template, WordPress content classes, clean picture names.

= 0.1.0 =
* First version: every page of the Webflow design, the blog, the contact form, the 404 page.

== Copyright ==

Osous, Copyright 2026 Osous Al Taqnia.
Osous is distributed under the terms of the GNU GPL version 2 or later.

This theme bundles the following third-party resources:

GSAP and ScrollTrigger 3.15.0, Copyright GreenSock / Webflow
License: GreenSock Standard "No Charge" License, https://gsap.com/standard-license
Source: https://gsap.com

Swiper 11.2.10, Copyright Vladimir Kharlampidi
License: MIT, https://opensource.org/licenses/MIT
Source: https://swiperjs.com

Inter, Copyright The Inter Project Authors
License: SIL Open Font License 1.1, https://openfontlicense.org
Source: https://fonts.google.com/specimen/Inter

Sora, Copyright The Sora Project Authors
License: SIL Open Font License 1.1, https://openfontlicense.org
Source: https://fonts.google.com/specimen/Sora

Pictures, logos and text in assets/images and content/: Copyright Osous Al Taqnia and
the respective brand owners; used by permission on the Osous Al Taqnia website only.
