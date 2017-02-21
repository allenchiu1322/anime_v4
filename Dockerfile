FROM php:apache
RUN apt-get update && docker-php-ext-install -j$(nproc) iconv mysqli mbstring opcache pdo pdo_mysql
RUN a2enmod rewrite
