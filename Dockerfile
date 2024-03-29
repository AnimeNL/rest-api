FROM php:8.1-fpm-alpine3.18

RUN apk update && \
    apk add --no-cache wget nginx tzdata

COPY . /var/www/html/.
WORKDIR /var/www/html/

RUN chmod +x /var/www/html/entrypoint.sh

RUN wget https://getcomposer.org/download/2.2.6/composer.phar && \
    php composer.phar install && \
    docker-php-ext-install pdo pdo_mysql

RUN rm /etc/nginx/http.d/default.conf

RUN apk del --purge wget 

ENTRYPOINT ["/var/www/html/entrypoint.sh"]
