FROM php:7.2-fpm

RUN apt-get update && apt-get install -y \
        libmcrypt-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        && pecl install mcrypt-1.0.1 \
        && pecl install redis \
        && docker-php-ext-enable mcrypt \
        && docker-php-ext-enable redis \
        && apt-get install -y libpq-dev \
        && apt-get install -y zlib1g-dev libicu-dev g++ \
        && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
        && docker-php-ext-install -j$(nproc) gd \
        && docker-php-ext-install exif \
        && docker-php-ext-install opcache \
        && docker-php-ext-install pdo pdo_mysql pdo_pgsql

