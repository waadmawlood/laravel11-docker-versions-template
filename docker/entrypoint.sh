#!/bin/bash

# Exit immediately if a command exits with a non-zero status
set -e

# Install dependencies
if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

# Copy .env file if not exists
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Set permissions
chown -R :www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Generate application key if APP_KEY in .env is empty
if grep -q '^APP_KEY=$' .env; then
    php artisan key:generate --force
fi

# Run migrations
php artisan migrate --seed

# Optimize
php artisan optimize:clear

# Start Supervisor
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
