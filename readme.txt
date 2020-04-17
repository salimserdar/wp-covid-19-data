=== WP COVID-19 DATA ===
Contributors: salimserdar
Tags: COVID-19,WordPress COVID-19,WP COVID-19,COVID-19 Data
Requires at least: 4.0
Tested up to: 5.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WP Covid-19 Data is a plugin which is displaying COVID-19's data such as confirmed, deaths and recovered cases by country.

== Description ==

As COVID-19 (coronavirus) spreads across the globe, this plugin helps the people who want to display Covid-19 data from around the world by country.

**Display specific countries data in banner**

The shortcode is [display_covid_19_data] and accepts the following attributes.

1. countries="Canada,Turkey,China"
*(for multiple countries data)*

2. bg_color="#ffffff"
*(for custom background color)*

3. global_data="false"
*(for disabling to global data on banner)*

Example usage with attributes: 
<pre>[display_covid_19_data countries="Canada,Turkey,China,Germany,India" bg_color="#ffffff"]</pre>

**Display all countries in table**

The other shortcode  is [display_covid_19_global_data] and accepts the following attributes.

1. bg_color="#ffffff"
*(for table custom background color)*

Example usage with attributes: 
<pre>[display_covid_19_global_data bg_color="#000000"]</pre>

**Display historical cases and deaths data in line chart**

this shortcode  is [display_covid_19_data_line_chart] and accepts the following attributes.

1. country="China"
*(for the country you want to display)*

Example usage with attributes: 
<pre>[display_covid_19_data_line_chart country="China"]</pre>

**Where COVID-19 data is coming?**

The plugin is pulling all uptodate COVID-19 data from Novel Covid which is an open sourced API that provides you information about the coronavirus pandemic across the globe.

You can search and view any specific country or location that has been affected by COVID-19.

All information that is provided by our API updates every 10 minutes, giving the best and reliable results.

Their server provides support for those who are in need that wants to create their own projects to show off into the world.

You can find more details regarding Novel Covid API from the their github acccount.
https://github.com/NovelCOVID/API

WP COVID-19 Data plugin use two endpoints listed below.

https://corona.lmao.ninja/all
Returns all total cases, recovery, and deaths. 

https://corona.lmao.ninja/countries?sort={parameter}
Returns data of each country sorted by the parameter

Please find the terms of use or privacy policy of Novel Covid API from the link below.
https://github.com/NovelCOVID/API/blob/master/privacy.md

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `wp-covid-19-data.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place your shorcode mentioned above in your posts and pages.

== Frequently Asked Questions ==

= Which languagee is supported? =

English and Turkish languages is available in this plugin.

= Who should download this plugin? =

This plugin is for site owners who want to display information about the coronavirus pandemic across the globe.
You might be news website or non-profit organization which let people know COVID-19.

= Can I request a new feature? = 

Yes, of course. We'll be happy to add new features as per our users feedback.

== Screenshots ==

1. This screen shot description to show data banner.

2. This is the second screen shot to show table verfion fo Covid 19 data.

3. This is the second screen shot to show Covid 19 data for specific country on line chart.

== Changelog ==

= 1.0.0 =
* First version of the plugin.

= 1.1.0 =
* Line chart added.
* Turkish language support added.
* A new parameter added to [display_covid_19_data]
* Improved the code quality.
* Improved the styylin of banner.
* Readme file updated.

= 1.1.1 =

* css and js min file added

= 1.1.2 =

* fixed minor translation issue

= 1.1.3 =

* deprecated API endpoint updated



