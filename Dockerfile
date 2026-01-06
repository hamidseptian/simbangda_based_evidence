
# Stage untuk build aplikasi PHP dengan Nginx
FROM php:7.3-fpm-alpine as build-stage

# Copy file konfigurasi OPcache dan PHP-FPM
COPY deploy/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY deploy/php/php.ini /usr/local/etc/php/php.ini
COPY deploy/php/php-fpm.conf  /usr/local/etc/php-fpm.conf
COPY deploy/php/php-fpm.d/www.conf  /usr/local/etc/php-fpm.d/www.conf

# Sertifikat SSL pihak ketiga
COPY deploy/cert/ /etc/comodossl/

# Set direktori kerja
WORKDIR /var/www/


LABEL maintainer="Rio Bayu Sentosa <riobayusentosa@sumbarprov.go.id>" \
      description="Dockerfile untuk aplikasi berbasis CodeIgniter 3 dengan PHP 8.4 dan Nginx" \
      version="1.1"

# Install dependensi sistem
RUN apk --no-cache add \
    tzdata \
    nginx \
    build-base \
    libpng-dev \
    libjpeg-turbo-dev \
    libzip-dev \
    unzip \
    git \
    curl \
    oniguruma-dev \
    libxml2-dev \
    freetype-dev \
    libpq-dev \
    nano \
    ca-certificates

# Tambahkan custom SSL cert ke trusted store
RUN cp /etc/comodossl/*.crt /usr/local/share/ca-certificates/ && update-ca-certificates

# Tes SMTP server (non-blocking)
RUN echo "Testing SMTP connectivity to smtp.gmail.com:587" && \
    nc -zvw5 smtp.gmail.com 587 || echo "⚠️  WARNING: SMTP server smtp.gmail.com:587 tidak dapat diakses saat build"

# Set zona waktu
ENV TZ=Asia/Jakarta
RUN cp /usr/share/zoneinfo/$TZ /etc/localtime && echo "$TZ" > /etc/timezone
RUN date

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

RUN docker-php-ext-enable mysqli

# Konfigurasi dan install GD (image processing)
RUN docker-php-ext-configure gd \
    --with-jpeg=/usr/include/ \
    --with-freetype=/usr/include/ && \
    docker-php-ext-install gd

# Konfigurasi Nginx
COPY deploy/nginx/ /etc/nginx/
RUN nginx -t

# Buat direktori untuk PID file Nginx
RUN mkdir -p /run/nginx



# Copy source project
COPY . /var/www/


# Salin hasil build Vite
# COPY --from=vite-build /app/assets/editor /var/www/assets/editor


# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install

# Debug log (opsional, bisa dihapus)
RUN ls && cat ./application/config/database.php

# Bersihkan file tidak perlu
RUN rm -rf /var/www/deploy .gitlab-ci.yml Dockerfile

# Set permission untuk log dan runtime Nginx
RUN mkdir -p /var/log/nginx \
    && chown -R www-data:www-data /var/log/nginx \
    && chmod -R 755 /var/log/nginx

# Lock permission source code agar tidak bisa dihapus oleh web user
RUN chown -R root:root /var/www
RUN chown -R www-data:www-data /var/lib/nginx
RUN chown www-data:www-data /var/run/nginx.pid || true

# Expose port HTTP & HTTPS
EXPOSE 8080

# Jalankan PHP-FPM & Nginx
CMD ["sh", "-c", "rm -rf /var/www/deploy && php-fpm -D && nginx -g 'daemon off;'"]

RUN ls
# Gunakan user non-root
USER www-data
