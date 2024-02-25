FROM php:8.2-fpm

ADD php.ini /etc/php

RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/bin/ --filename=composer

RUN apt-get update && apt-get install -y \
        git \
        openssh-client \
        curl \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        zip \
        unzip \
        mc \
        htop \
        nano \
        cron \
        procps \
        jpegoptim \
        optipng \
        pngquant

RUN docker-php-ext-install mysqli pdo pdo_mysql

WORKDIR /var/www
