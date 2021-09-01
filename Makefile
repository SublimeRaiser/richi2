DOCKER_COMPOSE  = docker-compose
CLI             = $(DOCKER_COMPOSE) run --rm cashflow-php-cli
SYMFONY_CONSOLE = $(CLI) ./bin/console

.PHONY: tests phpunit

##
## Project initialization ("make init" or just "make")
## ---------------------------------------------------
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

#db-init: wait-db migations fixtures

##
## Code quality tests ("make tests")
## ---------------------------------
tests: phpunit

##
## Run unit tests ("make phpunit" or "make phpunit UnitTest.php"), PHPUnit options are not supported!
## --------------------------------------------------------------------------------------------------
# If the first argument is "phpunit"...
ifeq (phpunit,$(firstword $(MAKECMDGOALS)))
    # use the rest as arguments for "phpunit"
    PHPUNIT_ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
    # ...and turn them into do-nothing targets
    $(eval $(PHPUNIT_ARGS):;@:)
endif

phpunit:
	$(CLI) ./bin/phpunit $(PHPUNIT_ARGS)
