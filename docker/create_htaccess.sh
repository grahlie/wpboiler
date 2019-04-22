#!/usr/bin/env bash

if [ "$MULTISITE" -gt 0 ]; then
    echo "# BEGIN WordPress"                                                            >>/var/www/.htaccess
    echo "<IfModule mod_rewrite.c>"                                                     >>/var/www/.htaccess
    echo "RewriteEngine On"                                                             >>/var/www/.htaccess
    echo "RewriteBase /"                                                                >>/var/www/.htaccess
    echo "RewriteRule ^server-status - [L]"                                             >>/var/www/.htaccess
    echo "RewriteRule ^index\.php$ - [L]"                                               >>/var/www/.htaccess
    echo "# add a trailing slash to /wp-admin"                                          >>/var/www/.htaccess
    echo "RewriteRule ^([_0-9a-zA-Z-]+/)?wp-admin$ $1wp-admin/ [R=301,L]"               >>/var/www/.htaccess
    echo "RewriteCond %{REQUEST_FILENAME} -f [OR]"                                      >>/var/www/.htaccess
    echo "RewriteCond %{REQUEST_FILENAME} -d"                                           >>/var/www/.htaccess
    echo "RewriteRule ^ - [L]"                                                          >>/var/www/.htaccess
    echo "RewriteRule ^([_0-9a-zA-Z-]+/)?(wp-(content|admin|includes).*) $2 [L]"        >>/var/www/.htaccess
    echo "RewriteRule ^([_0-9a-zA-Z-]+/)?(.*\.php)$ $2 [L]"                             >>/var/www/.htaccess
    echo "RewriteRule . index.php [L]"                                                  >>/var/www/.htaccess
    echo "</IfModule>"                                                                  >>/var/www/.htaccess
    echo "# END WordPress"                                                              >>/var/www/.htaccess
else
    echo "# BEGIN WordPress"                                                            >>/var/www/.htaccess
    echo "<IfModule mod_rewrite.c>"                                                     >>/var/www/.htaccess
    echo "RewriteEngine On"                                                             >>/var/www/.htaccess
    echo "RewriteBase /"                                                                >>/var/www/.htaccess
    echo "RewriteRule ^server-status - [L]"                                             >>/var/www/.htaccess
    echo "RewriteRule ^index\.php$ - [L]"                                               >>/var/www/.htaccess
    echo "RewriteCond %{REQUEST_FILENAME} !-f"                                          >>/var/www/.htaccess
    echo "RewriteCond %{REQUEST_FILENAME} !-d"                                          >>/var/www/.htaccess
    echo "RewriteRule . /index.php [L]"                                                 >>/var/www/.htaccess
    echo "</IfModule>"                                                                  >>/var/www/.htaccess
    echo "# END WordPress"                                                              >>/var/www/.htaccess
fi
