FROM php:7.4-fpm-alpine3.12

RUN apk update && \
    apk add --no-cache wget

COPY . /var/www/rest/.

WORKDIR /var/www/rest
RUN chmod +x /var/www/rest/entrypoint.sh && \
    wget https://getcomposer.org/download/1.10.19/composer.phar && \
    php composer.phar install

RUN apk del --purge wget 

ENTRYPOINT ["/var/www/rest/entrypoint.sh"]
