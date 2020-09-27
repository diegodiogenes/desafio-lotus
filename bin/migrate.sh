#!/bin/sh

echo "[INFO] Run the migrations..."

docker-compose exec lotus-web php artisan migrate