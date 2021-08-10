#! /bin/sh
cd /var/www/rest

if [[ -z "$BIND_IP" ]]; then
    echo "No bind IP specified. Falling back to default"
    BIND_IP="0.0.0.0"
else
    :
fi

if [[ -z "$BIND_PORT" ]]; then
    echo "No bind PORT specified. Falling back to default"
    BIND_PORT="8081"
else
    :
fi

echo "Starting rest server"
php -S $BIND_IP:$BIND_PORT ./public/index.php
