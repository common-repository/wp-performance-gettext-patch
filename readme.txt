=== Plugin Name ===
Contributors: xeno010
Tags: performance, l10n, patch, cache, gettext
Requires at least: 3.7.0
Tested up to: 3.7.1
Stable tag: 0.11

This plugin (patch) implements the native php gettext lib in Wordpress. This accelerates Wordpress extremely. Take a look at benchmarks.

== Description ==

This plugin (patch) implements the native php gettext lib in Wordpress. This accelerates Wordpress extremely.

= Benchmark =

Tool: AB (Apache), requests 10, Windows & Linux

Wordpress 3.3 (new install, no Plugins)

- WP 3.3 without Patch ... 10

- WP 3.3 with Patch ........ 20

Checks the benchmark screenshots

= Translation: =
- English: 100% (thx Alex)
- Deutsch: 100%

= Checks my blog =

http://www.it-gecko.de/mouseover-effekt-fuer-wp-syntax.html

== Installation ==

1. Upload the plugin to your plugins folder: 'wp-content/plugins/'
2. Activate the 'WP-Performance-Gettext-Patch' plugin from the Plugins admin panel.
3. under 'Settings' -> 'WP-Performance-Patch' click on install to install the patch
4. performance enjoy

== Changelog ==

= 0.1 =
* Initial release

= 0.5 =
* Compatible with 3.4.1
* Bugfix

= 0.6 =
* remove anonymous function

= 0.7 =
* LC_ALL -> LC_MESSAGES

= 0.9 =
* Bugfix

= 0.10 =
* Bugfix

= 0.11 =
* Compatible with 3.7.1

== Screenshots ==

1. Bechmark
2. Menu.