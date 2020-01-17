FROM php:7.2-fpm

#Set timezone
RUN rm /etc/localtime
RUN ln -s /usr/share/zoneinfo/Europe/London /etc/localtime

# PHP extensions
RUN apt-get update && apt-get install -y \
        git \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libfontconfig \
        libxrender1 \
        libzmq3-dev \
        libzip-dev \
        zlib1g-dev \
        unzip \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-configure bcmath --enable-bcmath \
    && docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install -j$(nproc) iconv gd zip exif pdo_mysql bcmath opcache

# PECL packages
RUN pecl install redis zmq-beta mcrypt-1.0.1 && docker-php-ext-enable redis mcrypt zmq

#Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
COPY ./environment/local/php-fpm/mikomax.ini $PHP_INI_DIR/conf.d/

WORKDIR /var/www/html
