<?php
/**
 * Create Theme option page for admin settings page
 * And Functions for outputting these settings
 *
 *  PHP version 7
 *
 * @category Grahlie_WPBoiler
 * @package  Grahlie_WPBoiler
 * @author   Mathias Grahl <mathias@grahlie.se>
 * @license  GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link     http://grahlie.se
 */

/**
 * Create page.
 */
function grahlie_multisite_settings() {
	$multisite_options['title'] = 'Multisite Options';
	$multisite_options['desc']  = 'Settings for your multisite.';
	$multisite_options['id']    = 'multisite_options';

	$multisite_options[] = array(
		'title' => 'Show language switcher',
		'desc'  => 'If you using multisite for different languages',
		'type'  => 'checkbox',
		'id'    => 'use_language_switcher',
	);

	$multisite_options[] = array(
		'title' => 'Default language',
		'desc'  => 'Write down the WordPress locale you want to use, separated with comma. <br /> More info on <a href="https://make.wordpress.org/polyglots/teams/" target="_blank">Locales</a>',
		'type'  => 'text',
		'id'    => 'default_lang_language_switcher',
	);

	$multisite_options[] = array(
		'title' => 'Other languages',
		'desc'  => 'Write down the WordPress locale you want to use, separated with comma. <br /> More info on <a href="https://make.wordpress.org/polyglots/teams/" target="_blank">Locales</a>',
		'type'  => 'text',
		'id'    => 'lang_language_switcher',
	);

	grahlie_add_framework_page( 'Multisite Options', $multisite_options );
}
add_action( 'admin_init', 'grahlie_multisite_settings' );

/**
 * Output the language switcher
 */
function grahlie_show_language_switcher() {
	$grahlie_values = get_option( 'grahlie_framework_values' );
	return array_key_exists( 'use_language_switcher', $grahlie_values ) && '' !== $grahlie_values['use_language_switcher'];
}

/**
 * Language swithcer languages
 */
function grahlie_list_languages() {
	$grahlie_values = get_option( 'grahlie_framework_values' );
	$output         = array();
	$default_lang   = array( $grahlie_values['default_lang_language_switcher'] );
	$other_lang     = explode( ',', $grahlie_values['lang_language_switcher'] );
	$values         = array_merge( $default_lang, $other_lang );

	foreach ( $values as $key => $value ) {
		$trimmed_value = trim( $value );
		if ( false !== strpos( $value, '_' ) ) {
			$display_value = trim( explode( '_', $value )[1] );
			$href_value    = trim( explode( '_', $value )[0] );
		} else {
			$display_value = trim( $value );
			$href_value    = trim( $value );
		}

		$output[ $key ]['class'] = 'language_' . $display_value;
		$output[ $key ]['title'] = $display_value;
		$output[ $key ]['href']  = $trimmed_value === $grahlie_values['default_lang_language_switcher'] ? '/' : $href_value;
	}

	return $output;
}
