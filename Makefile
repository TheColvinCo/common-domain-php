UID=$(shell id -u)
GID=$(shell id -g)
CONTAINER=php

start: erase cache-folders build composer-install bash

erase:
	docker-compose down -v

build:
	docker-compose build && \
	docker-compose pull

cache-folders:
	mkdir -p ~/.composer && chown ${UID}:${GID} ~/.composer

composer-install:
	docker-compose run --rm -u ${UID}:${GID} ${CONTAINER} composer install

bash:
	docker-compose run --rm -u ${UID}:${GID} ${CONTAINER} sh

phpunit: ## execute project unit tests
	docker-compose run --rm -u ${UID}:${GID} ${CONTAINER} phpunit --no-coverage