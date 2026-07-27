# ---------- Etapa 1 ----------
FROM composer:2 AS composer

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-scripts \
    --no-interaction

COPY . .

RUN composer dump-autoload --optimize

# ---------- Etapa 2 ----------
FROM node:22 AS frontend

WORKDIR /app

COPY package*.json ./

RUN npm install

COPY . .

RUN npm run build

# ---------- Etapa 3 ----------
FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql zip

RUN a2enmod rewrite

WORKDIR /var/www/html

COPY --from=composer /app ./

COPY --from=frontend /app/public/build ./public/build

RUN chown -R www-data:www-data storage bootstrap/cache

RUN chmod -R 775 storage bootstrap/cache

COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80

CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    apache2-foreground