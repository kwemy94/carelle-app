FROM php:8.1
RUN apt-get update -y && apt-get install -y openssl zip unzip git libzip-dev unzip zlib1g-dev libpng-dev
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /app
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install pdo_mysql gd zip
COPY . /app
RUN composer install
RUN php artisan key:generate
RUN php artisan route:clear
RUN php artisan view:clear
RUN php artisan config:cache

EXPOSE 9000
CMD php artisan serve --host=0.0.0.0 --port=9000