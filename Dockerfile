FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    libxml2-dev \
    libzip-dev \
    libonig-dev \
    git \
    curl \
    unzip

RUN docker-php-ext-install mbstring bcmath xml dom zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN useradd -G www-data,root -u 1000 -d /home/user user
RUN mkdir -p /home/user/.composer && chown -R user:user /home/user

RUN mkdir -p /var/www/html
RUN chown -R user:user /var/www/html

USER user
WORKDIR /var/www/html