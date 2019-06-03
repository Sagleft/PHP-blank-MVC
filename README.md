# Blank MVC

## Фичи

* разделение верстки и кода через twig-шаблоны;
* подобие MVC структуры;
* .ENV через dotenv;
* мета-теги для превью в соцсетях;
* что-то еще;

## Требования
* PHP 7.1;
* Apache 2.6;

## Развертывание

Пример для проекта с именем project:

```
git clone https://github.com/Sagleft/PHP-blank-MVC.git project
cd project
mkdir view/cache
cp .env.example .env
cp composer.json.example composer.json
composer update
cd controller/public_html
cp example.htaccess .htaccess
```

Directory: ``` controller\public_html ```


## Copyright

* Copyright (c) 2019 Sagleft.
* Skeleton Web Template Copyright (c) 2011-2014 Dave Gamache.
