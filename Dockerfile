FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    default-libmysqlclient-dev \
    && docker-php-ext-configure mysqli --with-mysqli \
    && docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli

RUN a2enmod rewrite

COPY ./scripts/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN service apache2 restart

EXPOSE 80

WORKDIR /var/www/html

# este archivo se ejecuta con el docker compose instalando algunas dependencias necesarias en el contenedor
