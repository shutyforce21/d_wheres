FROM php:8.0-apache
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY ./site-available/*.conf /etc/apache2/sites-enabled/
RUN apt-get update && apt-get install -y \
    git \
    && docker-php-ext-install pdo_mysql

COPY ./php.ini /usr/local/etc/php/php.ini

RUN mv /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled
RUN /bin/sh -c a2enmod rewrite
RUN git clone https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis && \
  docker-php-ext-install redis
