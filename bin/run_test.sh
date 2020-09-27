#!/bin/sh

echo "[INFO] Run the system tests..."

docker-compose exec lotus-web php artisan test