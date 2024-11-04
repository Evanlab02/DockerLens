.PHONY: build
build:
	docker compose build

.PHONY: debug
debug: build
	docker compose up

.PHONY: dev
dev: build
	docker compose watch

.PHONY: down
down:
	docker compose down

.PHONY: format
format:
	./vendor/bin/php-cs-fixer fix src
	./vendor/bin/php-cs-fixer fix public

.PHONY: lint
lint:
	./vendor/bin/php-cs-fixer check src
	./vendor/bin/php-cs-fixer check public