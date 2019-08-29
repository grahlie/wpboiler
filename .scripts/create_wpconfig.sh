#!/usr/bin/env bash

echo "==============="
echo "Running $(basename $0)"
echo "==============="

FILE=$1
source ./parse-config.sh $FILE

if [[ ! -f "../$FOLDER/wp/wp-config.php" ]]; then
    echo "<?php"                                           >>../$FOLDER/wp/wp-config.php
    # Setup multisite
    if [ "$MULTISITE" -gt 0 ]; then
        echo "define('WP_ALLOW_MULTISITE', true);"         >>../$FOLDER/wp/wp-config.php
        echo "define('MULTISITE', true);"                  >>../$FOLDER/wp/wp-config.php
        echo "define('SUBDOMAIN_INSTALL', false);"         >>../$FOLDER/wp/wp-config.php
        echo "define('PATH_CURRENT_SITE', '/');"           >>../$FOLDER/wp/wp-config.php
        echo "define('SITE_ID_CURRENT_SITE', 1);"          >>../$FOLDER/wp/wp-config.php
        echo "define('BLOG_ID_CURRENT_SITE', 1);"          >>../$FOLDER/wp/wp-config.php
    fi

    # Debug mode
    if [ "$DEBUG" -gt 0 ]; then
        echo "define('WP_DEBUG', true);"                   >>../$FOLDER/wp/wp-config.php
        echo "define('WP_DEBUG_LOG', true);"               >>../$FOLDER/wp/wp-config.php
        echo "define('WP_DEBUG_DISPLAY', false);"          >>../$FOLDER/wp/wp-config.php
    else
        echo "define('WP_DEBUG', false);"                  >>../$FOLDER/wp/wp-config.php
        echo "define('WP_DEBUG_LOG', false);"              >>../$FOLDER/wp/wp-config.php
        echo "define('WP_DEBUG_DISPLAY', true);"           >>../$FOLDER/wp/wp-config.php
    fi

    echo ""                                                >>../$FOLDER/wp/wp-config.php

    # if [ "$HTTPS" -gt 0 ]; then
    #     echo "define('FORCE_SSL_ADMIN', true);"            >>../$FOLDER/wp/wp-config.php
    # fi

    echo ""                                                >>../$FOLDER/wp/wp-config.php

    # Setup database
    echo "define('DB_NAME', '"$DBNAME"');"                 >>../$FOLDER/wp/wp-config.php
    echo "define('DB_USER', '"$DBUSER"');"                 >>../$FOLDER/wp/wp-config.php
    echo "define('DB_PASSWORD', '"$DBPASS"');"             >>../$FOLDER/wp/wp-config.php
    echo "define('DB_HOST', '"$NAME"-db');"                >>../$FOLDER/wp/wp-config.php
    echo "define('WP_SITEURL', 'http://"$DOMAIN"');"       >>../$FOLDER/wp/wp-config.php
    echo "define('WP_HOME', 'http://"$DOMAIN"');"          >>../$FOLDER/wp/wp-config.php
    echo "\$table_prefix = 's3curityy_gr4hl13_';"          >>../$FOLDER/wp/wp-config.php

    echo ""                                                >>../$FOLDER/wp/wp-config.php

    # Set salts
    curl -s https://api.wordpress.org/secret-key/1.1/salt/ >>../$FOLDER/wp/wp-config.php

    echo "define('WP_DEFAULT_THEME', 'grahlie');"          >>../$FOLDER/wp/wp-config.php
    echo "define('DB_CHARSET', 'utf8mb4');"                >>../$FOLDER/wp/wp-config.php
    echo "define('DB_COLLATE', '');"                       >>../$FOLDER/wp/wp-config.php
    echo "define('FS_METHOD', 'direct');"                  >>../$FOLDER/wp/wp-config.php

    echo "# Disable edits & updates"                       >>../$FOLDER/wp/wp-config.php
    echo "define('DISALLOW_FILE_EDIT', true);"             >>../$FOLDER/wp/wp-config.php
    echo "define('DISALLOW_FILE_MODS', false);"            >>../$FOLDER/wp/wp-config.php
    echo "define('AUTOMATIC_UPDATER_DISABLED', true);"     >>../$FOLDER/wp/wp-config.php
    echo "define('WP_AUTO_UPDATE_CORE', false);"           >>../$FOLDER/wp/wp-config.php

    echo "# Other settings"                                >>../$FOLDER/wp/wp-config.php
    echo "define('WP_AUTO_UPDATE_CORE', false);"           >>../$FOLDER/wp/wp-config.php
    echo "define('AUTOMATIC_UPDATER_DISABLED', true);"     >>../$FOLDER/wp/wp-config.php
    echo "define('DISALLOW_FILE_EDIT', true);"             >>../$FOLDER/wp/wp-config.php
    echo "define('WP_MEMORY_LIMIT', '96M');"               >>../$FOLDER/wp/wp-config.php
    echo "define('WP_POST_REVISIONS', 3);"                 >>../$FOLDER/wp/wp-config.php

    echo "if ( !defined('ABSPATH') )"                      >>../$FOLDER/wp/wp-config.php
    echo "  define('ABSPATH', dirname(__FILE__) . '/');"   >>../$FOLDER/wp/wp-config.php

    echo "require_once(ABSPATH . 'wp-settings.php');"      >>../$FOLDER/wp/wp-config.php
fi