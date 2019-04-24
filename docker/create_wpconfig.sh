#!/usr/bin/env bash

wpconfig="/var/www/wp-config.php"
if [ -e "$wpconfig" ]; then
    rm /var/www/wp-config.php
fi

echo "<?php"                                           >>/var/www/wp-config.php
# Setup multisite
if [ "$MULTISITE" -gt 0 ]; then
    echo "define('WP_ALLOW_MULTISITE', true);"         >>/var/www/wp-config.php
    echo "define('MULTISITE', true);"                  >>/var/www/wp-config.php
    echo "define('SUBDOMAIN_INSTALL', false);"         >>/var/www/wp-config.php
    echo "define('PATH_CURRENT_SITE', '/');"           >>/var/www/wp-config.php
    echo "define('SITE_ID_CURRENT_SITE', 1);"          >>/var/www/wp-config.php
    echo "define('BLOG_ID_CURRENT_SITE', 1);"          >>/var/www/wp-config.php
fi

# Debug mode
if [ "$DEBUGMODE" -gt 0 ]; then
    echo "define('WP_DEBUG', true);"                  >>/var/www/wp-config.php
    echo "define('WP_DEBUG_LOG', true);"              >>/var/www/wp-config.php
    echo "define('WP_DEBUG_DISPLAY', false);"         >>/var/www/wp-config.php
else
    echo "define('WP_DEBUG', false);"                 >>/var/www/wp-config.php
    echo "define('WP_DEBUG_LOG', false);"             >>/var/www/wp-config.php
    echo "define('WP_DEBUG_DISPLAY', true);"          >>/var/www/wp-config.php
fi

echo ""                                                >>/var/www/wp-config.php

# if [ "$HTTPS" -gt 0 ]; then
#     echo "define('FORCE_SSL_ADMIN', true);"            >>/var/www/wp-config.php
# fi

echo ""                                                >>/var/www/wp-config.php

# Setup database
echo "define('DB_NAME', '"$DBNAME"');"                 >>/var/www/wp-config.php
echo "define('DB_USER', '"$DBUSER"');"                 >>/var/www/wp-config.php
echo "define('DB_PASSWORD', '"$DBPASS"');"             >>/var/www/wp-config.php
echo "define('DB_HOST', '"$DBHOST"');"                 >>/var/www/wp-config.php
echo "define('WP_SITEURL', 'http://"$DOMAIN"');"       >>/var/www/wp-config.php
echo "define('WP_HOME', 'http://"$DOMAIN"');"          >>/var/www/wp-config.php
echo "\$table_prefix  = '"$DBNAME"_gr4hl13_';"         >>/var/www/wp-config.php

echo ""                                                >>/var/www/wp-config.php

# Set salts
curl -s https://api.wordpress.org/secret-key/1.1/salt/ >>/var/www/wp-config.php
