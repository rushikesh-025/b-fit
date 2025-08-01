FROM php:8.1-apache

# Enable PHP extensions like MySQLi
RUN docker-php-ext-install mysqli

# Copy project to Apache web root
COPY . /var/www/html/

# Change working directory to public/
WORKDIR /var/www/html/public
FROM httpd:2.4

# Copy all files to Apache's web root
COPY . /usr/local/apache2/htdocs/
FROM php:8.1-apache

# Copy your HTML files to the web root
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Enable Apache rewrite module (optional, if you use .htaccess)
RUN a2enmod rewrite
