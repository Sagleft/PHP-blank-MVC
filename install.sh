mkdir view/cache
chmod 777 view/cache
cp example.env .env
cp composer.example.json composer.json
composer update
mkdir logs
cd logs
touch access.log error.log
cd ../controller/public_html
cp example.htaccess .htaccess
