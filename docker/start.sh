#!/bin/bash

echo "Inicializando Laravel..."

php artisan storage:link || true

echo "Ejecutando migraciones..."

php artisan optimize:clear

php artisan migrate --force

echo "Probando conexión SMTP..."

php docker/test-smtp.php

echo "Generando cache..."

php artisan config:cache
php artisan route:cache
php artisan view:cache

apache2-foreground