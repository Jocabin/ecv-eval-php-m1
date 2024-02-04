FROM php:8.2-apache

# You should mount your source code to this volume
VOLUME ["/var/www/html"]

# You could mount your extra config folder to this volume
# which resolves to '/usr/local/etc/php/conf.d/'
VOLUME ["$PHP_INI_DIR/conf.d/"]

# Install XDebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Install MySQL drivers
RUN apt-get update && docker-php-ext-install mysqli pdo pdo_mysql

# Use the default development configuration
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

EXPOSE 80
