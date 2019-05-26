<?php
/**
 * Kolumn shortcode
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
function grahlie_column_shortcode( $atts, $content = null ) {
	extract(
		shortcode_atts(
			array(
				'klass'   => '',
				'id'      => '',
				'storlek' => '6',
				'ordning' => '',
			),
			$atts
		)
	);

	if ( '' !== $klass ) {
		$class = $klass;
	}

	if ( '' !== $storlek ) {
		$size = 'size' . $storlek;
	}

	if ( '' !== $ordning ) {
		$order = 'order' . $ordning;
	}

	if ( '' !== $id ) {
		$id = 'id="' . $id . '"';
	}

	if ( null !== $content ) {
		$content_output = do_shortcode( $content );
	}

	$output = '<div ' . $id . ' class="column ' . $size . ' ' . $order . ' ' . $class . '">' . $content_output . '</div>';

	return $output;
}

add_shortcode( 'grahlieKolumn', 'grahlie_column_shortcode' );
add_shortcode( 'grahlieKolumn2', 'grahlie_column_shortcode' );
add_shortcode( 'grahlieKolumn3', 'grahlie_column_shortcode' );
