<?php
/**
 * Template part for displaying results in search pages.
 *
 *  PHP version 7
 *
 * @category Grahlie_WPBoiler
 * @package  Grahlie_WPBoiler
 * @author   Mathias Grahl <mathias@grahlie.se>
 * @license  GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link     http://grahlie.se
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
	<?php
	the_title(
		sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
		'</a></h2>'
	);
	?>

	<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
		<?php grahlie_posted_on(); ?>
			</div>
	<?php endif; ?>
	</header>

	<div class="entry-content">
	<?php the_excerpt(); ?>
	</div>

	<footer class="entry-footer">
	<?php grahlie_entry_footer(); ?>
	</footer>
</article>
