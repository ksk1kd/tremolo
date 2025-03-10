FROM php:8.1-fpm-buster
EXPOSE 5173
WORKDIR /var/www/html
COPY ./.docker/app/php.ini /usr/local/etc/php/php.ini
COPY package.json package-lock.json ./
RUN apt-get update && apt-get -y install git zip unzip vim
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && apt-get install -y nodejs
RUN npm install
RUN docker-php-ext-install pdo_mysql
RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data
CMD npm run build && composer install && php artisan key:generate && php-fpm
