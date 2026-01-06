# ===============================
# Base Image
# ===============================
FROM php:7.3-fpm-alpine

LABEL maintainer="Rio Bayu Sentosa <riobayusentosa@sumbarprov.go.id>" \
      description="Dockerfile CodeIgniter 3 - PHP 7.3 FPM + Nginx (Alpine)" \
      version="1.3"

WORKDIR /var/www/

# ===============================
# Install system dependencies
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

# ===============================
# Timezone
# ===============================
ENV TZ=Asia/Jakarta
RUN cp /usr/share/zoneinfo/$TZ /etc/localtime && echo "$TZ" > /etc/timezone

# ===============================
# PHP configuration
# ===============================
COPY deploy/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY deploy/php/php.ini /usr/local/etc/php/php.ini
COPY deploy/php/php-fpm.conf /usr/local/etc/php-fpm.conf
COPY deploy/php/php-fpm.d/www.conf /usr/local/etc/php-fpm.d/www.conf

# ===============================
# SSL Certificates
# ===============================
COPY deploy/cert/ /etc/comodossl/
RUN cp /etc/comodossl/*.crt /usr/local/share/ca-certificates/ \
    && update-ca-certificates

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

# ===============================
# Nginx
# ===============================
COPY deploy/nginx/ /etc/nginx/
RUN mkdir -p /run/nginx && nginx -t

# ===============================
# Copy application source
# ===============================
COPY . /var/www/

# ===============================
# Composer
# ===============================
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# ===============================
# Cleanup
# ===============================
RUN rm -rf /var/www/deploy \
           .git \
           .gitlab-ci.yml \
           Dockerfile

# ===============================
# Permissions
# ===============================
RUN mkdir -p /var/log/nginx \
    && chown -R www-data:www-data /var/log/nginx /var/lib/nginx /run/nginx \
    && chown -R root:root /var/www

# ===============================
# Expose port
# ===============================
EXPOSE 5001

# ===============================
# Start services
# ===============================
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]

USER www-data
