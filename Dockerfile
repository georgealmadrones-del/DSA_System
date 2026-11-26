#!/usr/bin/env bash
set -e

echo "Running database migrations..."
php artisan migrate --force --no-interaction

echo "Caching configuration..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Clearing views..."
php artisan view:clear