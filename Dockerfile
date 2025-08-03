FROM php:8.1-apache

# Enable URL rewriting (optional but useful)
RUN a2enmod rewrite

# Copy everything into container
COPY . /var/www/

# Set Apache DocumentRoot to /var/www/public
ENV APACHE_DOCUMENT_ROOT=/var/www/public

# Update default Apache site to use the new root
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

# ✅ Fix permissions
RUN chown -R www-data:www-data /var/www/public \
    && chmod -R 755 /var/www/public

# Set working directory
WORKDIR /var/www/public
