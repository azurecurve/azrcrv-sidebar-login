=== Sidebar Login ===
Contributors: azurecurve
Tags: login, sidebar, widget, sidebar login, meta, form, register
Plugin URI: https://development.azurecurve.co.uk/classicpress-plugins/avatars/
Donate link: https://development.azurecurve.co.uk/support-development/
Requires at least: 1.0.0
Tested up to: 1.0.0
Requires PHP: 5.6
Stable tag: master
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Login via AJAX enabled sidebar widget.

== Description ==
Sidebar Login adds a useful login widget which can be used to login from in the sidebar of your ClassicPress powered blog; once a user logs in they are redirected back to the page they logged in from rather than the admin panel (this is configurable).

The following tags can be used in the widget settings for titles and links and will be replaced at runtime:
* `%username%` - logged in users display name
* `%userid%` - logged in users ID
* `%firstname%` - logged in users firstname
* `%lastname%` - logged in users lastname
* `%name%` - logged in users firstname and lastname
* `%admin_url%` - url to WP admin
* `%logout_url%` - logout url
* `%avatar%` - User Avatar

= Notes =
* Due to AJAX not working across different domains (see [same_origin_policy](http://en.wikipedia.org/wiki/Same_origin_policy)), AJAX logins will be disabled if your site it non-SSL, but the FORCE_SSL_ADMIN constant is set to true. Instead it will fallback to a traditional POST.

== Installation ==
To install the Sidebar Login plugin:
* Download the plugin from [GitHub](https://github.com/azurecurve/azrcrv-sidebar-login/)
* Upload the entire zip file using the Plugins upload function in your ClassicPress admin panel.
* Activate the plugin.
* Add the widget to a sidebar and configure settings as required.

== Changelog ==
Changes and feature additions for the Sidebar Login plugin:
= 1.0.0 =
* First version forked from [Sidebar Login by Mike Jolley](https://wordpress.org/plugins/sidebar-login).
* Add option to change size of avatar.
* Remove integration with Buddypress.

== Frequently Asked Questions ==
= Can I translate this plugin? =
* Yes, the .pot fie is in the plugin's languages folder and can also be downloaded from the plugin page on https://development.azurecurve.co.uk; if you do translate this plugin please sent the .po and .mo files to translations@azurecurve.co.uk for inclusion in the next version (full credit will be given).
= Is this plugin compatible with both WordPress and ClassicPress? =
* This plugin is developed for ClassicPress, but will likely work on WordPress.