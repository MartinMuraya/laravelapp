#!/usr/bin/env bash
# Exit on error
set -o errexit  

# Install PHP extensions required for PostgreSQL
apt-get update
apt-get install -y libpq-dev
docker-php-ext-install pdo_pgsql

# Install Composer dependencies
composer install --no-dev --optimize-autoloader

# Run Laravel setup
php artisan config:cache
php artisan route:cache
php artisan view:cache
