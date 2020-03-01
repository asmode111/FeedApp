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

"$@"