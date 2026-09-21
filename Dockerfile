FROM php:8.3-apache

RUN docker-php-ext-install pdo_mysql mysqli

RUN a2enmod rewrite

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY docker/apache-security.conf /etc/apache2/conf-available/app-security.conf
RUN a2enconf app-security

COPY Pages/ /var/www/html/Pages/
COPY config/ /var/www/html/config/
COPY index.php /var/www/html/index.php

# Make the entry point and application readable regardless of build-context modes.
RUN find /var/www/html -type d -exec chmod 755 {} + \
    && find /var/www/html -type f -exec chmod 644 {} + \
    && su -s /bin/sh www-data -c "test -r /var/www/html/index.php && test -r \"/var/www/html/Pages/Landing Page/Landing Page Men's Day.php\" && test -r /var/www/html/config/database.php" \
    && php -l /var/www/html/index.php \
    && apache2ctl -t

EXPOSE 80
