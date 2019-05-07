FROM php:7.2-fpm

COPY composer.lock composer.json /var/www/

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    build-essential \
    mysql-client \
    locales \
    vim \
    git \
    curl

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install mysqli pdo_mysql mbstring exif pcntl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

COPY . /var/www

COPY --chown=www:www . /var/www

USER www

EXPOSE 9000
CMD ["php-fpm"]