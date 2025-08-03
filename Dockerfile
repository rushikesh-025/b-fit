FROM php:8.1-apache

# Enable URL rewriting (optional but useful)
RUN a2enmod rewrite

# Copy entire app to /var/www
COPY . /var/www/

# Set Apache DocumentRoot to /var/www/public
ENV APACHE_DOCUMENT_ROOT=/var/www/public

# Update default Apache site to use new root
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

# Set working directory to public
WORKDIR /var/www/public
