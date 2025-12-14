# syntax=docker/dockerfile:1

FROM composer:2 AS composer

FROM php:8.4-fpm AS php-base
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git unzip libpq-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*
WORKDIR /var/www/html
COPY --from=composer /usr/bin/composer /usr/bin/composer

FROM php:8.4-cli AS php-cli
RUN apt-get update \
    && apt-get install -y --no-install-recommends git unzip libpq-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*
WORKDIR /var/www/html
COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY . .
RUN composer install --no-interaction --prefer-dist --no-progress

FROM php-base AS php-fpm
COPY . .
RUN composer install --no-interaction --prefer-dist --no-progress \
    && chown -R www-data:www-data storage bootstrap/cache
CMD ["php-fpm"]
