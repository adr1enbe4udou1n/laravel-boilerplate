PHONY: start
start:
	docker-compose -f docker-compose.yml up

PHONY: start.prod
start.prod:
	docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d

PHONY: build
build:
	docker-compose build

PHONY: install.prod
install.prod:
	docker exec -it boilerplate-php-fpm php /app/artisan key:generate
	docker exec -it boilerplate-php-fpm php /app/artisan storage:link
	docker exec -it boilerplate-php-fpm php /app/artisan migrate

PHONY: install
install:
	docker exec -it boilerplate-php-fpm php /app/artisan key:generate
	docker exec -it boilerplate-php-fpm php /app/artisan storage:link
	docker exec -it boilerplate-php-fpm php /app/artisan migrate --seed

PHONY: delete
delete:
	docker-compose down

PHONY: stop
stop:
	docker-compose stop
