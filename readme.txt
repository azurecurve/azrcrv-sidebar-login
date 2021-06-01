=== Sidebar Login ===

Description:	Login via AJAX enabled sidebar widget.
Version:		1.3.1
Tags:			login, sidebar, widget, sidebar login, meta, form, register
Author:			azurecurve
Author URI:		https://development.azurecurve.co.uk/
Plugin URI:		https://development.azurecurve.co.uk/classicpress-plugins/sidebar-login/
Download link:	https://github.com/azurecurve/azrcrv-sidebar-login/releases/download/v1.3.1/azrcrv-sidebar-login.zip
Donate link:	https://development.azurecurve.co.uk/support-development/
Requires PHP:	5.6
Requires:		1.0.0
Tested:			4.9.99
Text Domain:	sidebar-login
Domain Path:	/languages
License: 		GPLv2 or later
License URI: 	http://www.gnu.org/licenses/gpl-2.0.html

Login via AJAX enabled sidebar widget.

== Description ==

# Description

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

### Notes

* Due to AJAX not working across different domains (see [same_origin_policy](http://en.wikipedia.org/wiki/Same_origin_policy)), AJAX logins will be disabled if your site it non-SSL, but the FORCE_SSL_ADMIN constant is set to true. Instead it will fallback to a traditional POST.

== Installation ==

# Installation Instructions

 * Download the plugin from [GitHub](https://github.com/azurecurve/azrcrv-sidebar-login/releases/latest/).
 * Upload the entire zip file using the Plugins upload function in your ClassicPress admin panel.
 * Activate the plugin.
 * Add the widget to a sidebar and configure settings as required.

== Frequently Asked Questions ==

# Frequently Asked Questions

### Can I translate this plugin?
Yes, the .pot fie is in the plugins languages folder and can also be downloaded from the plugin page on https://development.azurecurve.co.uk; if you do translate this plugin, please sent the .po and .mo files to translations@azurecurve.co.uk for inclusion in the next version (full credit will be given).

### Is this plugin compatible with both WordPress and ClassicPress?
This plugin is developed for ClassicPress, but will likely work on WordPress.

== Changelog ==

# Changelog

### [Version 1.3.0](https://github.com/azurecurve/azrcrv-sidebar-login/releases/tag/v1.3.1)
 * Fix bug in loading ajax_handler omly when required.
 
### [Version 1.3.0](https://github.com/azurecurve/azrcrv-sidebar-login/releases/tag/v1.3.0)
 * Update translations to escape strings.
 * Update azurecurve menu and logo.
 
### [Version 1.2.0](https://github.com/azurecurve/azrcrv-sidebar-login/releases/tag/v1.2.0)
 * Fix plugin action link to use admin_url() function.
 * Add plugin icon and banner.
 * Update azurecurve plugin menu.

### [Version 1.1.5](https://github.com/azurecurve/azrcrv-sidebar-login/releases/tag/v1.1.5)
 * Fix bug with sidebar widget links array.

### [Version 1.1.4](https://github.com/azurecurve/azrcrv-sidebar-login/releases/tag/v1.1.4)
 * Fix bug with plugin menu.
 * Update plugin menu css.
 
### [Version 1.1.3](https://github.com/azurecurve/azrcrv-sidebar-login/releases/tag/v1.1.3)
 * Upgrade azurecurve plugin to store available plugins in options.
 
### [Version 1.1.2](https://github.com/azurecurve/azrcrv-sidebar-login/releases/tag/v1.1.2)
 * Update Update Manager class to v2.0.0.
 * Update action link.
 * Update azurecurve menu icon with compressed image.

### [Version 1.1.1](https://github.com/azurecurve/azrcrv-sidebar-login/releases/tag/v1.1.1)
 * Remove duplicate load language function.

### [Version 1.1.0](https://github.com/azurecurve/azrcrv-sidebar-login/releases/tag/v1.1.0)
 * Add integration with Update Manager for automatic updates.
 * Fix issue with display of azurecurve menu.
 * Change settings page heading.
 * Add load_plugin_textdomain to handle translations.

### [Version 1.0.1](https://github.com/azurecurve/azrcrv-sidebar-login/releases/tag/v1.0.1)
 * Update azurecurve menu for easier maintenance.
 * Move require of azurecurve menu below security check.

### [Version 1.0.0](https://github.com/azurecurve/azrcrv-sidebar-login/releases/tag/v1.0.0)
 * Initial release forked from [Sidebar Login by Mike Jolley](https://wordpress.org/plugins/sidebar-login).
 * Add option to change size of avatar.
 * Remove integration with Buddypress.

== Other Notes ==

# About azurecurve

**azurecurve** was one of the first plugin developers to start developing for Classicpress; all plugins are available from [azurecurve Development](https://development.azurecurve.co.uk/) and are integrated with the [Update Manager plugin](https://codepotent.com/classicpress/plugins/update-manager/) by [CodePotent](https://codepotent.com/) for fully integrated, no hassle, updates.

Some of the top plugins available from **azurecurve** are:
* [Add Twitter Cards](https://development.azurecurve.co.uk/classicpress-plugins/add-twitter-cards/)
* [Breadcrumbs](https://development.azurecurve.co.uk/classicpress-plugins/breadcrumbs/)
* [Series Index](https://development.azurecurve.co.uk/classicpress-plugins/series-index/)
* [To Twitter](https://development.azurecurve.co.uk/classicpress-plugins/to-twitter/)
* [Theme Switcher](https://development.azurecurve.co.uk/classicpress-plugins/theme-switcher/)
* [Toggle Show/Hide](https://development.azurecurve.co.uk/classicpress-plugins/toggle-showhide/)