# Use the official WordPress image with PHP 8.2 and Apache
FROM wordpress:6.4-php8.2-apache

# Install additional PHP extensions if needed
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Set working directory
WORKDIR /var/www/html

# Copy WordPress files
COPY . /var/www/html/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# wp-config.php is already configured with production values

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
