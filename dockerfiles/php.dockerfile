FROM php:7.4-fpm-alpine

RUN apk --no-cache add curl-dev
RUN apk --no-cache add gmp-dev
RUN apk --no-cache add icu-dev
RUN apk --no-cache add supervisor

RUN docker-php-ext-install pdo_mysql curl gmp intl

COPY /dockerfiles/php/php.ini $PHP_INI_DIR/php.ini

COPY /dockerfiles/php/supervisord.conf /etc/supervisord.conf
CMD  ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]


