#!/bin/bash

export UID=$(id -u)
export GID=$(id -g)

docker compose run --rm infection
