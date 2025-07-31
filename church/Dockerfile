# Use the official PHP image with Apache
FROM php:8.1-apache

# Copy all project files into the web server root
COPY . /var/www/html/

# Enable Apache rewrite module if needed
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Expose port 80 (default for HTTP)
EXPOSE 80
