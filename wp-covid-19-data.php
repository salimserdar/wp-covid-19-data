<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/salimserdar
 * @since             1.0.0
 * @package           Wp_Covid_19_Data
 *
 * @wordpress-plugin
 * Plugin Name:       WP COVID-19 DATA
 * Description:       This is the plugin to display COVID-19 data from around the world.
 * Version:           1.1.3
 * Author:            Salim Serdar Koksal
 * Author URI:        https://github.com/salimserdar
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-covid-19-data
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WP_COVID_19_DATA_VERSION', '1.1.3' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-covid-19-data-activator.php
 */
function activate_wp_covid_19_data() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-covid-19-data-activator.php';
	Wp_Covid_19_Data_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-covid-19-data-deactivator.php
 */
function deactivate_wp_covid_19_data() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-covid-19-data-deactivator.php';
	Wp_Covid_19_Data_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_covid_19_data' );
register_deactivation_hook( __FILE__, 'deactivate_wp_covid_19_data' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-covid-19-data.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_covid_19_data() {

	$plugin = new Wp_Covid_19_Data();
	$plugin->run();

}
run_wp_covid_19_data();
