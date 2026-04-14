FROM wordpress:php8.2-apache

RUN a2enmod rewrite

WORKDIR /var/www/html
