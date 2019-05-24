
composer install

echo composer install successful

chown -R kuza:www-data *
chmod -R 775 *

echo permissions successfully changed

php artisan storage:link
php artisan view:clear
php artisan cache:clear
php artisan config:clear

echo Deployment completed.
