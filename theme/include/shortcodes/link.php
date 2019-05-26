<?php
/**
 * Link shortcode
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
 * Shortcode
 *
 * @param string $atts    attributes
 * @param string $content null or content
 *
 * @var    string
 * @return content
 */
function grahlie_link_shortcode( $atts, $content = null ) {
	extract(
		shortcode_atts(
			array(
				'class'   => '',
				'klass'   => '',
				'storlek' => '',
				'size'    => '',
				'id'      => '',
				'adress'  => '',
			),
			$atts
		)
	);

	if ( '' !== $klass ) {
		$klass = ' ' . $klass;
		$class = $klass;
	}

	if ( '' !== $storlek ) {
		$storlek = ' size' . $storlek;
		$size    = $storlek;
	}

	if ( '' !== $adress ) {
		$href = $adress;

		$parse_url = wp_parse_url( $href );

		if ( empty( $parse_url['scheme'] ) ) {
			$href = get_site_url() . '/' . $href;
		} else {
			$target = 'target="_blank"';
		}
	}

	if ( null !== $content ) {
		$content_output = do_shortcode( $content );
	}

	if ( '' === $pages ) {
		$output = '
			<a href="' . $href . '" ' . $target . ' class="grahlieLink' . $class . '' . $size . '"' . $background . '>' . $content_output . '</a>';
	}

	return $output;
}
add_shortcode( 'grahlieLink', 'grahlie_link_shortcode' );
add_shortcode( 'grahlieLank', 'grahlie_link_shortcode' );
