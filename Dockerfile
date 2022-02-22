FROM php:7.4-fpm-alpine3.12

RUN apk update && \
    apk add --no-cache wget nginx tzdata

COPY . /var/www/html/.

WORKDIR /var/www/html
RUN chmod +x /var/www/html/entrypoint.sh && \
    wget https://getcomposer.org/download/2.2.6/composer.phar && \
    php composer.phar install && \
    docker-php-ext-install pdo pdo_mysql && \
    rm /etc/nginx/conf.d/default.conf && \
    mkdir /run/nginx

RUN apk del --purge wget 

ENTRYPOINT ["/var/www/html/entrypoint.sh"]
