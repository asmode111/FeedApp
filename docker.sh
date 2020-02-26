#!/usr/bin/env bash

function start() {
    docker-compose up -d
}

function stop() {
    docker-compose stop
}

function php() {
    docker exec -it beadgame_php /bin/bash
}

function server() {
    docker exec -it beadgame_nginx /bin/bash
}

function db() {
    docker exec -it beadgame_db /bin/bash
}

"$@"