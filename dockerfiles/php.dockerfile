FROM php:7.4-fpm-alpine

RUN apk --no-cache add curl-dev
RUN apk --no-cache add gmp-dev

RUN docker-php-ext-install pdo_mysql curl gmp

COPY /php/php.ini $PHP_INI_DIR/php.ini



