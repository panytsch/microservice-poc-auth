FROM php:7.4.2-fpm

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git && \
    apt-get install -y libzip-dev && \
    docker-php-ext-install pcntl && \
    pecl install xdebug-2.9.2 && \
    docker-php-ext-install zip && \
    docker-php-ext-install pdo pdo_mysql && \
    docker-php-ext-enable xdebug zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

CMD ["php-fpm"]