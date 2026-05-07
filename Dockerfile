FROM php:8.2-apache-bookworm

RUN apt-get update && apt-get install -y     git curl libpng-dev libjpeg-dev libfreetype6-dev zip unzip &&     docker-php-ext-configure gd --with-freetype --with-jpeg &&     docker-php-ext-install gd pdo pdo_mysql

# Enable rewrite module
RUN a2enmod rewrite

WORKDIR /var/www/html
COPY . .

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Configure Apache to listen on the PORT environment variable
RUN sed -i "s/Listen 80/Listen \${PORT}/g" /etc/apache2/ports.conf
RUN sed -i "s/<VirtualHost \*:80>/<VirtualHost \*:\${PORT}>/g" /etc/apache2/sites-available/000-default.conf

EXPOSE 80

# Final runtime fix for MPM conflict, running migrations, and starting Apache
CMD ["sh", "-c", "php artisan migrate --force && a2dismod mpm_event mpm_worker || true && a2enmod mpm_prefork || true && apache2-foreground"]
