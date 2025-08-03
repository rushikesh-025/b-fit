FROM php:8.1-apache

RUN a2enmod rewrite

COPY . /var/www/

ENV APACHE_DOCUMENT_ROOT=/var/www/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

# ✅ Tell Apache to use index.html as default
RUN echo "DirectoryIndex index.html index.php" > /etc/apache2/conf-available/custom-index.conf \
    && a2enconf custom-index

# ✅ Fix permissions
RUN chown -R www-data:www-data /var/www/public \
    && chmod -R 755 /var/www/public

WORKDIR /var/www/public
