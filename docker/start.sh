#!/bin/bash

echo "Inicializando Laravel..."

php artisan storage:link || true


echo "Ejecutando migraciones..."

php artisan migrate --force


echo "Optimizando Laravel..."

php artisan optimize:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache


echo "Aplicación lista"

apache2-foreground