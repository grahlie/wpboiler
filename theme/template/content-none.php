<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 *  PHP version 7
 *
 * @category Grahlie_WPBoiler
 * @package  Grahlie_WPBoiler
 * @author   Mathias Grahl <mathias@grahlie.se>
 * @license  GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link     https://codex.wordpress.org/Template_Hierarchy
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'grahlie' ); ?></h1>
	</header><!-- .page-header -->

	<div>
	<?php
	if ( is_search() ) :
		?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'grahlie' ); ?></p>
		<?php
		get_search_form();

		else :
			?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'grahlie' ); ?></p>
			<?php
			get_search_form();

		endif;
		?>
	</div>
</section>
