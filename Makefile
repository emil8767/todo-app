up:
	head -1 .env || cp .env.example .env || echo "File .env exists, it's ok"
	./vendor/bin/sail up -d
	docker-compose exec php composer install
	docker-compose exec php php artisan key:generate --ansi
	docker-compose exec php php artisan migrate
	echo "Service is ready"
lint:
	composer exec --verbose phpcs -- --standard=PSR12 app routes tests --ignore=app/Models
