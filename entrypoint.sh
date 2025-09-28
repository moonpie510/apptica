#!/bin/bash

set -e

echo "Разворачиваем проект"

docker compose exec php-fpm bash -c "
  cp .env.example .env &&
  composer install &&
  php artisan storage:link &&
  chmod 777 -R ./storage &&
  chmod 777 -R ./bootstrap/cache &&
  php artisan migrate --seed &&
  php artisan apptica:upload-data &&
  php artisan test:create-schema
"
