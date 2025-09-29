# Use the official PHP image with Apache
FROM php:8.2-apache

# Install common PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql && \
    docker-php-ext-enable mysqli pdo pdo_mysql

# Copy project files to the Apache document root
COPY innolink/ /var/www/html/

# Set permissions (optional, for development)
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80

# Enable Apache mod_rewrite (optional, for pretty URLs)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html
