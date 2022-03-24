FROM php:8.1.4-fpm-alpine3.15

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /srv/app

CMD ["composer", "instal"]
