<?php
/**
 * Rad shortcode
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
function grahlie_row_shortcode( $atts, $content = null ) {
	extract(
		shortcode_atts(
			array(
				'klass' => '',
				'id'    => '',
				'hojd'  => '',
				'bredd' => '',
			),
			$atts
		)
	);

	if ( '' !== $klass ) {
		$class = $klass;
	}

	if ( '' !== $id ) {
		$id = 'id="' . $id . '"';
	}

	if ( '' !== $klass ) {
		$class = $klass;
	}

	if ( null !== $content ) {
		$content_output = do_shortcode( $content );
	}

	if ( '' !== $hojd ) {
		$style .= ' min-height: ' . $hojd . 'px;';
	}

	$output = '<div ' . $id . 'class="row ' . $class . '" ' . $style . '>' . $content_output . '</div>';

	return $output;
}

add_shortcode( 'grahlieRad', 'grahlie_row_shortcode' );
add_shortcode( 'grahlieRad2', 'grahlie_row_shortcode' );
add_shortcode( 'grahlieRad3', 'grahlie_row_shortcode' );
