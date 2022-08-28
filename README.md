# General knowledge Trivia Service

General knowledge Trivia RESTful API for playing trivia/quiz games.

## Getting started

### Start dev containers

    docker-compose up --build -d

### Environment variables

    cp .env.example .env

### Install PHP dependencies

    composer install

### Run seeders

    php artisan db:seed --class="CategorySeeder"

### Licence

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
