FROM php:fpm-alpine

# Копирование PHP-конфигов
COPY ./conf/php.ini /usr/local/etc/php/php.ini

# Установка системных пакетов
RUN apk add --no-cache curl git build-base zlib-dev oniguruma-dev autoconf icu-dev bash linux-headers

# PostgreSQL
RUN apk add --no-cache libpq-dev \
    && docker-php-ext-install pdo_pgsql

# Intl
RUN docker-php-ext-configure intl \
    && docker-php-ext-install intl

# XDebug (опционально)
ARG INSTALL_XDEBUG=true
RUN if [ "$INSTALL_XDEBUG" = "true" ]; then \
    pecl install xdebug && docker-php-ext-enable xdebug; \
fi

# Копирование Xdebug-конфига
COPY ./conf/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Настройка пользователя
ARG PUID=1000
ARG PGID=1000
RUN apk --no-cache add shadow && \
    groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Копирование файлов проекта
COPY ./ /var/www

# Установка прав
RUN chown -R www-data:www-data /var/www
RUN chmod -R 777 /var/www

# Установка зависимостей и сборка фронтенда
USER www-data
WORKDIR /var/www

# Запуск PHP-FPM
CMD ["php-fpm"]
EXPOSE 9000