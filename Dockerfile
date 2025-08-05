FROM php:8.1-apache

# Install MySQL extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Enable rewrite module
RUN a2enmod rewrite

# Copy public folder
COPY public/ /var/www/html/

# Permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
