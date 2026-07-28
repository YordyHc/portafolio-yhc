#!/bin/bash

echo "Iniciando Laravel..."

php artisan storage:link || true

php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Laravel listo."

apache2-foreground