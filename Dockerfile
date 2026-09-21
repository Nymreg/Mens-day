FROM php:8.3-apache

RUN docker-php-ext-install pdo_mysql mysqli

RUN a2enmod rewrite

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY docker/apache-security.conf /etc/apache2/conf-available/app-security.conf
COPY docker/app-site.conf /etc/apache2/sites-available/000-default.conf
RUN a2enconf app-security

COPY docker/app-entrypoint.sh /usr/local/bin/app-entrypoint
RUN sed -i 's/\r$//' /usr/local/bin/app-entrypoint \
    && chmod 0755 /usr/local/bin/app-entrypoint \
    && sh -n /usr/local/bin/app-entrypoint
ENTRYPOINT ["app-entrypoint"]
CMD ["apache2-foreground"]

COPY Pages/ /var/www/html/Pages/
COPY config/ /var/www/html/config/
COPY index.php /var/www/html/index.php

# Reject stale login sources and identify exactly which files Render built.
# Keep this after all application COPY instructions.
RUN set -eu; \
    auth_dir='/var/www/html/Pages/Login Page'; \
    test -f "$auth_dir/login.js"; \
    test -f "$auth_dir/login_conn_db.php"; \
    test -f "$auth_dir/login_conn_db_unsecured.php"; \
    grep -n 'login_conn_db' "$auth_dir/login.js"; \
    grep -Fq 'fetch("login_conn_db.php",' "$auth_dir/login.js"; \
    grep -Fq "databaseMysqli('mens_daydb')" "$auth_dir/login_conn_db.php"; \
    grep -Fq "require __DIR__ . '/login_conn_db.php';" "$auth_dir/login_conn_db_unsecured.php"; \
    if grep -Eq 'mysqli_connect|localhost|127\.0\.0\.1|new[[:space:]]+mysqli|SELECT|INSERT|UPDATE|DELETE' "$auth_dir/login_conn_db_unsecured.php"; then \
        echo 'ERROR: obsolete standalone login implementation is present.' >&2; exit 1; \
    fi; \
    if grep -Fq 'login_conn_db_unsecured.php' "$auth_dir/login.js"; then \
        echo 'ERROR: login.js calls the obsolete endpoint.' >&2; exit 1; \
    fi; \
    php -l "$auth_dir/login_conn_db.php"; \
    php -l "$auth_dir/login_conn_db_unsecured.php"; \
    sha256sum "$auth_dir/login.js" "$auth_dir/login_conn_db.php" "$auth_dir/login_conn_db_unsecured.php"

# Make the entry point and application readable regardless of build-context modes.
RUN find /var/www/html -type d -exec chmod 755 {} + \
    && find /var/www/html -type f -exec chmod 644 {} + \
    && test -f /var/www/html/index.php \
    && test -r /var/www/html/index.php \
    && test -d /var/www/html/Pages \
    && test -d /var/www/html/config \
    && test -f "/var/www/html/Pages/Landing Page/Landing Page Men's Day.php" \
    && su -s /bin/sh www-data -c "test -r /var/www/html/index.php && test -r \"/var/www/html/Pages/Landing Page/Landing Page Men's Day.php\" && test -r /var/www/html/config/database.php" \
    && php -l /var/www/html/index.php \
    && apache2ctl -t \
    && apache2ctl -S \
    && ls -la /var/www/html

EXPOSE 80
