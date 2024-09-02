#!make
include .env

sail-init:
	docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v .:/var/www/html \
        -w /var/www/html \
        --env COMPOSER_AUTH="{\"gitlab-domains\":[\"inetstudio.gitlab.yandexcloud.net\"],\"gitlab-token\":{\"inetstudio.gitlab.yandexcloud.net\":\"${COMPOSER_REPO_TOKEN}\"}}"\
        laravelsail/php83-composer:latest \
        composer install --ignore-platform-reqs

up:
	./vendor/bin/sail up -d

up-build:
	./vendor/bin/sail up -d --build

down:
	./vendor/bin/sail down --remove-orphans

ps:
	docker-compose ps

bash:
	./vendor/bin/sail bash

seed:
	./vendor/bin/sail artisan db:seed

migrate:
	./vendor/bin/sail artisan migrate

migrate-refresh:
	./vendor/bin/sail artisan migrate:refresh

composer-install:
	./vendor/bin/sail composer install

composer-update:
	./vendor/bin/sail composer update

local-update: composer-install migrate

refresh: migrate-refresh seed

pint-diff:
	./vendor/bin/pint --test

pint-fix:
	./vendor/bin/pint

test:
	./vendor/bin/sail composer test

tinker:
	./vendor/bin/sail tinker

doc-model:
	./vendor/bin/sail artisan ide-helper:models -W
