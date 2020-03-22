=== Plugin Name ===
Contributors: (this should be a list of wordpress.org userid's)
Donate link: https://github.com/salimserdar
Tags: comments, spam
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WP Covid-19 Data is a plugin which is displaying COVID-19's data such as confirmed, deaths and recovered cases by country.

== Description ==

As COVID-19 (coronavirus) spreads across the globe, this plugin helps the people who wnat to display Covid-19 data from arounfd the world by country.

The plugin provided two shortcode [display_covid_19_data] and [display_covid_19_global_data]. You can use the shortcode in your posts and pages.

The [display_covid_19_data] is for pulling specific countryies data. You can pass two arguments this shortcode.
For example> [display_covid_19_data countries="Canada,Turkey,China,Germany,India" bg_color="#ffffff"]
If you want to use custom background color for banner, please don't forget the pass bg_color="#ffffff".

The other shortcode is [display_covid_19_global_data bg_color="#000000"] to display all country data on table.
If you wnat to use table custom background color, please don't forget the pass bg_color="#ffffff".


== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `wp-covid-19-data.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place your shorcode mentioned above in your posts and pages.


== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot
