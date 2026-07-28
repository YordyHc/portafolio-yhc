#!/bin/bash

echo "Configurando Laravel..."

php artisan storage:link || true

php artisan config:cache
php artisan route:cache
php artisan view:cache


echo "Iniciando Apache..."

apache2-foreground