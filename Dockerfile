FROM php:8.2-fpm

# Install MySQLi and PDO MySQL extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

COPY . /var/www/html

EXPOSE 80
