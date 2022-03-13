## Installation

These instructions assume some prior knowledge of using Laravel, Docker and familiarity with UNIX type systems.

You will need Docker and Docker Composer to be installed to use Laravel Sail.

1. Clone repository
2. Install dependencies with Composer through Docker
```
   docker run --rm \
   -u "$(id -u):$(id -g)" \
   -v $(pwd):/var/www/html \
   -w /var/www/html \
   laravelsail/php81-composer:latest \
   composer install --ignore-platform-reqs
```
3. Copy example .env file `cp .env.example .env`
4. `./vendor/bin/sail up -d --build` to start Docker container
5. `./vendor/bin/sail php artisan key:generate` to generate APP_KEY in .env
6. `./vendor/bin/sail php artisan migrate` to run database migrations

At this point you should be able to access the site without errors. To access the site use http://localhost, but you can also add `127.0.0.1 mig.test` in `/etc/hosts/` file and then access site through http://mig.test

To run the tests: `./vendor/bin/sail phpunit`

To get rid of the Docker containers and volumes after you have checked out the task: `./vendor/bin/sail down --remove-orphans --volumes`