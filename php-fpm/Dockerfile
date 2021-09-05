FROM php:8.0-fpm-alpine
#
ARG UID
WORKDIR "/var/www/html"

RUN apk add --no-cache \
git openssh composer coreutils sudo mc bash ncurses busybox-extras less mysql-client \
libxml2 libxslt libxml2-dev libxslt-dev imap-dev icu-dev freetype-dev \
libjpeg-turbo-dev libpng-dev libzip-dev autoconf gcc libc-dev make


# RUN docker-php-ext-configure xml --with-libxml-dir=/usr/include/libxml2/

RUN docker-php-ext-install pdo_mysql xsl calendar imap intl zip gd

#composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV PHP_INI_DIR /usr/local/etc/php
RUN pecl install xdebug-3.0.4 && docker-php-ext-enable xdebug

# Add user with superuser privileges
ENV USER appuser
RUN adduser --disabled-password -u $UID $USER \
        && echo "$USER ALL=(ALL) NOPASSWD: ALL" > /etc/sudoers.d/$USER \
        && chmod 0440 /etc/sudoers.d/$USER
USER appuser
