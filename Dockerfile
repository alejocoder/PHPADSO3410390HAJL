FROM php:8.4-apache

# Solo lo esencial para PHP puro + MySQL (sin compilar: build rápido)
RUN docker-php-ext-install -j"$(nproc)" mysqli pdo_mysql opcache

# .htaccess y rutas amigables
RUN a2enmod rewrite

# Apache escribe con tu mismo uid (1000) para evitar problemas de permisos
RUN usermod -u 1000 www-data

WORKDIR /var/www/html
