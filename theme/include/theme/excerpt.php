<?php
/**
 * Excerpt filters.
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
 * Add excerpt for pages, used for showcase pages on frontpage
 */
function grahlie_page_excerpt() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'grahlie_page_excerpt' );

/**
 * Adds a pretty "Read more" link to custom post excerpts.
 */
function grahlie_excerpt_link() {
	return '... <div class="excerpt-btn"><a href="' . get_the_permalink() . '" class="btn btn-primary">' . __( 'Read more', 'grahlie' ) . '</a></div>';
}
add_filter( 'excerpt_more', 'grahlie_excerpt_link' );

/**
 * Filter the except length.
 *
 * @param int $length length of excerpt.
 */
function grahlie_excerpt_length( $length ) {
	return grahlie_blog_excerpt_length();
}
add_filter( 'excerpt_length', 'grahlie_excerpt_length', 999 );

/**
 * Filter how long excerpt is
 *
 * @param string $content filter HTML excerpt.
 */
function grahlie_content_excerpt_filter( $content ) {
	return substr( $content, 0, 145 );
}

