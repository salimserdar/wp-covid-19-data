<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       https://github.com/salimserdar
 * @since      1.0.0
 *
 * @package    Wp_Covid_19_Data
 * @subpackage Wp_Covid_19_Data/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Wp_Covid_19_Data
 * @subpackage Wp_Covid_19_Data/includes
 * @author     Salim Serdar Koksal <salimserdar@gmail.com>
 */
class Wp_Covid_19_Data_Shortcode_Template
{

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
	}

	/**
	 * Initialize the functions for registered shortcode.
	 *
	 * @since    1.0.0
	 * @param    string               $hook             The name of the WordPress action that is being registered.
	 * @param    object               $component        A reference to the instance of the object on which the action is defined.
	 * @param    string               $callback         The name of the function definition on the $component.
	 * @param    int                  $priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int                  $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1.
	 */
	private function init()
	{
	}

	public function wp_covid_19_data_display_shortcode($atts)
	{

		ob_start();

		echo '<div class="covid-19 covid-19-horizatal">';

		echo self::wp_covid_19_data_total();

		$atts_countries = explode(',', $atts["countries"]);

		foreach ($atts_countries as $atts_country) {

			$countries = self::wp_covid_19_data_pull_remote($atts_country);

			if ($countries) {

				echo '<div class="covid-19__global">';
				echo '<span class="covid-19__title">' . $countries->country . '</span>';
				echo '<span class="covid-19__sub-title">Cases</span>';
				echo '<span class="covid-19__sub-text">' . $countries->cases . '</span>';
				echo '<span class="covid-19__sub-title">Recovered</span>';
				echo '<span class="covid-19__sub-text">' . $countries->recovered . '</span>';
				echo '<span class="covid-19__sub-title">Deaths</span>';
				echo '<span class="covid-19__sub-text">' . $countries->deaths . '</span>';
				echo '</div>';
			}
		}

		echo '</div>';

		return ob_get_clean();
	}

	public function wp_covid_19_data_pull_remote($atts_country)
	{
		$response = wp_remote_get('https://corona.lmao.ninja/countries/' . $atts_country);

		if (is_array($response)) {
			$countries = $response['body']; // use the content
			$countries = json_decode($countries);
		}

		return $countries;
	}

	public function wp_covid_19_data_total()
	{
		$response = wp_remote_get('https://corona.lmao.ninja/all');

		if (is_array($response)) {
			$global_data = $response['body']; // use the content
			$global_data = json_decode($global_data);
		}

		if ($global_data) {
			$output .= '<div class="covid-19__global">';
			$output .= '<span class="covid-19__title">Global</span>';
			$output .= '<span class="covid-19__sub-title">Cases</span>';
			$output .= '<span class="covid-19__sub-text">' . $global_data->cases . '</span>';
			$output .= '<span class="covid-19__sub-title">Recovered</span>';
			$output .= '<span class="covid-19__sub-text">' . $global_data->recovered . '</span>';
			$output .= '<span class="covid-19__sub-title">Deaths</span>';
			$output .= '<span class="covid-19__sub-text">' . $global_data->deaths . '</span>';
			$output .= '</div>';
		}

		return $output;
	}

	public function wp_covid_19_data_global_shortcode()
	{
		$response = wp_remote_get('https://corona.lmao.ninja/countries/');

		if (is_array($response)) {
			$global_datas = $response['body']; // use the content
			$global_datas = json_decode($global_datas);
		}

		echo '<table>';
		echo '<thead>';
		echo '<tr>';
		echo '<th>Country</th>';
		echo '<th>Cases</th>';
		echo '<th>Today Cases</th>';
		echo '<th>Deaths</th>';
		echo '<th>Today Deaths</th>';
		echo '<th>Recovered</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';

		foreach ($global_datas as $global_data) {
			echo '<tr>';
			echo '<td data-column="Country">' . $global_data->country . '</td>';
			echo '<td data-column="Cases">' . $global_data->cases . '</td>';
			echo '<td data-column="Today Cases">' . $global_data->todayCases . '</td>';
			echo '<td data-column="Deaths">' . $global_data->deaths . '</td>';
			echo '<td data-column="Today Deaths">' . $global_data->todayDeaths . '</td>';
			echo '<td data-column="Recovered">' . $global_data->recovered . '</td>';
			echo '</tr>';
		}

		echo '</tbody>';
		echo '</table>';
	}
}

new Wp_Covid_19_Data_Shortcode_Template();
