<?php
/**
 * Grahlie include init, setup files required for theme
 *
 * Loop for require all theme files
 * Remove different useless stuff from WordPress core
 * Emojis
 * RSS
 * wlwmanifest
 * feed
 * pingback header
 *
 *  PHP version 7
 *
 * @category Grahlie_WPBoiler
 * @package  Grahlie_WPBoiler
 * @author   Mathias Grahl <mathias@grahlie.se>
 * @license  GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link     http://grahlie.se
 */

$incdir = get_template_directory() . '/include/';
grahlie_wpboiler_require_files( $incdir );

/**
 * Get files to require
 *
 * @param string $incdir path to files.
 *
 * @var    string
 * @return void
 */
function grahlie_wpboiler_require_files( $incdir ) {
	$files = scandir( $incdir );

	foreach ( $files as $value ) {

		if ( '.' !== $value && '..' !== $value && 'include-init.php' !== $value ) {
			$path = $incdir . $value . '/';

			if ( is_dir( $path ) ) {

				$folder = scandir( $path );

				foreach ( $folder as $file ) {

					$file = pathinfo( $file );
					if ( 'php' === $file['extension'] ) {
						include $path . $file['basename'];
					}
				}
			} else {
				$path = pathinfo( $path );
				if ( 'php' === $path['extension'] ) {
					include $path . $path['basename'];
				}
			}
		} else {
			continue;
		}
	}
}


