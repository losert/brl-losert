run:
	docker compose up -d

stop:
	docker compose down

bash:
	docker compose exec web bash

npm-install:
	docker compose exec web npm i

npm-prod:
	docker compose exec web npm run-script build

npm-dev:
	docker compose exec web npm run-script dev

c-install:
	docker compose exec web composer install

c-dump:
	docker compose exec web composer dump-autoload

cache-clear:
	docker compose exec web php bin/console cache:clear

cc:
	make cc
