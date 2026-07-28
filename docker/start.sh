#!/bin/bash

echo "Inicializando Laravel..."

php artisan storage:link || true

echo "Ejecutando migraciones..."

php artisan optimize:clear

php artisan migrate --force

echo "Probando conexión SMTP..."

php -r "
$ip = gethostbyname('smtp.gmail.com');

echo "IP: $ip\n";

$fp = fsockopen($ip, 465, $errno, $errstr, 10);

if (!$fp) {
    echo "ERROR $errno - $errstr\n";
} else {
    echo "SMTP OK\n";
}
"

echo "Generando cache..."

php artisan config:cache
php artisan route:cache
php artisan view:cache

apache2-foreground