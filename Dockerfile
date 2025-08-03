FROM php:8.1-apache

# Enable rewrite module (optional but good practice)
RUN a2enmod rewrite

# Copy all project files
COPY . /var/www/

# Set public/ as Apache document root
ENV APACHE_DOCUMENT_ROOT=/var/www/public

# Update Apache config to point to public/
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

# ✅ Explicitly tell Apache to use index.html as the default page
RUN echo "DirectoryIndex index.html index.php" > /etc/apache2/conf-available/custom-index.conf \
    && a2enconf custom-index

# ✅ Ensure proper file permissions
RUN chown -R www-data:www-data /var/www/public \
    && chmod -R 755 /var/www/public

# Set working directory
WORKDIR /var/www/public
