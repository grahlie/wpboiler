<?php
/**
 * The header file, containing the <head> parts
 *  PHP version 7
 *
 * @category Grahlie_WPBoiler
 * @package  Grahlie_WPBoiler
 * @author   Mathias Grahl <mathias@grahlie.se>
 * @license  GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link     http://grahlie.se
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php echo grahlie_use_favicon(); ?>
	<title><?php echo grahlie_pretty_title( '-' ); ?></title>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header id="pageHeader" class="site-header" role="banner">
	<?php require_once 'headerContent.php'; ?>
</header>

<div id="pageContent" class="site">
