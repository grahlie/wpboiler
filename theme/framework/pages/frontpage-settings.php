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
function grahlie_frontpage_settings() {
	$frontpage_options['title'] = 'Frontpage Options';
	$frontpage_options['desc']  = 'Settings for your frontpage.';
	$frontpage_options['id']    = 'frontpage_options';

	$frontpage_options[] = array(
		'title' => 'Intro text',
		'desc'  => 'Text you want to display in header',
		'type'  => 'textarea',
		'id'    => 'frontpage_intro_text',
	);

	$frontpage_options[] = array(
		'title' => 'Showcase pages on firstpage',
		'desc'  => 'Check this box if you want pages to show up on frontpage.',
		'type'  => 'checkbox',
		'id'    => 'use_pages',
		'sync'  => array(
			0 => array(
				'title'   => 'How many pages',
				'desc'    => 'Choose how many pages you want on frontpage.',
				'type'    => 'radio',
				'id'      => 'use_pages_count',
				'options' => array(
					'1' => 'one',
					'2' => 'two',
					'3' => 'three',
					'4' => 'four',
				),
			),
			1 => array(
				'title'  => 'Which pages to show',
				'desc'   => 'Choose which pages to show on frontpage',
				'type'   => 'select',
				'id'     => 'use_pages_select',
				'wppage' => 'yes',
			),
		),
	);

	grahlie_add_framework_page( 'Frontpage Options', $frontpage_options );
}
add_action( 'admin_init', 'grahlie_frontpage_settings' );

/**
 * Create intro text to display in header
 */
function grahlie_intro_header_text() {
	$grahlie_values = get_option( 'grahlie_framework_values' );
	return $grahlie_values['frontpage_intro_text'];
}


/**
 * Output pages defined in framework
 *
 * @param string $class     class on HTML.
 * @param string $title     title.
 * @param string $thumbnail image for pages.
 */
function grahlie_use_pages( $class = null, $title, $thumbnail ) {

	$grahlie_values = get_option( 'grahlie_framework_values' );
	$output         = '';

	if ( array_key_exists( 'use_pages', $grahlie_values ) && 'on' === $grahlie_values['use_pages'] && array_key_exists( 'use_pages_count', $grahlie_values ) ) {

		for ( $i = 1; $i <= $grahlie_values['use_pages_count']; $i++ ) {
			$page   = get_post( $grahlie_values['use_pages_select'][ $i ] );
			$size   = 'size' . 12 / $grahlie_values['use_pages_count'];
			$id     = get_post_class()[0];
			$type   = get_post_class()[1];
			$class .= ' ' . $id . ' ' . $type . ' column';

			$output .= '<div id="' . $id . '" class="grahlieBox' . $class . ' ' . $size . '">';

			if ( '' !== $thumb ) {
				$thumb   = get_the_post_thumbnail( $page->ID );
				$output .= $thumb;
			}

			if ( '' !== $title ) {
				$output .= '<h2>' . $page->post_title . '</h2>';
			}

			if ( empty( $page->post_excerpt ) ) {
				$content = grahlie_content_excerpt_filter( $page->post_content );
			} else {
				$content = $page->post_excerpt;
			}

			$output .= '<p>' . $content . '</p><a href="' . $page->post_name . '" class="btn btn-primary">Läs mer</a></div>';
		}
	}

	return $output;
}

