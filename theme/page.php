<?php
/**
 * The template for displaying all pages.
 *
 *  PHP version 7
 *
 * @category Grahlie_WPBoiler
 * @package  Grahlie_WPBoiler
 * @author   Mathias Grahl <mathias@grahlie.se>
 * @license  GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link     http://grahlie.se
 */

get_header(); ?>

<section id="content">
	<main id="main" role="main">

	<?php
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template/content', 'page' );
	}
	?>

	</main>
</section>

<?php get_footer(); ?>
