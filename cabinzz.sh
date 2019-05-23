#!/bin/sh
git --work-tree=/usr/share/nginx/cabinzz-api/ --git-dir=/var/repo/cabinzz-git.git checkout -f

cd /usr/share/nginx/cabinzz-api/

composer install
chown -R kuza:www-data storage
chmod -R 775 storage
php artisan storage:link
php artisan view:clear
php artisan cache:clear
php artisan config:clear
