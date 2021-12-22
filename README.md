## About this 

This is a simple demo of Laravel running into a containerized environment, with three container:

* niginx-php: a container running both nginx and php-fpm, managed with Supervisor, on top of linux alpine
* mysql: a container build from mysql/mysql-server:8.0 image
* redis: a container build from redis:alpine image

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
That's all, just point your browser to http://localhost:8080, or whatever port is mapped in APP_PORT environment variable configured in your .env file


## Branch dev

Configurable user uid

/bin/bash as shell for www-data user