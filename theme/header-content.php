<?php
/**
 * The headerContent file, containing the head of the pages
 *  PHP version 7
 *
 * @category Grahlie_WPBoiler
 * @package  Grahlie_WPBoiler
 * @author   Mathias Grahl <mathias@grahlie.se>
 * @license  GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link     http://grahlie.se
 */

if ( get_the_post_thumbnail( $post->ID ) ) { ?>
	<div class="header-image" style="background-image: url('<?php the_post_thumbnail_url( 'featured-image' ); ?>');">
		<div class="site-branding">
			<?php echo esc_html( grahlie_use_logotype() ); ?>
		</div>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<input type="checkbox" id="nav-trigger">
			<label for="nav-trigger" id="navopen"></label>

			<?php echo esc_html( grahlie_show_language_switcher() ); ?>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'navigation',
					'container'      => '',
				)
			);
			?>
		</nav>
	</div>

<?php } else { ?>

	<div class="header-content">
		<div class="site-branding">
			<?php echo esc_html( grahlie_use_logotype() ); ?>
		</div>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<input type="checkbox" id="nav-trigger">
			<label for="nav-trigger" id="navopen"></label>

			<?php echo esc_html( grahlie_show_language_switcher() ); ?>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'navigation',
					'container'      => '',
				)
			);
			?>
		</nav>

		<?php echo esc_html( grahlie_intro_header_text() ); ?>
	</div>

<?php } ?>
