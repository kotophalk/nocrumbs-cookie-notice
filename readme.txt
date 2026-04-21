=== No Crumbs ===
Contributors: kotophalk
Tags: cookie, notice, 152-fz, privacy, compliance
Requires at least: 5.0
Tested up to: 6.9
Stable tag: 1.0.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A lightweight, zero-bloat cookie consent notice plugin for WordPress. Compliant with Russian Federal Law 152-FZ. No impact on page load speed.

== Description ==

**No Crumbs** is an ultra-lightweight WordPress plugin built on the "install and forget" principle. It provides a cookie consent notice compliant with Russian Federal Law 152-FZ without adding any bloat to your site.

= Key Features =

* 🪶 **Zero Bloat.** The frontend runs on pure Vanilla JS and CSS3. Total asset weight is under 5 KB. No jQuery, no external fonts.
* ⚡ **Cache-Compatible.** Cookie checks are performed entirely on the client side, so the plugin works seamlessly with WP Rocket, LiteSpeed, Cloudflare, and any CDN.
* 🎨 **Sleek Minimalism.** A clean card-style notification in the bottom-left corner with smooth animations. Fully responsive on mobile devices.
* 🛡️ **Secure.** The code uses native WordPress escaping functions. Scripts and styles are not loaded in the admin panel.
* 🇷🇺 **152-FZ Out of the Box.** Ready-to-use cookie notice text in Russian. Automatic link to the Privacy Policy page from WordPress settings.

= How It Works =

1. The server renders the banner HTML in a hidden state (compatible with any page cache).
2. Client-side JavaScript checks for the consent cookie.
3. If no cookie is found, the banner smoothly fades in.
4. After clicking "OK", a cookie is set for 30 days and the banner disappears.

== Installation ==

1. Upload the `no-crumbs` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the "Plugins" menu in WordPress.
3. Make sure you have a Privacy Policy page selected under `Settings → Privacy`. The plugin will automatically pick up the link.

That's it! No additional configuration is needed.

== Frequently Asked Questions ==

= Do I need to configure anything after installation? =

No. The plugin works immediately after activation. The only recommendation is to make sure a Privacy Policy page is selected in WordPress (Settings → Privacy).

= Will the plugin affect my site's loading speed? =

No. The combined size of JS and CSS is under 5 KB. The plugin does not use jQuery and does not load any external fonts or libraries.

= Is the plugin compatible with WP Rocket / LiteSpeed / Cloudflare? =

Yes. Cookie checks are performed entirely in the browser (client-side JavaScript), so cached pages work correctly.

= How long does the user's consent last? =

30 days. After that period, the banner will appear again.

= Can I customize the text or design of the banner? =

In the current version (MVP), the text and design are fixed. Customization options are planned for future releases.

== Changelog ==

= 1.1.0 =
* Added branding action links ("Техблог СТОДУМ" and "Больше инструментов") to the plugin row on the Plugins page.

= 1.0.0 =
* Initial release.
* Cookie consent banner in card style.
* Russian Federal Law 152-FZ compliance out of the box.
* Zero Bloat: Vanilla JS + CSS3, under 5 KB total.
* Full cache compatibility (WP Rocket, LiteSpeed, Cloudflare).
* Automatic link to the Privacy Policy page from WordPress settings.
* Internationalization (i18n) with POT file.

== Upgrade Notice ==

= 1.1.0 =
Adds quick-access links to the Stodm ecosystem in the plugin row on the Plugins page.

= 1.0.0 =
Initial stable release.
