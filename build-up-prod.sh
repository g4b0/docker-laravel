#!/bin/sh
docker-compose -f docker-compose-prod.yml build
docker-compose -f docker-compose-prod.yml up