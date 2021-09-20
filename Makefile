DOCKER_COMPOSE  = docker-compose
CLI             = $(DOCKER_COMPOSE) run --rm cashflow-php-cli
SYMFONY_CONSOLE = $(CLI) ./bin/console

getargs    = $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
escapeagrs = $(subst :,\:,$(1))

.PHONY: tests phpunit dummy cli run

##
## Project provisioning ("make init" or just "make")
## -------------------------------------------------
all: init
init: docker-down-clear docker-pull docker-build docker-up composer-install #db-init
docker-up:
	$(DOCKER_COMPOSE) up -d
docker-down:
	$(DOCKER_COMPOSE) down --remove-orphans
docker-down-clear:
	$(DOCKER_COMPOSE) down -v --remove-orphans
docker-pull:
	$(DOCKER_COMPOSE) pull
docker-build:
	$(DOCKER_COMPOSE) build
composer-install:
	$(CLI) composer install
composer-update:
	$(CLI) composer update
#db-init: wait-db migations fixtures

##
## Code quality tests ("make tests")
## ---------------------------------
tests: phpunit

##
## Run unit tests ("make -- phpunit --filter testOne UnitTest.php")
## ----------------------------------------------------------------
ifeq (phpunit,$(firstword $(MAKECMDGOALS)))
    PHPUNIT_ARGS         := $(call getargs)
    PHPUNIT_ARGS_ESCAPED := $(call escapeagrs, $(PHPUNIT_ARGS))
    $(eval $(PHPUNIT_ARGS_ESCAPED):dummy;@:)
endif
phpunit:
	$(CLI) ./vendor/bin/phpunit $(PHPUNIT_ARGS)

##
## Execute CLI command ("make -- cli ls -la /app")
## -----------------------------------------------
ifeq (cli,$(firstword $(MAKECMDGOALS)))
    CLI_ARGS         := $(call getargs)
    CLI_ARGS_ESCAPED := $(call escapeagrs, $(CLI_ARGS))
    $(eval $(CLI_ARGS_ESCAPED):dummy;@:)
endif
cli:
	$(CLI) $(CLI_ARGS)
