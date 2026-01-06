# Stage untuk build aplikasi PHP dengan Nginx
FROM php:7.3-fpm-alpine AS build-stage

LABEL maintainer="Rio Bayu Sentosa <riobayusentosa@sumbarprov.go.id>" \
      description="Dockerfile aplikasi CodeIgniter 3 dengan PHP 7.3 FPM + Nginx (Alpine)" \
      version="1.2"

# Set direktori kerja
WORKDIR /var/www/

# ===============================
# Copy konfigurasi PHP & FPM
# ===============================
COPY deploy/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY deploy/php/php.ini /usr/local/etc/php/php.ini
COPY deploy/php/php-fpm.conf /usr/local/etc/php-fpm.conf
COPY deploy/php/php-fpm.d/www.conf /usr/local/etc/php-fpm.d/www.conf

# ===============================
# Sertifikat SSL pihak ketiga
# ===============================
COPY deploy/cert/ /etc/comodossl/

# ===============================
# Install dependency sistem
# ===============================
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
RUN cp /etc/comodossl/*.crt /usr/local/share/ca-certificates/ \
    && update-ca-certificates

# ===============================
# Timezone
# ===============================
ENV TZ=Asia/Jakarta
RUN cp /usr/share/zoneinfo/$TZ /etc/localtime \
    && echo "$TZ" > /etc/timezone \
    && date


RUN docker-php-ext-install calendar
# ===============================
# PHP Extensions
# ===============================
RUN docker-php-ext-install \
    opcache \
    mysqli \
    pdo_mysql \
    pdo_pgsql \
    pgsql \
    mbstring \
    zip \
    exif \
    pcntl \
    gd

RUN docker-php-ext-enable mysqli

# ⚠️ PENTING:
# TIDAK ADA docker-php-ext-configure gd
# Alpine + PHP 7.3 akan auto-detect JPEG & FreeType

# ===============================
# Konfigurasi Nginx
# ===============================
COPY deploy/nginx/ /etc/nginx/
RUN mkdir -p /run/nginx && nginx -t

# ===============================
# Copy source project
# ===============================
COPY . /var/www/

# ===============================
# Composer
# ===============================
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --no-progress || true

# ===============================
# Cleanup
# ===============================
RUN rm -rf /var/www/deploy \
           .gitlab-ci.yml \
           Dockerfile

# ===============================
# Permission
# ===============================

RUN mkdir -p /var/log/nginx \
    && chown -R www-data:www-data /var/log/nginx \
    && chmod -R 755 /var/log/nginx

RUN chown -R root:root /var/www
RUN chown -R www-data:www-data /var/lib/nginx
RUN chown www-data:www-data /var/run/nginx.pid || true
# ===============================
# Expose Port
# ===============================
EXPOSE 8080

# ===============================
# Run Services
# ===============================
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]

USER www-data