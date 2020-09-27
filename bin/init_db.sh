#!/bin/sh

echo "[INFO] Run initial data for database..."

docker-compose exec lotus-web php artisan db:seed