<?php
/**
 * The template for displaying archive pages.
 *
 PHP version 7
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
		<?php if ( have_posts() ) { ?>
			<header class="page-header">
				<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
			</header>
			<?php

			while ( have_posts() ) {
				the_post();

				get_template_part( 'template/content', get_post_format() );

			}

			the_posts_navigation();
		} else {
				get_template_part( 'template/content', 'none' );
		}
		?>
	</main>
</section>

<?php
get_sidebar();
get_footer();
