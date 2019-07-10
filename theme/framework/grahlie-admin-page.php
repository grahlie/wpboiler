<?php
/**
 * Admin page
 *
 * PHP version 7
 *
 * @category Grahlie_WPBoiler
 * @package  Grahlie_WPBoiler
 * @author   Mathias Grahl <mathias@grahlie.se>
 * @license  GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link     http://grahlie.se
 */

/**
 * Admin page.
 */
function grahlie_admin_page() {
	$grahlie_options = get_option( 'grahlie_framework_options' );

	if ( isset( $_GET['tab'] ) ) {
		$tab = sanitize_text_field( wp_unslash( $_GET['tab'] ) );
	} else {
		$tab = 'theme_options';
	}
	?>


	<div id="grahlie-framework">
		<form method="post" action="<?php echo esc_url( site_url() ) . '/wp-admin/admin-ajax.php'; ?>" enctype="multipart/form-data">
			<header>
				<a class="author_logo" href="<?php echo esc_url( $grahlie_options['theme_authorURI'] ); ?>" alt="<?php echo esc_html( $grahlie_options['theme_author'] ); ?>" target="_blank">
					<?php $logo_svg = get_template_directory_uri() . '/framework/images/grahlie.svg'; ?>
					<?php echo '<img src=' . esc_html( $logo_svg ) . ' />'; ?>
				</a>
				<h1 class="theme_logo">
					<?php echo esc_html( $grahlie_options['theme_name'] ); ?>
				</h1>
				<span>v.<?php echo esc_html( $grahlie_options['theme_version'] ); ?></span>
			</header>
			<div class="main">
				<div class="tabs">
					<ul>
						<?php foreach ( $grahlie_options['grahlie_framework'] as $page ) : ?>
							<li>
								<a href="<?php echo esc_url( '?page=grahlieframework&tab=' . $page['id'] ); ?>" class="<?php echo $tab === $page['id'] ? 'active' : ''; ?>">
									<?php echo esc_html( $page['title'] ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="content">
					<?php foreach ( $grahlie_options['grahlie_framework'] as $page ) { ?>

						<?php if ( $tab === $page['id'] ) { ?>

							<div id="<?php echo esc_html( $page['id'] ); ?>">
								<h1><?php echo esc_html( $page['title'] ); ?></h1>
								<p>
								<?php
								if ( isset( $page['desc'] ) ) {
									echo esc_html( $page['desc'] );
								}
								?>
								</p>
								<hr />

							<?php foreach ( $page as $item ) { ?>
								<?php if ( is_array( $item ) ) { ?>

									<?php echo grahlie_create_output( $item ); ?>

								<?php } ?>
							<?php } ?>

							</div>
						<?php } ?>
					<?php } ?>
				</div>
				<div class="footer">
					<input type="hidden" name="action" value="grahlie_framework_save" />
					<input type="hidden" name="grahlie_noncename" id="grahlie_noncename" value="<?php echo esc_attr( wp_create_nonce( 'grahlie_framework_options' ) ); ?>" />
					<input type="button" value="<?php esc_html_e( 'Reset Options', 'grahlie' ); ?>" class="grahlie-button" id="reset-button" />
					<input type="submit" value="<?php esc_html_e( 'Save All Changes', 'grahlie' ); ?>" class="grahlie-button-primary right" id="save-button" />
				</div>
			</div>
		</form>
	</div>
<?php } ?>
