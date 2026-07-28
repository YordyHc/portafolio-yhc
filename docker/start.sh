#!/bin/bash

echo "Inicializando Laravel..."

php artisan storage:link || true


echo "Ejecutando migraciones..."

php artisan migrate --force


echo "Optimizando Laravel..."

php artisan optimize:clear

echo "Aplicación lista"

echo "Probando conexión SMTP..."

php -r "
\$fp = fsockopen('smtp.gmail.com', 587, \$errno, \$errstr, 10);
if (!\$fp) {
    echo \"ERROR: \$errno - \$errstr\n\";
} else {
    echo \"SMTP OK\n\";
    fclose(\$fp);
}
"

apache2-foreground