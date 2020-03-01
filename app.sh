#!/usr/bin/env bash

function start() {
    docker-compose up -d
}

function stop() {
    docker-compose stop
}

function php() {
    docker exec -it feedapp_php /bin/bash
}

function server() {
    docker exec -it feedapp_nginx /bin/bash
}

function db() {
    docker exec -it feedapp_db /bin/bash
}

function composer() {
    cd feed-reader
    ./composer update
}

function npm() {
    cd feed-reader
    bash -c 'npm install && npm run dev'
}

function env() {
    cd feed-reader
    echo 'APP_NAME=FeedAPP
APP_ENV=local
APP_KEY=base64:yow196wMJsJAnqb8XBmSZxjEe/g2JbcS6as5MyW0Q3k=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=feedapp_db
DB_PORT=3306
DB_DATABASE=feedapp
DB_USERNAME=root
DB_PASSWORD=root

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME={MAILTRAP_USERNAME}
MAIL_PASSWORD={MAILTRAP_PASSWORD}
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS={MAILTRAP_EMAIL}
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"' > .env
}

"$@"