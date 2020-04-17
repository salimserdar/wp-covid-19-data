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

		if (!isset($atts["countries"])) {
			return __('You have to pass countries as a parameter. For example, countries="Canada,Turkey,China"', 'wp-covid-19-data') ;
		}

		$atts_countries = explode(',', $atts["countries"]);

		$global_data = 'true';

		if (isset($atts["global_data"]) == 'false') {
			$global_data = 'false';
		}

		if (isset($atts["bg_color"])) {
			$bg_color = $atts["bg_color"];
		}

		ob_start();

		if (isset($bg_color)) {
			echo '<div class="covid-19" style="background-color:' . $bg_color . '">';
		} else {
			echo '<div class="covid-19 covid-19-horizatal">';
		}

		if ($global_data == 'true') {
			echo self::wp_covid_19_data_total();
		}

		foreach ($atts_countries as $atts_country) {

			$countries = self::wp_covid_19_data_pull_remote($atts_country);

			if (isset($countries)) {

				echo '<div class="covid-19__data">';
				if (get_locale() === 'tr_TR' && isset(self::getCountry()[$countries->country])) {
					echo '<span class="covid-19__title">' . self::getCountry()[$countries->country] . '</span>';
				} else {
					echo '<span class="covid-19__title">' . $countries->country . '</span>';
				}
				echo '<span class="covid-19__sub-title">' . __('Cases', 'wp-covid-19-data') . '</span>';
				echo '<span class="covid-19__sub-text">' . $countries->cases . '</span>';
				echo '<span class="covid-19__sub-title">' . __('Recovered', 'wp-covid-19-data') . '</span>';
				echo '<span class="covid-19__sub-text">' . $countries->recovered . '</span>';
				echo '<span class="covid-19__sub-title">' . __('Deaths', 'wp-covid-19-data') . '</span>';
				echo '<span class="covid-19__sub-text">' . $countries->deaths . '</span>';
				echo '</div>';
			}
		}

		echo '</div>';

		return ob_get_clean();
	}

	public function wp_covid_19_data_pull_remote($atts_country)
	{
		$response = wp_remote_get('https://corona.lmao.ninja/v2/countries/' . $atts_country);

		if (is_array($response)) {
			$countries = $response['body']; // use the content
			$countries = json_decode($countries);
		}

		if (isset($countries)) {
			return $countries;
		}
	}

	public function wp_covid_19_data_total()
	{
		$response = wp_remote_get('https://corona.lmao.ninja/v2/all');

		if (is_array($response)) {
			$global_data = $response['body']; // use the content
			$global_data = json_decode($global_data);
		}

		if (isset($global_data)) {
			$output = '';
			$output .= '<div class="covid-19__data">';
			$output .= '<span class="covid-19__title">' . __('Global', 'wp-covid-19-data') . '</span>';
			$output .= '<span class="covid-19__sub-title">' . __('Cases', 'wp-covid-19-data') . '</span>';
			$output .= '<span class="covid-19__sub-text">' . $global_data->cases . '</span>';
			$output .= '<span class="covid-19__sub-title">' . __('Recovered', 'wp-covid-19-data') . '</span>';
			$output .= '<span class="covid-19__sub-text">' . $global_data->recovered . '</span>';
			$output .= '<span class="covid-19__sub-title">' . __('Deaths', 'wp-covid-19-data') . '</span>';
			$output .= '<span class="covid-19__sub-text">' . $global_data->deaths . '</span>';
			$output .= '</div>';

			return $output;
		}
	}

	public function wp_covid_19_data_global_shortcode($atts)
	{
		if (isset($atts["bg_color"])) {
			$bg_color = $atts["bg_color"];
		}

		$response = wp_remote_get('https://corona.lmao.ninja/v2/countries/');

		if (is_array($response)) {
			$global_datas = $response['body']; // use the content
			$global_datas = json_decode($global_datas);
		}

		if (isset($global_datas)) {

			ob_start();

			echo '<table>';
			echo '<thead>';
			echo '<tr>';
			if (isset($bg_color)) {
				echo '<th style="background-color:' . $bg_color . '">' . __('Country', 'wp-covid-19-data') . '</th>';
				echo '<th style="background-color:' . $bg_color . '">' . __('Cases', 'wp-covid-19-data') . '</th>';
				echo '<th style="background-color:' . $bg_color . '">' . __('Today Cases', 'wp-covid-19-data') . '</th>';
				echo '<th style="background-color:' . $bg_color . '">' . __('Deaths', 'wp-covid-19-data') . '</th>';
				echo '<th style="background-color:' . $bg_color . '">' . __('Today Deaths', 'wp-covid-19-data') . '</th>';
				echo '<th style="background-color:' . $bg_color . '">' . __('Recovered', 'wp-covid-19-data') . '</th>';
			} else {
				echo '<th>' . __('Country', 'wp-covid-19-data') . '</th>';
				echo '<th>' . __('Cases', 'wp-covid-19-data') . '</th>';
				echo '<th>' . __('Today Cases', 'wp-covid-19-data') . '</th>';
				echo '<th>' . __('Deaths', 'wp-covid-19-data') . '</th>';
				echo '<th>' . __('Today Deaths', 'wp-covid-19-data') . '</th>';
				echo '<th>' . __('Recovered', 'wp-covid-19-data') . '</th>';
			}
			echo '</tr>';
			echo '</thead>';
			echo '<tbody>';

			foreach ($global_datas as $global_data) {
				echo '<tr>';
				if (get_locale() === 'tr_TR' && isset(self::getCountry()[$global_data->country])) {
					echo '<td data-column="Country">' . self::getCountry()[$global_data->country] . '</td>';
				} else {
					echo '<td data-column="Country">' . $global_data->country . '</td>';
				}
				echo '<td data-column="Cases">' . $global_data->cases . '</td>';
				echo '<td data-column="Today Cases">' . $global_data->todayCases . '</td>';
				echo '<td data-column="Deaths">' . $global_data->deaths . '</td>';
				echo '<td data-column="Today Deaths">' . $global_data->todayDeaths . '</td>';
				echo '<td data-column="Recovered">' . $global_data->recovered . '</td>';
				echo '</tr>';
			}

			echo '</tbody>';
			echo '</table>';

			return ob_get_clean();
		} else {
			echo __('There is no data to display. API might be busy. Please refresh the page!', 'wp-covid-19-data');
		}
	}

	/**
	 * This is the Line Chart shortcode callback function.
	 *
	 * @since    1.0.0
	 */

	public function wp_covid_19_data_line_chart_shortcode($atts)
	{
		if (isset($atts)) {
			$country = $atts["country"];
		}

		$localLanguage = get_locale();

		ob_start();

		echo '<div class="wp-covid-19-canvas" data-country="' . $country . '" data-language="' . $localLanguage . '">';
		echo '<canvas id="' . $country . '" data-country="' . $country . '"></canvas>';
		echo '</div>';

		return ob_get_clean();
	}

	private function getCountry()
	{

		return [
			"Afghanistan" => "Afganistan",
			"Albania" => "Arnavutluk",
			"Algeria" => "Cezayir",
			"Andorra" => "Andorra",
			"Angola" =>	"Angola",
			"Antigua and Barbuda" => "Antigua ve Barbuda",
			"Argentina" => "Arjantin",
			"Armenia" => "Ermenistan",
			"Australia" => "Avustralya",
			"Austria" => "Avusturya",
			"Azerbaijan" => "Azerbaycan",
			"Bahamas" => "Bahamalar",
			"Bahrain" => "Bahreyn",
			"Bangladesh" => "Bangladeş",
			"Barbados" => "Barbados",
			"Belarus" => "Belarus",
			"Belgium" => "Belçika",
			"Belize" => "Belize",
			"Benin" => "Benin",
			"Bhutan" => "Butan",
			"Bolivia" => "Bolivya",
			"Bosnia and Herzegovina" =>	"Bosna Hersek",
			"Botswana" => "Botsvana",
			"Brazil" =>	"Brezilya",
			"Brunei" =>	"Brunei",
			"Bulgaria" => "Bulgaristan",
			"Burkina Faso" => "Burkina Faso",
			"Burundi" => "Burundi",
			"Cambodia" => "Kamboçya",
			"Cameroon" => "Kamerun",
			"Canada" =>	"Kanada",
			"Cape Verde" =>	"Yeşil Burun Adaları",
			"Central African Republic" => "Orta Afrika Cumhuriyeti",
			"Chad" => "Çad",
			"Chile" => "Şili",
			"China" => "Çin",
			"Colombia" => "Kolombiya",
			"Comoros" => "Comoros",
			"Congo (Brazzaville)" => "Kongo (Brazzaville)",
			"Congo" => "Kongo",
			"Costa Rica" =>	"Kosta Rika",
			"Cote d'Ivoire" => "Fildişi Sahili",
			"Croatia" => "Hırvatistan",
			"Cuba" => "Küba",
			"Cyprus" =>	"Kıbrıs",
			"Czechia" => "Çek Cumhuriyeti",
			"Channel Islands" => "Channel Islands",
			"Denmark" => "Danimarka",
			"Djibouti" => "Cibuti",
			"Dominica" => "Dominika",
			"Dominican Republic" => "Dominik Cumhuriyeti",
			"Diamond Princess" => "Diamond Princess",
			"East Timor (Timor Timur)" => "Doğu Timor (Timor Timur)",
			"Ecuador" => "Ekvador",
			"Egypt" => "Mısır",
			"El Salvador" => "El Salvador",
			"Equatorial Guinea" => "Ekvator Ginesi",
			"Eritrea" => "Eritre",
			"Estonia" => "Estonya",
			"Ethiopia" => "Etiyopya",
			"Fiji" => "Fiji",
			"Finland" => "Finlandiya",
			"France" => "Fransa",
			"Faeroe Islands" => "Faeroe Adaları",
			"Gabon" => "Gabon",
			"Gambia" => "Gambiya",
			"Georgia" => "Gürcistan",
			"Germany" => "Almanya",
			"Ghana" => "Gana",
			"Greece" => "Yunanistan",
			"Grenada" => "Grenada",
			"Guatemala" => "Guatemala",
			"Guinea" => "Gine",
			"Guinea-Bissau" => "Gine-Bissau",
			"Guyana" => "Guyana",
			"Guadeloupe" => "Guadeloupe",
			"Haiti" => "Haiti",
			"Honduras" => "Honduras",
			"Hungary" => "Macaristan",
			"Hong Kong" => "Hong Kong",
			"Iceland" => "İzlanda",
			"India" => "Hindistan",
			"Indonesia" => "Endonezya",
			"Iran" => "İran",
			"Iraq" => "Irak",
			"Ireland" => "İrlanda",
			"Israel" => "İsrail",
			"Italy" => "İtalya",
			"Ivory Coast" => "Ivory Coast",
			"Jamaica" => "Jamaika",
			"Japan" => "Japonya",
			"Jordan" => "Ürdün",
			"Kazakhstan" => "Kazakistan",
			"Kenya" => "Kenya",
			"Kiribati" => "Kiribati",
			"Korea, North" => "Kuzey Kore",
			"S. Korea" => "Güney Kore",
			"Kuwait" => "Kuveyt",
			"Kyrgyzstan" => "Kırgızistan",
			"Laos" => "Laos",
			"Latvia" =>	"Letonya",
			"Lebanon" => "Lübnan",
			"Lesotho" => "Lesoto",
			"Liberia" => "Liberya",
			"Libya" => "Libya",
			"Liechtenstein" => "Lihtenştayn",
			"Lithuania" => "Litvanya",
			"Luxembourg" => "Lüksemburg",
			"Macedonia" => "Makedonya",
			"Madagascar" => "Madagaskar",
			"Malawi" =>	"Malawi",
			"Malaysia" => "Malezya",
			"Maldives" => "Maldivler",
			"Mali" => "Mali",
			"Malta" => "Malta",
			"Marshall Islands" => "Marşal Adaları",
			"Mauritania" => "Moritanya",
			"Mauritius" => "Mauritius",
			"Mexico" => "Meksika",
			"Micronesia" => "Mikronezya",
			"Moldova" => "Moldova",
			"Monaco" =>	"Monaco",
			"Mongolia" => "Moğolistan",
			"Morocco" => "Fas",
			"Mozambique" => "Mozambik",
			"Myanmar" => "Myanmar",
			"Namibia" => "Namibya",
			"Nauru" => "Nauru",
			"Nepal" => "Nepal",
			"Netherlands" => "Hollanda",
			"New Zealand" => "Yeni Zelanda",
			"Nicaragua" => "Nikaragua",
			"Niger" => "Nijer",
			"Nigeria" => "Nijerya",
			"Norway" => "Norveç",
			"North Macedonia" => "Kuzey Makedonya",
			"Oman" => "Umman",
			"Pakistan" => "Pakistan",
			"Palau" =>	"Palau",
			"Panama" =>	"Panama",
			"Papua New Guinea" => "Papua Yeni Gine",
			"Paraguay" => "Paraguay",
			"Palestine" => "Filistin",
			"Peru" => "Peru",
			"Philippines" => "Filipinler",
			"Poland" =>	"Polonya",
			"Portugal" => "Portekiz",
			"Qatar" =>	"Katar",
			"Romania" => "Romanya",
			"Russia" =>	"Rusya",
			"Rwanda" =>	"Ruanda",
			"Réunion" => "Réunion",
			"Saint Kitts and Nevis" => "Saint Kitts ve Nevis",
			"Saint Lucia" => "Saint Lucia",
			"Saint Vincent" => "Saint Vincent",
			"Samoa" => "Samoa",
			"San Marino" =>	"San Marino",
			"Sao Tome and Principe" => "Sao Tome ve Principe",
			"Saudi Arabia" => "Suudi Arabistan",
			"Senegal" => "Senegal",
			"Serbia" => "Sırbistan",
			"Seychelles" =>	"Seychelles",
			"Sierra Leone" => "Sierra Leone",
			"Singapore" => "Singapur",
			"Slovakia" => "Slovakya",
			"Slovenia" => "Slovenya",
			"Solomon Islands" => "Solomon Adaları",
			"Somalia" => "Somali",
			"South Africa" => "Güney Afrika",
			"Spain" => "İspanya",
			"Sri Lanka" => "Sri Lanka",
			"Sudan" => "Sudan",
			"Suriname" => "Surinam",
			"Swaziland" => "Svaziland",
			"Sweden" =>	"İsveç",
			"Switzerland" => "İsviçre",
			"Syria" =>	"Suriye",
			"Taiwan" =>	"Tayvan",
			"Tajikistan" =>	"Tacikistan",
			"Tanzania" => "Tanzanya",
			"Thailand" => "Tayland",
			"Togo" => "Gitmek",
			"Tonga" => "Tonga",
			"Trinidad and Tobago" => "Trinidad ve Tobago",
			"Tunisia" => "Tunus",
			"Turkey" =>	"Türkiye",
			"Turkmenistan" => "Türkmenistan",
			"Tuvalu" =>	"Tuvalu",
			"Uganda" =>	"Uganda",
			"Ukraine" => "Ukrayna",
			"UAE" => "Birleşik Arap Emirlikleri",
			"UK" => "Birleşik Krallık",
			"USA" => "ABD",
			"Uruguay" => "Uruguay",
			"Uzbekistan" => "Özbekistan",
			"Vanuatu" => "Vanuatu",
			"Vatican City" => "Vatikan Şehri",
			"Venezuela" => "Venezuela",
			"Vietnam" => "Vietnam",
			"Yemen" => "Yemen",
			"Zambia" => "Zambiya",
			"Zimbabwe" => "Zimbabve"
		];
	}
}
