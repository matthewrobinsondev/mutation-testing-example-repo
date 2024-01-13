FROM php:8.1-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev

RUN docker-php-ext-install zip

RUN pecl install xdebug && docker-php-ext-enable xdebug

# Set Environment Variables
ENV XDEBUG_MODE=coverage
ENV MEMORY_LIMIT=512M

RUN echo "xdebug.mode = ${XDEBUG_MODE}" >> /usr/local/etc/php/php.ini
RUN echo "memory_limit = ${MEMORY_LIMIT}" >> /usr/local/etc/php/php.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /app