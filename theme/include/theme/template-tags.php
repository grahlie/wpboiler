<?php
/**
 * Template tags functions
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
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $sep separating char.
 */
function grahlie_pretty_title( $sep ) {
	global $page, $post;

	// Add the blog name.
	$blogname = get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$blogname $sep $site_description";
	} elseif ( is_single() ) {
		$title = "$post->post_title $sep $blogname";
	} elseif ( is_page() && ! is_front_page() ) {
		$title = "$post->post_title $sep $blogname";
	} else {
		$title = "$blogname";
	}

	return $title;
}
add_filter( 'wp_title', 'grahlie_pretty_title', 10, 2 );

/**
 * Returns true if a blog has more than 1 category.
 */
function grahlie_categorized_blog() {
	$all_the_cool_cats = get_transient( 'grahlie_categories' );
	if ( false === $all_the_cool_cats ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories(
			array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				'number'     => 2,
			)
		);

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'grahlie_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Flush out the transients used in grahlie_categorized_blog.
 */
function grahlie_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'grahlie_categories' );
}
add_action( 'edit_category', 'grahlie_category_transient_flusher' );
add_action( 'save_post', 'grahlie_category_transient_flusher' );
