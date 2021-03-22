mkdir view/cache
chmod 777 view/cache
cp example.env .env
composer update
cd public_html
cp example.htaccess .htaccess
