FROM php:8.2-fpm-alpine

# Install dependencies
RUN  apk add --no-cache --virtual .build-deps \
            autoconf \
            $PHPIZE_DEPS \
            build-base \
            freetype-dev \
            icu-dev \
            libjpeg-turbo-dev \
            libpng-dev \
            libtool \
            libwebp-dev \
            libzip-dev \
            zlib-dev \
            postgresql-dev

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install gd pdo pdo_pgsql zip
