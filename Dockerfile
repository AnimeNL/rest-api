FROM php:7.4-fpm-alpine3.12

RUN apk update && \
    apk add --no-cache wget nginx

COPY . /var/www/html/.

WORKDIR /var/www/html
RUN chmod +x /var/www/html/entrypoint.sh && \
    wget https://getcomposer.org/download/1.10.19/composer.phar && \
    php composer.phar install && \
    rm /etc/nginx/conf.d/default.conf && \
    mkdir /run/nginx

RUN apk del --purge wget 

ENTRYPOINT ["/var/www/html/entrypoint.sh"]
