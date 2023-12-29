FROM php:7.4-fpm-alpine

WORKDIR /usr/src/app

RUN docker-php-ext-install pdo_mysql

CMD php -S 0.0.0.0:80 -t .
