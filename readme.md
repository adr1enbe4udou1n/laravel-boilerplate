# Laravel Boilerplate

This is a lite boilerplate site with backend based on Laravel 5.3.

## Features

* Bootstrap Frontend with basic home-about-contact pages
* Backend with AdminLTE Theme and Datatables
* Basic User Management

## Install

1. Fork and clone this repository
2. Set Database and environment variables from **.env.example**
* APP_ENV=[local|production]
* APP_URL=[Site URL]
3. Set Web write permission to `bootstrap` and `storage` folders.
4. Launch this commands :

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

## User creation commands

```shell
php artisan user:create[:admin] {name} {email} {password}
```

Generate Super-admin and supervisor access :

```shell
php artisan user:create:admin "Admin" admin@example.com 123456
php artisan user:create "John Doe" john.doe@example.com 123456
```

## Development Usage

### Autoloading assets with Browsersync

1. If not yet done, get Yarn and Gulp globally with `npm -g i yarn gulp-cli`
2. Set BROWSERSYNC_* environment variables with valid proxy, host and port
3. Launch this commands :

```shell
yarn
gulp watch
```

This should automatically start your default browser with browsersync activated for autoloading.

Note : If assets modified, launch `gulp --production` before push for each production deploy.

## Settings

### MetaTags

*title* et *description* metas settings can be set on `resources/lang/{locale}/metas.php` file for each routes.
