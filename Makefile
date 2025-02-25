ROOT_DIR:=$(shell dirname $(realpath $(lastword $(MAKEFILE_LIST))))

DOCKER_COMPOSE?=docker-compose

-include $(ROOT_DIR)/local.mk

GLOBAL_ENVS?=
ifdef APP_ENV
	GLOBAL_ENVS+= -e APP_ENV=$(APP_ENV)
endif

ifneq (,$(shell (type $(DOCKER_COMPOSE) 2>&1 >/dev/null && echo 1) || true))
	PHP=$(DOCKER_COMPOSE) run --rm --no-deps $(GLOBAL_ENVS) php
else
	PHP=php
endif

PHP_CONSOLE_DEPS=vendor .env

.PHONY: start
start: up $(PHP_CONSOLE_DEPS)

stop: docker-compose.yml ## остановить сервис
	@$(DOCKER_COMPOSE) stop

up: docker-compose.yml ## запустить сервис
	@$(DOCKER_COMPOSE) up -d --build --remove-orphans --quiet-pull

vendor: composer.json composer.lock
	@$(PHP) composer install -o -n --no-ansi
	@touch vendor || true

db-create: $(PHP_CONSOLE_DEPS)
	@$(PHP) bin/console doctrine:database:create --if-not-exists

db-migrate: $(PHP_CONSOLE_DEPS)
	@$(PHP) bin/console doctrine:migrations:migrate -n

FIXER_CMD=vendor/bin/php-cs-fixer fix

fixer: $(PHP_CONSOLE_DEPS)
	@$(PHP) $(FIXER_CMD) --verbose