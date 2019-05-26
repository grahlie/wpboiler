<?php
/**
 * Grahlie include init, setup files required for theme
 *
 * Loop for require all theme files
 * Remove different useless stuff from wordpress core
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
Grahlie_WPBoiler_Require_files( $incdir );

/**
 * Get files to require
 *
 * @param string $incdir path to files
 *
 * @var    string
 * @return file
 */
function Grahlie_WPBoiler_Require_files( $incdir ) {
	$files = scandir( $incdir );

	foreach ( $files as $value ) {

		if ( $value != '.' && $value != '..' && $value != 'include_init.php' ) {
			$path = $incdir . $value . '/';

			if ( is_dir( $path ) ) {

				$folder = scandir( $path );

				foreach ( $folder as $file ) {

					$file = pathinfo( $file );
					if ( $file['extension'] === 'php' ) {
						include $path . $file['basename'];
					}
				}
			} else {
				$path = pathinfo( $path );
				if ( $path['extension'] === 'php' ) {
					include $path . $path['basename'];
				}
			}
		} else {
			continue;
		}
	}
}


