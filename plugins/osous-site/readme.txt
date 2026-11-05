=== Osous Site ===
Contributors: osousaltaqnia
Requires at least: 6.5
Tested up to: 7.1
Requires PHP: 8.1
Stable tag: 0.1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Site-wide security hardening and a quieter page head for the Osous Al Taqnia website.

== Description ==

Kept apart from the theme on purpose: it protects the site whichever theme is active.

* Security headers on every page (no MIME sniffing, no framing by other sites, a strict
  referrer policy, camera/microphone/location/payment off).
* XML-RPC switched off, pingbacks included.
* User names hidden: the REST API does not list users, author archives and ?author=N
  redirect to the home page, and a failed log-in does not say which field was wrong.
* The WordPress version and unused head links (RSD, shortlink, oEmbed, REST, emoji) removed.

Server-level protection (TLS, HSTS, file permissions, a firewall) stays with the host.

== Installation ==

Plugins → Add New Plugin → Upload Plugin, choose osous-site.zip, Install Now, Activate.

== Changelog ==

= 0.1.0 =
* First version.
