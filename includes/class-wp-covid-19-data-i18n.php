<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/salimserdar
 * @since      1.0.0
 *
 * @package    Wp_Covid_19_Data
 * @subpackage Wp_Covid_19_Data/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wp_Covid_19_Data
 * @subpackage Wp_Covid_19_Data/includes
 * @author     Salim Serdar Koksal <salimserdar@gmail.com>
 */
class Wp_Covid_19_Data_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-covid-19-data',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
