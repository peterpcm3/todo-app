#Todo application based on Laravel 7

Todo app is using base authentication mechanism of Laravel for user login.
User can register and login with their credentials. Then will be able to manage todo list content.

Application is dockerized. To run application execute following commands:

- docker-compose up -d
- docker-compose exec composer install
- docker-compose exec app php artisan key:generate
- docker-compose exec app php artisan migrate:fresh
- docker-compose exec app npm install
- docker-compose exec app npm run de
