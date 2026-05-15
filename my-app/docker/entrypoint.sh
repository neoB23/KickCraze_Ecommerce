#!/bin/bash
set -e

: "${PORT:=80}"
sed -ri "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

php artisan config:cache
php artisan route:cache
php artisan migrate --force
# php artisan db:seed --force   # uncomment for FIRST DEPLOY ONLY, then re-comment and redeploy

exec apache2-foreground
