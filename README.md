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

# Логика проекта

1. Подключаются библиотеки через composer;
2. создается экземпляр Handler;
3. Handler создает экземпляры Environment, Logic и User;
4. Environment загружает данные из .env;
5. Handler рендерит страницу через Render;
6. Render обрабатывает запрошенный шаблон и через Twig выдает страницу.

## Развертывание

Пример для проекта с именем project:

```
git clone https://github.com/Sagleft/PHP-blank-MVC.git project
cd project
mkdir view/cache
chmod 777 view/cache
cp .env.example .env
cp composer.json.example composer.json
composer update
cd controller/public_html
cp example.htaccess .htaccess
```

Далее внесите изменения в .env

rpc_* параметры - на json-rpc подключение к *coind, например, MFCoin.

Directory: ``` controller\public_html ```.


## Copyright

* Copyright (c) 2019 Sagleft.
* Skeleton Web Template Copyright (c) 2011-2014 Dave Gamache.
