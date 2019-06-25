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
    less sendmail libjpeg-dev libpng-dev; \
    docker-php-ext-install gd mysqli opcache; \
    apt-get clean; \
    rm -r /var/lib/apt/lists/*; \
    rm /etc/apache2/sites-available/000-default.conf; \
    rm -r /var/www/html;

ADD config_apache config_php ./

RUN cat /config_apache >> /etc/apache2/sites-available/000-default.conf; \
    mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"; \
    cat /config_php >>  "$PHP_INI_DIR/php.ini"; \
    rm config_php; \
    mkdir -p /var/www/html/wp-content/uploads; \
    chown -R www-data:www-data /var/www/html/wp-content;

RUN a2enmod rewrite expires deflate headers; \
    yes | /usr/sbin/sendmailconfig;

EXPOSE 80

CMD ["apache2-foreground"]