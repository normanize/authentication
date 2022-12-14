# Description  

Laravel API Authentication  
* login  
* logout  
* basic registration  
* forgot password  
* reset password  

# Installation  

add this package inside your_project_name/package/

$ cd your_project_name/package/authentication  
$ composer install  

update your_project_name/composer.json  

```
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
```  

update your_project_name/config/auth.php  

```
...
'guards' => [
  ....
  'api' => [
    'driver' => 'passport',
    'provider' => 'users',
  ],
],
```  

and run this commands  

$ composer update  
$ php artisan migrate  
$ php artisan passport:install  
