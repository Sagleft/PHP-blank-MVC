
![screenshot](https://github.com/Sagleft/PHP-blank-MVC/raw/master/controller/public_html/img/screenshot.png)

## Features

* separation of layout and code through twig-templates;
* similarity of MVC structure;
* .ENV via dotenv;
* meta tags for previews in social networks;
* something else;

## Requirements
* PHP 7.1;
* Apache 2.6;

# Project logic

1. Libraries are connected through composer;
2. an instance of Handler is created;
3. Handler creates instances of Environment, Logic and User;
4. Environment loads data from .env;
5. Handler renders the page through Render;
6. Render processes the requested template and displays the page through Twig.

## Installation

An example for a project called project:

run

```bash
sh install.sh
```

or manual:

```bash
mkdir view/cache
chmod 777 view/cache
cp example.env .env
composer update
cd public_html
cp example.htaccess .htaccess
```

Next, make changes to .env

Apache public_html directory: ``` controller\public_html ```.

You can find an example of apache virtual host in the file ```apache.conf```

it must be placed along the path:

* RH-based systems: ```/etc/httpd/conf.d/```
* Debian based: ```/etc/apache2/sites-enabled/```

## TODO

1. Complete the installation script, make automatic configuration of the apache virtual host;
2. make docker;
3. remove github-btn;
4. rebuild the interface;
5. add more showreel-gizmos;
6. add asynchrony;
7. turn the project into a composer package.

## Copyright

Copyright (c) 2021 Sagleft.
