# installation

$ composer install

in the project directory, create a folder 'package'
$ mkdir package

update project/composer.json

...
"repositories": {
"authentication": {
"type": "path",
"url": "package/authentication",
"options": {
"symlink": true
}
}
}
...
"require": {
...
"normanize/authentication": "@dev"
}

update project/config/auth.php

...
'guards' => [
....
'api' => [
'driver' => 'passport',
'provider' => 'users',
],
],
...

and run this commands
$ composer update
$ php artisan migrate
$ php artisan passport:install
