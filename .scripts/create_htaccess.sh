#!/usr/bin/env bash

echo "==============="
echo "Running $(basename $0)"
echo "==============="

FILE=$1
source ./parse-config.sh $FILE

if [ "$MULTISITE" -gt 0 ]; then
    echo "# BEGIN WordPress"                                                            >>../$FOLDER/wp/.htaccess
    echo "<IfModule mod_rewrite.c>"                                                     >>../$FOLDER/wp/.htaccess
    echo "RewriteEngine On"                                                             >>../$FOLDER/wp/.htaccess
    echo "RewriteBase /"                                                                >>../$FOLDER/wp/.htaccess
    echo "RewriteRule ^server-status - [L]"                                             >>../$FOLDER/wp/.htaccess
    echo "RewriteRule ^index\.php$ - [L]"                                               >>../$FOLDER/wp/.htaccess
    echo "# add a trailing slash to /wp-admin"                                          >>../$FOLDER/wp/.htaccess
    echo "RewriteRule ^([_0-9a-zA-Z-]+/)?wp-admin$ $1wp-admin/ [R=301,L]"               >>../$FOLDER/wp/.htaccess
    echo "RewriteCond %{REQUEST_FILENAME} -f [OR]"                                      >>../$FOLDER/wp/.htaccess
    echo "RewriteCond %{REQUEST_FILENAME} -d"                                           >>../$FOLDER/wp/.htaccess
    echo "RewriteRule ^ - [L]"                                                          >>../$FOLDER/wp/.htaccess
    echo "RewriteRule ^([_0-9a-zA-Z-]+/)?(wp-(content|admin|includes).*) $2 [L]"        >>../$FOLDER/wp/.htaccess
    echo "RewriteRule ^([_0-9a-zA-Z-]+/)?(.*\.php)$ $2 [L]"                             >>../$FOLDER/wp/.htaccess
    echo "RewriteRule . index.php [L]"                                                  >>../$FOLDER/wp/.htaccess
    echo "</IfModule>"                                                                  >>../$FOLDER/wp/.htaccess
    echo "# END WordPress"                                                              >>../$FOLDER/wp/.htaccess
else
    echo "# BEGIN WordPress"                                                            >>../$FOLDER/wp/.htaccess
    echo "<IfModule mod_rewrite.c>"                                                     >>../$FOLDER/wp/.htaccess
    echo "RewriteEngine On"                                                             >>../$FOLDER/wp/.htaccess
    echo "RewriteBase /"                                                                >>../$FOLDER/wp/.htaccess
    echo "RewriteRule ^server-status - [L]"                                             >>../$FOLDER/wp/.htaccess
    echo "RewriteRule ^index\.php$ - [L]"                                               >>../$FOLDER/wp/.htaccess
    echo "RewriteCond %{REQUEST_FILENAME} !-f"                                          >>../$FOLDER/wp/.htaccess
    echo "RewriteCond %{REQUEST_FILENAME} !-d"                                          >>../$FOLDER/wp/.htaccess
    echo "RewriteRule . /index.php [L]"                                                 >>../$FOLDER/wp/.htaccess
    echo "</IfModule>"                                                                  >>../$FOLDER/wp/.htaccess
    echo "# END WordPress"                                                              >>../$FOLDER/wp/.htaccess
fi


echo "# Config added from code"                                                         >>../$FOLDER/wp/.htaccess
echo "<IfModule mod_deflate.c>"                                                         >>../$FOLDER/wp/.htaccess
echo "  # Compress HTML, CSS, JavaScript, Text, XML and fonts"                          >>../$FOLDER/wp/.htaccess
echo "  AddOutputFilterByType DEFLATE application/javascript"                           >>../$FOLDER/wp/.htaccess
echo "  AddOutputFilterByType DEFLATE application/rss+xml"                              >>../$FOLDER/wp/.htaccess
echo "  AddOutputFilterByType DEFLATE application/vnd.ms-fontobject"                    >>../$FOLDER/wp/.htaccess
echo "  AddOutputFilterByType DEFLATE application/x-font"                               >>../$FOLDER/wp/.htaccess
echo "  AddOutputFilterByType DEFLATE application/x-font-opentype"                      >>../$FOLDER/wp/.htaccess
echo "  AddOutputFilterByType DEFLATE application/x-font-otf"                           >>../$FOLDER/wp/.htaccess
echo "  AddOutputFilterByType DEFLATE application/x-font-truetype"                      >>../$FOLDER/wp/.htaccess
echo "  AddOutputFilterByType DEFLATE application/x-font-ttf"                           >>../$FOLDER/wp/.htaccess
echo "  AddOutputFilterByType DEFLATE application/x-javascript"                         >>../$FOLDER/wp/.htaccess
echo "  AddOutputFilterByType DEFLATE application/xhtml+xml"                            >>../$FOLDER/wp/.htaccess
echo "  AddOutputFilterByType DEFLATE application/xml"                                  >>../$FOLDER/wp/.htaccess
echo "  AddOutputFilterByType DEFLATE font/opentype"                                    >>../$FOLDER/wp/.htaccess
echo "  AddOutputFilterByType DEFLATE font/otf"                                         >>../$FOLDER/wp/.htaccess
echo "  AddOutputFilterByType DEFLATE font/ttf"                                         >>../$FOLDER/wp/.htaccess
echo "  AddOutputFilterByType DEFLATE image/svg+xml"                                    >>../$FOLDER/wp/.htaccess
echo "  AddOutputFilterByType DEFLATE image/x-icon"                                     >>../$FOLDER/wp/.htaccess
echo "  AddOutputFilterByType DEFLATE text/css"                                         >>../$FOLDER/wp/.htaccess
echo "  AddOutputFilterByType DEFLATE text/html"                                        >>../$FOLDER/wp/.htaccess
echo "  AddOutputFilterByType DEFLATE text/javascript"                                  >>../$FOLDER/wp/.htaccess
echo "  AddOutputFilterByType DEFLATE text/plain"                                       >>../$FOLDER/wp/.htaccess
echo "  AddOutputFilterByType DEFLATE text/xml"                                         >>../$FOLDER/wp/.htaccess
echo ""                                                                                 >>../$FOLDER/wp/.htaccess
echo "  # Remove browser bugs (only needed for really old browsers)"                    >>../$FOLDER/wp/.htaccess
echo "  BrowserMatch ^Mozilla/4 gzip-only-text/html"                                    >>../$FOLDER/wp/.htaccess
echo "  BrowserMatch ^Mozilla/4\.0[678] no-gzip"                                        >>../$FOLDER/wp/.htaccess
echo "  BrowserMatch \bMSIE !no-gzip !gzip-only-text/html"                              >>../$FOLDER/wp/.htaccess
echo "  Header append Vary User-Agent"                                                  >>../$FOLDER/wp/.htaccess
echo "</IfModule>"                                                                      >>../$FOLDER/wp/.htaccess
