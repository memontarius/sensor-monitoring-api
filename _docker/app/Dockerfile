FROM php:8.4-fpm

# Install packages
RUN apt-get update && apt-get install -y \
      apt-utils \
      libpq-dev \
      libpng-dev \
      libicu-dev \
      libzip-dev \
      zip unzip \
      git && \
      docker-php-ext-install pdo_pgsql && \
      docker-php-ext-install bcmath && \
      docker-php-ext-install gd && \
      docker-php-ext-install zip && \
      docker-php-ext-configure intl &&  \
      docker-php-ext-install intl && \
      apt-get clean && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*


WORKDIR /var/www

# Configure non-root user.
ARG PUID=1000
ARG PGID=1000
RUN groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

RUN chown -R www-data:www-data /var/www

COPY ./_docker/app/php.ini /usr/local/etc/php/conf.d/php.ini

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

CMD php-fpm
EXPOSE 9000
