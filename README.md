<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About this 

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Install instructions

Clone this repo with 

```bash
git clone https://github.com/g4b0/docker-laravel.git
```

Give write permissions to storage folder, in order to permit php-fpm to write log, cache etc.

```bash
chmod -R g+w storage/
```

Copy .env.example to .env

```bash
cp .env.example .env
```

I works out of the box, but feel free to modify it. Environment variable WWWGID must be valorized with the gid of the host user running docker on the host machine. It defaults to 1000, since normally on a dev linux box this is the default. 

The user that will run nginx and php-fpm (www-data) will have this gid, so it will be able to read the files in the mounted volume /var/www/html, and write just into /var/www/html/storage

Build the containers and run them

```bash
docker-compose up
```

Install dependecies with composer

```bash
docker exec <CONTAINER-NAME> composer install
```

Navigate to http://localhost:8080, or whatever port is mapped in APP_PORT environment variable configured in your .env file

## Build & run

* docker-compose build --no-cache
* docker-compose up
* docker exec -it ticket-laravel.test-1 /bin/bash
* cd /var/www/html
* composer install