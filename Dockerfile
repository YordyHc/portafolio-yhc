FROM composer:2 AS builder

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --no-scripts



FROM php:8.4-apache
# Instalar paquetes del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP necesarias
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    zip \
    intl

# Activar mod_rewrite para Laravel
RUN a2enmod rewrite

COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

COPY . .

COPY --from=builder /app/vendor ./vendor

#ESTO ES PARA LOCAL
#COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh

#RUN chmod +x /usr/local/bin/entrypoint.sh

# Permisos Laravel
#RUN chown -R www-data:www-data storage bootstrap/cache \
    #&& chmod -R 775 storage bootstrap/cache

#ENTRYPOINT ["entrypoint.sh"]

#-------------------------

#ESTO ES PARA RENDER

COPY docker/start.sh /usr/local/bin/start.sh

RUN chmod +x /usr/local/bin/start.sh


RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache


CMD ["start.sh"]

#-------------------------