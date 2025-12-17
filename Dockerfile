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
RUN set -eux; \
    groupadd --force --gid 1337 sail || true; \
    useradd --no-log-init --create-home --uid 1337 --gid 1337 sail || true; \
    composer install --no-interaction --prefer-dist --no-progress; \
    chown -R sail:sail storage bootstrap/cache
USER sail
CMD ["php-fpm"]
