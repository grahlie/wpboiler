<?php
/**
 * Core functions for the framework
 *
 * Check if theme is activated, then redirect to settings page
 * Add framework pages
 * Create output for framework pages, creating "subfields" in framework
 * Save settings
 * Reset settings
 * Upload file
 * Remove file
 * Fetch WordPress pages
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
 * Checking if the theme has been activated
 */
function grahlie_theme_activated() {
	global $pagenow;

	if ( is_admin() && isset( $_GET['activated'] ) && 'themes.php' === $pagenow ) {
		return true;
	}

	return false;
}

/**
 * Add a Page to the Framework.
 *
 * @param string $title Title of page.
 * @param array  $data data.
 */
function grahlie_add_framework_page( $title, $data ) {
	if ( ! is_array( $data ) ) {
		return false;
	}

	// Get current Framework pages.
	$grahlie_options   = get_option( 'grahlie_framework_options' );
	$grahlie_framework = array();

	if ( is_array( $grahlie_options['grahlie_framework'] ) ) {
		$grahlie_framework = $grahlie_options['grahlie_framework'];
	}

	// Add new page.
	$grahlie_framework[ $title ] = $data;

	// Save.
	$grahlie_options['grahlie_framework'] = $grahlie_framework;
	update_option( 'grahlie_framework_options', $grahlie_options );
}

/**
 * Function for creating output on framework page
 *
 * @param array $item array of data.
 */
function grahlie_create_output( $item ) {
	$output = '<div class="content-settings clearfix ' . $item['id'] . '"><div class="info"><h3>' . $item['title'] . '</h3>';

	if ( isset( $item['desc'] ) ) {
		$output .= '<p class="desc">' . $item['desc'] . '</p>';
	}

	$output .= '</div><div class="input">';
	$output .= grahlie_create_input( $item, null );
	$output .= '</div></div>';

	// Creating fields for subfields.
	if ( $item['sync'] && is_array( $item['sync'] ) ) {
		foreach ( $item['sync'] as $sync_item ) {
			$output .= '<div class="content-settings clearfix ' . $sync_item['id'] . '"><div class="info"><h3>' . $sync_item['title'] . '</h3>';

			if ( isset( $sync_item['desc'] ) ) {
				$output .= '<p class="desc">' . $sync_item['desc'] . '</p>';
			}

			$output .= '</div><div class="input">';
			$output .= grahlie_create_input( $sync_item, $item );
			$output .= '</div></div>';
		}
	}

	return $output;
}

/**
 * Save button function
 */
function grahlie_framework_save() {
	$response['error']   = false;
	$response['message'] = '';

	if ( ! isset( $_POST['grahlie_noncename'] ) || ( isset( $_REQUEST['grahlie_noncename'] ) && ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['grahlie_noncename'] ) ), 'grahlie_framework_options' ) ) ) {
		$response['error']   = true;
		$response['message'] = __( '1 You do not have permission to update this page', 'grahlie' );

		echo wp_json_encode( $response );
		die;
	}

	$grahlie_values = get_option( 'grahlie_framework_values' );
	if ( isset( $_POST['grahlie_framework_values'] ) ) {
		$data = array_map( 'wp_kses_post', wp_unslash( $_POST['grahlie_framework_values'] ) );

		foreach ( $data as $id => $value ) {
			$grahlie_values[ $id ] = $value;
		}

		update_option( 'grahlie_framework_values', $grahlie_values );
		$response['message'] = __( 'Settings saved', 'grahlie' );
	}

	echo wp_json_encode( $response );
	die;
}
add_action( 'wp_ajax_grahlie_framework_save', 'grahlie_framework_save' );

/**
 * Reset button function
 */
function grahlie_framework_reset() {
	$response['error']   = false;
	$response['message'] = '';

	if ( ! isset( $_POST['nonce'] ) || ( isset( $_REQUEST['nonce'] ) && ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ), 'grahlie_framework_options' ) ) ) {
		$response['error']   = true;
		$response['message'] = __( '2 You do not have permission to update this page', 'grahlie' );
		echo wp_json_encode( $response );
		die;
	}

	update_option( 'grahlie_framework_values', array() );
	$response['message'] = __( 'Settings deleted', 'grahlie' );

	echo wp_json_encode( $response );
	die;
}
add_action( 'wp_ajax_grahlie_framework_reset', 'grahlie_framework_reset' );


/**
 * Upload button function
 */
function grahlie_upload_file() {
	$response['error']   = false;
	$response['message'] = '';

	if ( ! isset( $_POST['grahlie_upload_nonce'] ) || ( isset( $_REQUEST['grahlie_upload_nonce'] ) && ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['grahlie_upload_nonce'] ) ), 'grahlie_framework_upload' ) ) ) {
		$response['error']   = true;
		$response['message'] = __( '3 You do not have permission to update this page', 'grahlie' );
		echo wp_json_encode( $response );
		die;
	}

	if ( empty( sanitize_text_field( wp_unslash( $_POST['id'] ) ) ) ) {
		$response['error']   = true;
		$response['message'] = __( '4 You do not have permission to update this page', 'grahlie' );
		echo wp_json_encode( $response );
		die;
	}

	$wp_upload_dir = wp_upload_dir();
	$id            = sanitize_text_field( wp_unslash( $_POST['id'] ) );

	if ( isset( $_FILES['uploadedfile']['name'] ) && isset( $_FILES['uploadedfile']['tmp_name'] ) ) {
		$uploadfile_with_path = $wp_upload_dir['path'] . '/' . basename( sanitize_text_field( wp_unslash( $_FILES['uploadedfile']['name'] ) ) );
		$uploadfile           = basename( sanitize_text_field( wp_unslash( $_FILES['uploadedfile']['name'] ) ) );
		$tmpfile              = sanitize_text_field( wp_unslash( $_FILES['uploadedfile']['tmp_name'] ) );
	}

	if ( move_uploaded_file( $tmpfile, $uploadfile_with_path ) ) {
		$grahlie_values        = get_option( 'grahlie_framework_values' );
		$grahlie_values[ $id ] = $wp_upload_dir['url'] . '/' . $uploadfile;

		update_option( 'grahlie_framework_values', $grahlie_values );

		$response['message'] = __( 'Your file have been uploaded', 'grahlie' );

	} else {
		$response['error']   = true;
		$response['message'] = __( '5 You do not have permission to update this page', 'grahlie' );
	}

	echo wp_json_encode( $response );
	die;

}
add_action( 'wp_ajax_grahlie_upload_file', 'grahlie_upload_file' );

/**
 * Remove button function
 */
function grahlie_remove_file() {
	$response['error']   = false;
	$response['message'] = '';

	if ( ! isset( $_POST['grahlie_upload_nonce'] ) || ( isset( $_REQUEST['grahlie_upload_nonce'] ) && ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['grahlie_upload_nonce'] ) ), 'grahlie_framework_upload' ) ) ) {
		$response['error']   = true;
		$response['message'] = __( '6 You do not have permission to update this page', 'grahlie' );
		echo wp_json_encode( $response );
		die;
	}

	$grahlie_values = get_option( 'grahlie_framework_values' );

	if ( isset( $grahlie_values[ $_POST['id'] ] ) ) {
		unset( $grahlie_values[ $_POST['id'] ] );
		update_option( 'grahlie_framework_values', $grahlie_values );
		$response['message'] = 'Your file have been succesfully removed';
	}

	echo wp_json_encode( $response );
	die;
}
add_action( 'wp_ajax_grahlie_remove_file', 'grahlie_remove_file' );

/**
 * Function for fetching pages from WordPress.
 */
function grahlie_get_pages() {
	$response['error']   = false;
	$response['message'] = '';

	$pages = get_pages();

	foreach ( $pages as $key => $page ) {
		$response['name'][ $key ] = $page->post_title;
		$response['id'][ $key ]   = $page->ID;
	}

	echo wp_json_encode( $response );
	die;
}
add_action( 'wp_ajax_grahlie_get_pages', 'grahlie_get_pages' );
