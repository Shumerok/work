
DOCKER_COMPOSE = docker-compose
DOCKER_EXEC = docker exec -it work_php

build:
	${DOCKER_COMPOSE} build

up:
	${DOCKER_COMPOSE} up -d

down:
	${DOCKER_COMPOSE} down

migrate:
	${DOCKER_EXEC} php artisan migrate

storage:
	${DOCKER_EXEC} php artisan storage:link

seed:
	${DOCKER_EXEC} php artisan db:seed

fresh:
	${DOCKER_EXEC} php artisan m:fr --seed

composer:
	${DOCKER_EXEC} composer install

restart:
	make down up

init:
	make build up composer migrate seed storage print

print:
	@echo Welcome: http://localhost:7000