<?php
/**
 * Box shortcode
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
function grahlie_box_shortcode( $atts, $content = null ) {
	extract(
		shortcode_atts(
			array(
				'klass'      => '',
				'storlek'    => '',
				'size'       => '',
				'id'         => '',
				'bakgrund'   => '',
				'background' => '',
				'sidor'      => '',
				'pages'      => '',
				'titel'      => '',
				'title'      => '',
				'bild'       => '',
				'image'      => '',
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

	if ( '' !== $bakgrund ) {
		$bakgrund   = 'style="background-image: url(' . $bakgrund . ')"';
		$background = $bakgrund;
	}

	if ( '' !== $sidor ) {
		$output = grahlie_use_pages( $class, $title, $image );
	}

	if ( null !== $content ) {
		$content_output = do_shortcode( $content );
	}

	if ( '' === $sidor ) {
		$output = '
			<div class="grahlieBox' . $class . '' . $size . '"' . $background . '>
				' . $content_output . '
			</div>
		';
	}

	return $output;
}
add_shortcode( 'grahlieBox', 'grahlie_box_shortcode' );
add_shortcode( 'grahlieBox2', 'grahlie_box_shortcode' );
add_shortcode( 'grahlieBox3', 'grahlie_box_shortcode' );
