#!/usr/bin/env bash

function start() {
    docker-compose up -d
}

function stop() {
    docker-compose stop
}

"$@"