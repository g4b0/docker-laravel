FROM alpine:3.15

ARG WWWUID=1000
ARG WWWGID=1000

WORKDIR /var/www/html/

# Essentials
# nginx creates www-data group, but not the www-data user
RUN echo "Europe/Rome" > /etc/timezone
RUN apk add --no-cache zip unzip curl sqlite nginx supervisor shadow && \
    groupmod -g $WWWGID www-data && \
    adduser -S -D -u $WWWUID -s /sbin/nologin -h /var/www -G www-data www-data

# Installing bash
RUN apk add bash
RUN sed -i 's/bin\/ash/bin\/bash/g' /etc/passwd

# Installing PHP
RUN apk add --no-cache php8 \
    php8-common \
    php8-fpm \
    php8-pdo \
    php8-opcache \
    php8-zip \
    php8-phar \
    php8-iconv \
    php8-cli \
    php8-curl \
    php8-openssl \
    php8-mbstring \
    php8-tokenizer \
    php8-fileinfo \
    php8-json \
    php8-xml \
    php8-xmlwriter \
    php8-simplexml \
    php8-dom \
    php8-pdo_mysql \
    php8-pdo_sqlite \
    php8-tokenizer \
    php8-pecl-redis

RUN ln -s /usr/bin/php8 /usr/bin/php

# Installing composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm -rf composer-setup.php

# Configure supervisor
COPY supervisor/supervisord.conf /etc/supervisord.conf
RUN mkdir -p /run/supervisor/

# Configure PHP
RUN mkdir -p /run/php/
RUN touch /run/php/php8.0-fpm.pid

COPY php/php-fpm.conf /etc/php8/php-fpm.conf
COPY php/www.conf /etc/php8/php-fpm.d/www.conf
COPY php/php.ini-production /etc/php8/php.ini

# Configure nginx
COPY nginx/nginx.conf /etc/nginx/
COPY nginx/nginx-laravel.conf /etc/nginx/modules/

RUN mkdir -p /run/nginx/
RUN touch /run/nginx/nginx.pid

RUN ln -sf /dev/stdout /var/log/nginx/access.log
RUN ln -sf /dev/stderr /var/log/nginx/error.log

# Grant write access to /dev/pts/0  (/dev/stdin && /dev/stdout && /dev/stderr)
RUN addgroup www-data tty

# Set permissions for non priviliged user
RUN chown -R www-data:www-data /var/log/nginx && \
    chown -R www-data:www-data /var/log/php8 && \
    chown -R www-data:www-data /run/nginx && \
    chown -R www-data:www-data /run/php && \
    chown -R www-data:www-data /run/supervisor && \
    chown -R www-data:www-data /var/lib/nginx && \
    chown -R www-data:www-data /var/lib/php8

EXPOSE 80
CMD ["supervisord", "-c", "/etc/supervisord.conf"]