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
function grahlie_blog_settings() {
	$blog_options['title'] = 'Blog Options';
	$blog_options['desc']  = 'Settings for your blog page.';
	$blog_options['id']    = 'blog_options';

	$blog_options[] = array(
		'title' => 'Excerpt length',
		'desc'  => 'How long should "Excerpt" length be? used in the list of all blog posts.',
		'type'  => 'text',
		'id'    => 'blog_excerpt_length',
	);

	$blog_options[] = array(
		'title' => 'Show date on blog post',
		'desc'  => 'If you want to show date on blog post check this box.',
		'type'  => 'checkbox',
		'id'    => 'blog_show_date',
	);

	$blog_options[] = array(
		'title' => 'Show author on blog post',
		'desc'  => 'If you want to show author on blog post check this box.',
		'type'  => 'checkbox',
		'id'    => 'blog_show_author',
	);

	grahlie_add_framework_page( 'Blog Options', $blog_options );
}
add_action( 'admin_init', 'grahlie_blog_settings' );

/**
 * Excerpt length.
 */
function grahlie_blog_excerpt_length() {
	$grahlie_values = get_option( 'grahlie_framework_values' );
	$output         = 55;

	if ( array_key_exists( 'blog_excerpt_length', $grahlie_values ) && '' !== $grahlie_values['blog_excerpt_length'] ) {
		$output = intval( $grahlie_values['blog_excerpt_length'] );
	}

	return $output;
}

/**
 * Show date on blog post.
 */
function grahlie_blog_show_date() {
	$grahlie_values = get_option( 'grahlie_framework_values' );

	if ( array_key_exists( 'blog_show_date', $grahlie_values ) && 'on' === $grahlie_values['blog_show_date'] ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Show author on blog posts.
 */
function grahlie_blog_show_author() {
	$grahlie_values = get_option( 'grahlie_framework_values' );

	if ( array_key_exists( 'blog_show_author', $grahlie_values ) && 'on' === $grahlie_values['blog_show_author'] ) {
		return true;
	} else {
		return false;
	}
}
