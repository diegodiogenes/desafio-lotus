#!/bin/sh

echo "[INFO] Run initial data for database..."

docker-compose exec lotus-web php artisan db:seed

docker-compose exec lotus-web php artisan passport:install