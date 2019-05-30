<?php
/**
 * Grahlie Framework 1.0
 *
 *  PHP version 7
 *
 * @category Grahlie_WPBoiler
 * @package  Grahlie_WPBoiler
 * @author   Mathias Grahl <mathias@grahlie.se>
 * @license  GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link     http://grahlie.se
 */

/*    Directories and paths */
define( 'GRAHLIE_DIR', get_template_directory() . '/framework' );
define( 'GRAHLIE_URL', get_template_directory_uri() . '/framework' );

/*    Load Framework Components */
require_once GRAHLIE_DIR . '/grahlie-admin-init.php';
require_once GRAHLIE_DIR . '/grahlie-admin-functions.php';
require_once GRAHLIE_DIR . '/grahlie-admin-input.php';
require_once GRAHLIE_DIR . '/grahlie-admin-page.php';

/* Pages */
require_once GRAHLIE_DIR . '/pages/theme-settings.php';
require_once GRAHLIE_DIR . '/pages/frontpage-settings.php';
require_once GRAHLIE_DIR . '/pages/blog-settings.php';
require_once GRAHLIE_DIR . '/pages/multisite-settings.php';



