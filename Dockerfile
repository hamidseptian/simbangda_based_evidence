# Stage untuk build aplikasi PHP dengan Nginx
FROM php:7.3-fpm-alpine AS build-stage

# Metadata
LABEL maintainer="Rio Bayu Sentosa <riobayusentosa@sumbarprov.go.id>" \
      description="Dockerfile aplikasi CodeIgniter 3 dengan PHP 7.3 FPM + Nginx (Alpine)" \
      version="1.2"

# Copy konfigurasi PHP
COPY deploy/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY deploy/php/php.ini /usr/local/etc/php/php.ini
COPY deploy/php/php-fpm.conf /usr/local/etc/php-fpm.conf
COPY deploy/php/php-fpm.d/www.conf /usr/local/etc/php-fpm.d/www.conf

# Sertifikat SSL pihak ketiga
COPY deploy/cert/ /etc/comodossl/

WORKDIR /var/www/

# Install dependency sistem (Alpine)
RUN apk add --no-cache \
    tzdata \
    nginx \
    build-base \
    pkgconfig \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    unzip \
    git \
    curl \
    oniguruma-dev \
    libxml2-dev \
    libpq-dev \
    nano \
    ca-certificates

# Trust custom SSL cert
RUN cp /etc/comodossl/*.crt /usr/local/share/ca-certificates/ && update-ca-certificates

# Timezone
ENV TZ=Asia/Jakarta
RUN cp /usr/share/zoneinfo/$TZ /etc/localtime && echo "$TZ" > /etc/timezone

# Install ekstensi PHP
RUN docker-php-ext-install \
    opcache \
    mysqli \
    pdo_mysql \
    pdo_pgsql \
    pgsql \
    mbstring \
    zip \
    exif \
    pcntl

# Enable mysqli
RUN docker-php-ext-enable mysqli

# ✅ GD FIX KHUSUS ALPINE + PHP 7.3
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    && docker-php-ext-install gd

# Konfigurasi Nginx
COPY deploy/nginx/ /etc/nginx/
RUN nginx -t

# Runtime dir nginx
RUN mkdir -p /run/nginx

# Copy source project
COPY . /var/www/

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Cleanup
RUN rm -rf /var/www/deploy .gitlab-ci.yml Dockerfile

# Permission
RUN mkdir -p /var/log/nginx \
    && chown -R www-data:www-data /var/log/nginx /var/lib/nginx /run/nginx \
    && chown -R root:root /var/www

EXPOSE 5001

CMD ["sh", "-c", "rm -rf /var/www/deploy && php-fpm -D && nginx -g 'daemon off;'"]

USER www-data
