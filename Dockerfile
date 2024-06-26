# Use the official PHP image as the base image
FROM php:apache

# Install MySQLi extension
RUN docker-php-ext-install mysqli

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy the application code to the container
COPY . /var/www/html

# Set the working directory
WORKDIR /var/www/html
