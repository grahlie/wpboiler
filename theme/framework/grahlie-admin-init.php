<?php
/**
 * Initilization of every page for framework
 *
 * Initial Setup Framework
 * Register the Menu to WordPress
 * Settings Page Style
 * Login Page Style
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
 * Initial for framework.
 */
function grahlie_admin_init() {
	if ( grahlie_theme_activated() ) {
		flush_rewrite_rules();
		header( 'Location: ' . home_url() . '/wp-admin/admin.php?page=grahlieframework&activated=true' );
	}

	if ( ! isset( $_SESSION ) ) {
		session_start();
	}

	// Get information from theme style.css file.
	$theme_data                = wp_get_theme();
	$data['theme_name']        = $theme_data->get( 'Name' );
	$data['theme_version']     = $theme_data->get( 'Version' );
	$data['theme_author']      = $theme_data->get( 'Author' );
	$data['theme_authorURI']   = $theme_data->get( 'AuthorURI' );
	$data['grahlie_framework'] = array();

	// define information for the theme settings page.
	update_option( 'grahlie_framework_options', $data );

	$grahlie_values = get_option( 'grahlie_framework_values' );
	if ( ! is_array( $grahlie_values ) ) {
		update_option( 'grahlie_framework_values', array() );
	}
}
add_action( 'init', 'grahlie_admin_init', 2 );


/**
 * Create Admin menu
 */
function grahlie_admin_menu() {
	$grahlie_options = get_option( 'grahlie_framework_options' );
	$icon            = GRAHLIE_URL . '/images/favicon.png';

	// Add menu item, main menu = sub menu.
	add_menu_page( $grahlie_options['theme_name'], $grahlie_options['theme_name'], 'administrator', 'grahlieframework', 'grahlie_admin_page', $icon );
	add_submenu_page( 'grahlieframework', __( 'Theme Options', 'grahlie' ), __( 'Theme Options', 'grahlie' ), 'administrator', 'grahlieframework', 'grahlie_admin_page' );
}
add_action( 'admin_menu', 'grahlie_admin_menu' );

/**
 * Style for the admin page
 */
function grahlie_admin_scripts() {
	wp_enqueue_style( 'admin-setting-page', get_template_directory_uri() . '/framework/css/admin-style.css', [], '1.0' );

	wp_register_script( 'admin-scripts', get_template_directory_uri() . '/framework/js/admin-scripts.js', array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-form' );
	wp_enqueue_script( 'admin-scripts' );
}
add_action( 'admin_menu', 'grahlie_admin_scripts' );
