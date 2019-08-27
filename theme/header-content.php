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

if ( get_the_post_thumbnail( $post->ID ) ) : ?>
	<div class="header-image" style="background-image: url('<?php the_post_thumbnail_url( 'featured-image' ); ?>');">
<?php else : ?>
	<div class="header-content">
<?php endif; ?>
		<div class="site-branding">
			<h1 class="site-title">
				<a href="' . esc_url( home_url( '/' ) ) . '" rel="home">
					<?php $use_logotype = grahlie_use_logotype(); ?>
					<?php if ( true === $use_logotype['show'] ) : ?>
						<img src="<?php echo esc_html( $use_logotype['src'] ); ?>" />
					<?php else : ?>
						<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
					<?php endif; ?>
				</a>
			</h1>
		</div>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<input type="checkbox" id="nav-trigger">
			<label for="nav-trigger" id="navopen"></label>

			<?php if ( grahlie_show_language_switcher() ) : ?>
				<div id="language_switcher" class="dropdown_navigation">
					<a id="language_switcher_picker"><i class="material-icons">language</i></a>
					<div id="language_swithcer_values" class="dropdown_container">
					<?php $languages = grahlie_list_languages(); ?>
					<?php foreach ( $languages as $key => $language ) : ?>
						<a href="<?php echo esc_html( $language['href'] ); ?>" class="<?php echo esc_html( $language['class'] ); ?>"><?php echo esc_html( $language['title'] ); ?></a>
					<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
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

		<?php
		if ( get_the_post_thumbnail( $post->ID ) ) :
			echo '<div class="site-intro">' . esc_html( grahlie_intro_header_text() ) . '</div>';
		endif;
		?>
	</div>
