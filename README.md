# Laravel Test Blog

## Installation

Development environment requirements:
- [Docker](https://www.docker.com) >= 17.09 CE
- [Docker Compose](https://docs.docker.com/compose/install/)

Setting up your development environment on your local machine :
```
$ git clone https://github.com/olegmig/laravel-test-blog-task.git
$ cd laravel-test-blog-task
$ cp .env.example .env
$ docker-compose run --rm --no-deps app composer install
$ docker-compose run --rm --no-deps app php artisan key:generate
$ docker-compose run --rm --no-deps app php artisan storage:link
$ docker run --rm -it -v $(pwd):/app -w /app node npm install
$ docker-compose up -d
```

Now you can access the application via [http://localhost:8080](http://localhost:8080).

## Before starting
You need to run the migrations with the seeds :
```
$ docker-compose run --rm app php artisan migrate --seed
```

And then, compile the assets :
```
$ docker run --rm -it -v $(pwd):/app -w /app node npm run dev
```

## Useful commands
Seeding the database :
```
$ docker-compose run --rm app php artisan db:seed
```

Running tests :
```
$ docker-compose run --rm app ./vendor/bin/phpunit --cache-result --order-by=defects --stop-on-defect
```

In development environnement, rebuild the database :
```
$ docker-compose run --rm app php artisan migrate:fresh --seed
```

## Troubleshooting
If you get this error:

``
Node Sass could not find a binding for your current environment:
``


run this command:
```
$ docker run --rm -it -v $(pwd):/app -w /app node npm rebuild node-sass
```
