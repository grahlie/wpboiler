<?php
/**
 * Template part for displaying page content in page.php.
 *
 *  PHP version 7
 *
 * @category Grahlie_WPBoiler
 * @package  Grahlie_WPBoiler
 * @author   Mathias Grahl <mathias@grahlie.se>
 * @license  GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link     http://grahlie.se
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php the_content(); ?>
</div>
