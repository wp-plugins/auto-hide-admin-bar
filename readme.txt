=== Auto Hide Admin Bar ===
Contributors: mbootsman
Donate link: http://www.nostromo.nl/wordpress-plugins/auto-hide-admin-bar
Tags: adminbar, admin bar, autohide, auto, hide, toolbar
Requires at least: 3.1
Tested up to: 3.5
Stable tag: 0.7

This plugin adds an auto-hide feature to the WordPress Admin Bar that was introduced in WordPress 3.1. Sind WordPress 3.3 the Admin Bar is called Toolbar.

== Description ==

Since WordPress 3.3 the Admin Bar is called Toolbar, but this plugin will keep its name.
This plugin makes the Toolbar disappear. When hovering over the top of the site, the Toolbar is magically returned.
You end up with more screen real estate and the added functionality of the WordPress Toolbar.
If you have any comments or questions, please use the support forum: http://wordpress.org/support/plugin/auto-hide-admin-bar

== Installation ==

1. Upload `auto-hide-admin-bar` directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. We're all done, now you have an auto hiding Toolbar.

== Frequently Asked Questions ==

== Screenshots ==
How do we make screenshots of things that are hidden? :)

== Changelog ==

= 0.7 =
* Removed external jQuery library.
* Added options page.
* Added options for animation speed, delay and mouse polling interval.

= 0.6.3 =
* Changed background-position to background-position-y, because of IE8 problem (of course...). Thanks to per (feja@home.se) for submitting the bug, and the jQuery bugtracker for the hint: http://bugs.jquery.com/ticket/11838

= 0.6.2 =
* Added style adjustment for body background.

= 0.6.1 =
* Switched wp_enqueue_script sequence for jquery and jquery.hoverintent due to problems.

= 0.6 =
* By request, added delay for showing/hiding the Admin Bar. A settings page will be included in the future.

= 0.5 =
* Changed position of hidden div to fixed, so the admin bar is showed also when you have scrolled down on your site.

= 0.4 =
* Changed jQuery enqueue manner. Now using the wp_print_scripts hook. Thanks to Ralph from zonebattler.net for mentioning this bug.

= 0.3 =
* Added - Only activate the plugin when a user is logged in.

= 0.2 =
* Added  - wp_enqueue_script for jQuery

= 0.1 =
* Initial Release