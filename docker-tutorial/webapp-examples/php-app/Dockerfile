# Use an official PHP image with Apache
# You can choose specific versions, e.g., php:8.1-apache, php:8.2-apache
FROM php:8.1-apache

# The default PHP Apache images expect your application code to be in /var/www/html.
# Copy the application files from the current directory to /var/www/html in the container.
COPY . /var/www/html/

# Optional: Install any PHP extensions you might need.
# For example, to install mysqli for MySQL database connection:
# RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
# Or for PDO MySQL:
# RUN docker-php-ext-install pdo pdo_mysql && docker-php-ext-enable pdo_mysql

# Optional: Set environment variables
ENV APP_NAME="PHP Docker Demo"

# Port 80 is exposed by default by the base image.
# EXPOSE 80

# The base image already has a CMD to start Apache.
