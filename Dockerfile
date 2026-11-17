FROM richarvey/nginx-php-fpm:latest

COPY . .

# Image configuration
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV COMPOSER_ALLOW_SUPERUSER 1


# Expose port 80
EXPOSE 80