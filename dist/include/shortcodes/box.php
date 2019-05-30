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
 * @param string $atts    attributes.
 * @param string $content null or content.
 *
 * @var    string
 * @return content
 */
function grahlie_box_shortcode( $atts, $content = null ) {
	$klass      = $atts['klass'];
	$class      = $atts['class'];
	$storlek    = $atts['storlek'];
	$size       = $atts['size'];
	$id         = $atts['id'];
	$href       = $atts['href'];
	$adress     = $atts['adress'];
	$bakgrund   = $atts['bakgrund'];
	$background = $atts['background'];
	$sidor      = $atts['sidor'];
	$pages      = $atts['pages'];
	$title      = $atts['title'];
	$title      = $atts['title'];
	$bild       = $atts['bild'];
	$image      = $atts['image'];

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
