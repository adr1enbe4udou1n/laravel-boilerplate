# Laravel Boilerplate
> This is a lite boilerplate site with backend based on Laravel 5.4.

[![Latest Stable Version](https://poser.pugx.org/adr1enbe4udou1n/laravel-boilerplate/v/stable)](https://packagist.org/packages/adr1enbe4udou1n/laravel-boilerplate)
[![License](https://poser.pugx.org/adr1enbe4udou1n/laravel-boilerplate/license)](https://packagist.org/packages/adr1enbe4udou1n/laravel-boilerplate)
[![Total Downloads](https://poser.pugx.org/adr1enbe4udou1n/laravel-boilerplate/downloads)](https://packagist.org/packages/adr1enbe4udou1n/laravel-boilerplate)

This boilerplate is heavily inspired by the most popular laravel boilerplate [here](https://github.com/rappasoft/laravel-5-boilerplate). Main difference is this one is just a bit more lite, no history logging, no advanced permissions/roles management but just one simple role by user because sufficient for most apps.

![showcase](https://cloud.githubusercontent.com/assets/3679080/21204210/8443454c-c256-11e6-9d53-b95a6b19aae4.gif)

## Features

* Bootstrap Frontend with basic home-about-contact pages
* Backend with AdminLTE theme, datatables, sweet alerts, etc.
* Basic User Management with just one role
* Login-as feature for quick specific user context testing

If you need full permissions feature, use one of this packages :
* [ENTRUST](https://github.com/Zizaco/entrust)
* [laravel-permission](https://github.com/spatie/laravel-permission), this one have maximum granularity (users can be directly associate to permissions)

## Install

[![Deploy](https://www.herokucdn.com/deploy/button.png)](https://heroku.com/deploy)

1. Launch command `composer create-project adr1enbe4udou1n/laravel-boilerplate my-project`
2. Set database and environment variables from **.env.example**
    * APP_ENV=[local|production]
    * APP_URL=[Site URL]
3. Set Web write permission if needed to `bootstrap/cache` and `storage` folders.
4. Launch follow commands :

### For Production :

```shell
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan storage:link
php artisan migrate --seed --force
```

### For Local/Development :

```shell
composer install
php artisan key:generate
php artisan storage:link
php artisan migrate --seed
```

### User creation commands and backend access

```shell
php artisan user:create[:admin] {name} {email} {password}
```

Generate Super-admin and supervisor access :

```shell
php artisan user:create:admin "Admin" admin@example.com 123456
php artisan user:create "John Doe" john.doe@example.com 123456
```

Backend is accessible under `/admin` url.

## Development Usage

### Compiling assets with Webpack

1. If not yet done, get Yarn globally with `npm -g i yarn` and launch `yarn`
2. Launch `npm run dev` or `npm run watch` for compiling assets with webpack

Note : If assets modified, don't forget to launch `npm run production` before deploy for each production environment.

## Settings

### MetaTags

*title* et *description* metas settings can be set on `resources/lang/{locale}/metas.php` file for each routes.

## License

This project is open-sourced software licensed under the [MIT license](https://adr1enbe4udou1n.mit-license.org).
