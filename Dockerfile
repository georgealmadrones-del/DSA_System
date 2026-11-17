FROM richarvey/nginx-php-fpm:latest

COPY . .

# Image configuration
ENV SKIP_COMPOSER 0
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV COMPOSER_ALLOW_SUPERUSER 1

# Run composer install ignoring platform version requirements
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

EXPOSE 80