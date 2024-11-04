FROM composer:2.8.2 AS deps

WORKDIR /app

RUN --mount=type=bind,source=composer.json,target=composer.json \
    --mount=type=bind,source=composer.lock,target=composer.lock \
    --mount=type=cache,target=/tmp/cache \
    composer install --no-dev --no-interaction

FROM php:8.3.11-apache AS final

# Setup project
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY --from=deps app/vendor/ /var/www/html/vendor
COPY ./public /var/www/html/public
COPY ./src /var/www/html/src

# Set environment variable for document root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Update the Apache config to use the DocumentRoot
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# Allow rewrite
RUN a2enmod rewrite

# Allow custom config
COPY ./config/custom.conf /etc/apache2/conf-available/custom.conf
RUN a2enconf custom

# Set appropriate permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80

# Set user to www-data
USER www-data
