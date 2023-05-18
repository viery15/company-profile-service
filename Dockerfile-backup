# Set the base image to the official PHP image with Apache
FROM php:8.2.4-apache

# Install required PHP extensions
RUN docker-php-ext-install pdo_mysql

# Set the working directory
WORKDIR /var/www/html

# Copy the Laravel application files to the container
COPY . /var/www/html

# Install composer dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-interaction --no-dev --prefer-dist

# Set up permissions for Laravel storage and bootstrap directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Set up Apache document root
RUN sed -i -e 's/html/html\/public/g' /etc/apache2/sites-enabled/000-default.conf

RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
RUN a2enmod rewrite
RUN service apache2 restart

# Expose port 80 for Apache
EXPOSE 80

# Start Apache web server
CMD ["apache2-foreground"]
