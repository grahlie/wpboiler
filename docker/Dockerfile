FROM php:7.3-apache

WORKDIR /

ARG DBNAME
ARG DBUSER
ARG DBPASS
ARG DBHOST
ARG MULTISITE=0
ARG DOMAIN
ARG DEBUGMODE=0
ARG HTTPS=0

ENV DEBIAN_FRONTEND noninteractive
ENV TERM xterm
ENV PS1 "cms-\h:\w> "
ENV DBNAME $DBNAME
ENV DBUSER $DBUSER
ENV DBPASS $DBPASS
ENV DBHOST $DBHOST
ENV MULTISITE $MULTISITE
ENV DOMAIN $DOMAIN
ENV DEBUGMODE $DEBUGMODE
ENV HTTPS $HTTPS

RUN apt-get update; \
    apt-get install -y --no-install-recommends \
        less sendmail \
        libjpeg-dev \
		libpng-dev \
    ; \
	docker-php-ext-install gd mysqli opcache; \
    apt-get clean && \
    rm -r /var/lib/apt/lists/* && \
    rm -r /var/www/html && \
    rm /etc/apache2/sites-enabled/000-default.conf;

ADD create_htaccess.sh create_wpconfig.sh config_htaccess config_wpconfig config_apache config_php ./
    
RUN chmod +x create_htaccess.sh create_wpconfig.sh; \
    /create_htaccess.sh && /create_wpconfig.sh; \
    \
    cat /config_htaccess >> /var/www/.htaccess; \
    cat /config_wpconfig >> /var/www/wp-config.php; \
    \
    mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"; \
    cat /config_php >>  "$PHP_INI_DIR/php.ini"; \
    \
    rm create_htaccess.sh create_wpconfig.sh config_htaccess config_php config_wpconfig; \
    \
    mkdir -p /var/www/wp-content/uploads; \
    chown -R www-data:www-data /var/www/wp-content;

RUN a2enmod rewrite expires deflate headers; \
    yes | /usr/sbin/sendmailconfig;

EXPOSE 80

CMD ["apache2-foreground"]
