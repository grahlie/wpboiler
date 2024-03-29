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
function grahlie_theme_settings() {
	$theme_options['title'] = 'Theme Options';
	$theme_options['desc']  = 'Your overall settings for your site. Logotype, favicon and also tracking code for Google Analytics';
	$theme_options['id']    = 'theme_options';

	$theme_options[] = array(
		'title' => 'Use logotype',
		'desc'  => 'If you want to use logotype in header check this box.',
		'type'  => 'checkbox',
		'id'    => 'use_logotype',
	);

	$theme_options[] = array(
		'title' => 'Logotype',
		'desc'  => 'Upload your logotype here.',
		'type'  => 'file',
		'id'    => 'logotype_file',
		'val'   => 'Upload image',
	);

	$theme_options[] = array(
		'title' => 'Custom Favicon Upload',
		'desc'  => 'Upload a 32x32 png file as your favicon',
		'type'  => 'file',
		'id'    => 'favicon_file',
		'val'   => 'Upload Image',
	);

	$theme_options[] = array(
		'title' => 'Contact Form Email Address',
		'desc'  => 'Enter the email where you\'d like to receive emails.',
		'type'  => 'text',
		'id'    => 'contact_email',
	);

	$theme_options[] = array(
		'title' => 'Google Analytics',
		'desc'  => 'Your Google analytics code.',
		'type'  => 'text',
		'id'    => 'google_analytics',
	);

	grahlie_add_framework_page( 'Theme Options', $theme_options );
}
add_action( 'admin_init', 'grahlie_theme_settings' );

/**
 * Output the logotype defined in framework pages
 */
function grahlie_use_logotype() {
	$grahlie_values = get_option( 'grahlie_framework_values' );
	$values         = array();

	if ( array_key_exists( 'use_logotype', $grahlie_values ) && 'on' === $grahlie_values['use_logotype'] && '' !== $grahlie_values['logotype_file'] ) {
		$values['show'] = true;
		$values['src']  = $grahlie_values['logotype_file'];
	} else {
		$values['show'] = false;
		$values['src']  = get_bloginfo( 'name' );
	}

	return $values;
}

/**
 * Output the favicon defined in framework pages
 */
function grahlie_use_favicon() {
	$grahlie_values = get_option( 'grahlie_framework_values' );
	$output         = '';

	if ( array_key_exists( 'favicon_file', $grahlie_values ) && '' !== $grahlie_values['favicon_file'] ) {
		$output .= '<link rel="shortcut icon" href="' . $grahlie_values['favicon_file'] . '" />';
	}

	return $output;
}

/**
 * Output the analytics code defined in framework pages
 */
function grahlie_use_analytics() {
	$grahlie_values = get_option( 'grahlie_framework_values' );
	$output         = '';

	if ( array_key_exists( 'google_analytics', $grahlie_values ) && '' !== $grahlie_values['google_analytics'] ) {
		$output .= "
            <script>
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

                ga('create', '" . $grahlie_values['google_analytics'] . "', 'auto');
                ga('send', 'pageview');

                </script>
            ";
	}

	return $output;
}


