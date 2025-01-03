FROM php:7.4-apache

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpng-dev \
    libzip-dev \
    git \
    unzip \
    && docker-php-ext-install mysqli pdo pdo_mysql intl gd zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY . .

RUN chown -R www-data:www-data /var/www/html

RUN composer install

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

RUN a2ensite 000-default.conf

RUN a2enmod rewrite

EXPOSE 80

CMD ["apache2-foreground"]
