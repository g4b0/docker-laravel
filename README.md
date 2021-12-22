## About this 

This is a simple demo of Laravel running into a containerized environment, with three container:

* niginx-php: a container running both nginx and php-fpm, managed with Supervisor, on top of linux alpine. Supervisor runs as non priviliged user
* mysql: a container build from mysql/mysql-server:8.0 image
* redis: a container build from redis:alpine image

There are two version of container: dev and prod.

## Install instructions (dev version)

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

I works out of the box, but feel free to modify it. Environment variable WWWUID and WWWGID must be valorized with the uid and gid of the user running docker on the host machine. They defaults to 1000, since normally on a dev linux box this is the default. 

The user that will run nginx and php-fpm (www-data) will have this uid and gid, so it will be able to read and write the files in the mounted volume /var/www/html, and write just into /var/www/html/storage

Build the containers and run them

```bash
docker-compose -f docker-compose-dev.yml build
docker-compose -f docker-compose-dev.yml up
```

Install dependecies with composer

```bash
docker exec <CONTAINER-NAME> composer install
```

That's all, just point your browser to http://localhost:8080, or whatever port is mapped in APP_PORT environment variable configured in your .env file


## Production version

Production image isn't ready for production, but it simulate how the code will run on the production container. To build the production container, after coloning the repo and preparing the .env, just like in the development version, run the following commands:

```bash
docker-compose -f docker-compose-prod.yml build
docker-compose -f docker-compose-prod.yml up
```

Point your browser to http://localhost:8080

### Differencies between dev and prod

Prod is a little bit more secure container, since the user www-data can write just into the /var/www/html/storage folder. It can of course read files in /var/www/html/

In dev application file are shared from the host to the container in a mounted voulme, while in prod they are copied inside the container, excluding what in .dockerignore.

In dev there are some packages missing in prod:
* php8-pecl-xdebug
* git

Dev will run a more relaxed php.ini and will report all errors, including deprecated and strict

Once you did the first build you can easly start dev and prod container with the two scripts
* up-dev.sh
* up-prod.sh

If you switch between dev and prod it is necessary to rebuild the container each time, in order to match www-data uid and gid with the ones specified in docker-compose-*.yml file. You can easly do it with the two scripts
* build-up-dev.sh
* build-up-prod.sh