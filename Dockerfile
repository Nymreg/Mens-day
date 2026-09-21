FROM php:8.3-apache

RUN docker-php-ext-install pdo_mysql mysqli

RUN a2enmod rewrite

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY docker/apache-security.conf /etc/apache2/conf-available/app-security.conf
RUN a2enconf app-security

COPY Pages/ /var/www/html/Pages/
COPY config/ /var/www/html/config/
COPY index.php /var/www/html/index.php

EXPOSE 80
