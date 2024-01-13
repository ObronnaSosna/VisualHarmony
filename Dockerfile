FROM php:8.3.2RC1-apache
RUN docker-php-ext-install mysqli
