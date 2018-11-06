# Laravel Vue Tabler Boilerplate

> This is a Bootstrap 4 starter kit site with lite blogging feature, user account registration/management and full Vue Tabler Backend based on Laravel 5.7. 

[![Build Status](https://drone.okami101.io/api/badges/adr1enbe4udou1n/laravel-boilerplate/status.svg)](https://drone.okami101.io/adr1enbe4udou1n/laravel-boilerplate)
[![StyleCI](https://styleci.io/repos/75558440/shield?style=flat&branch=master)](https://styleci.io/repos/75558440)
[![License](https://poser.pugx.org/adr1enbe4udou1n/laravel-boilerplate/license?format=flat)](https://packagist.org/packages/adr1enbe4udou1n/laravel-boilerplate)
[![code style: prettier](https://img.shields.io/badge/code_style-prettier-ff69b4.svg)](https://github.com/prettier/prettier)

## Demo

<p align="center">
<img src="https://user-images.githubusercontent.com/3679080/38768514-73a75d04-3ff5-11e8-8281-e366f58c0165.gif">
</p>

* Frontend demo : [https://laravel-boilerplate.okami101.io](https://laravel-boilerplate.okami101.io)
* Backend demo : [https://laravel-boilerplate.okami101.io/admincp](https://laravel-boilerplate.okami101.io/admincp) (demo@example.com/demo, read-only)

## Features

### Frontend

* Bootstrap 4 Frontend with basic home-about-contact and legal mentions pages,
* [Slick carousel](http://kenwheeler.github.io/slick/) and [Cookie Consent](https://cookieconsent.insites.com/) integrated,
* Blog section, including navigation by tags & authors,
* [Intervention image](https://github.com/Intervention/image) for dynamic optimized images with cache plugin,
* [Turbolinks](https://github.com/turbolinks/turbolinks) included for fast navigation,
* Login throttle by recaptcha & [password strength meter](https://github.com/ablanco/jquery.pwstrength.bootstrap),
* Frontend user space and profile management. Email validation included. Registration can be disabled by environment parameter,
* [Laravel Socialite](https://github.com/laravel/socialite) included with all supported socialite providers (facebook/twitter/linkedin/github/bitbucket).

### Backend

#### Underlying layer

* Based on Bootstrap 4 [Tabler](https://tabler.github.io/tabler/) theme with many useful plugins ([SweetAlert2](https://limonte.github.io/sweetalert2/), [Flatpickr](https://chmln.github.io/flatpickr/), [CKEditor 5](https://ckeditor.com/), etc.),
* Entirely written with Vue components thanks to [Bootstrap-Vue](https://bootstrap-vue.js.org/), absolutely no jQuery dependency,
* Vue-route for instant client-side navigation,
* Native Vue Datatable, with everywhere search input and batch actions features,
* All main CRUD actions are ajaxified,
* Native [vue-select](https://github.com/sagalbot/vue-select) component for powerful select system (autocomplete, tags, etc.),
* Excel Export (thanks to [Maatwebsite](https://github.com/Maatwebsite/Laravel-Excel)) & Batch actions integrated within DataTables,
* Instant search engine (for posts) thanks to [Laravel Scout](https://github.com/laravel/scout) & [TNTSearch](https://github.com/teamtnt/tntsearch).

#### Features included

* User and permissions management (classic users <-> roles <-> permissions structure),
* Impersonation feature for quick user context testing,
* Frontend forms module, including settings (recipients and translatable message confirmation) & submissions management,
* Posts management for frontend blog, with granular publication permissions (classic draft-pending-published workflow). Posts include title, summary, html body, tags, featured image, metas. They can be published and/or unpublished at specific datetime and pinned if needed. Specific user can have limited access to his own posts only, according to his permissions,
* Wysiwyg drag & drop image upload.

### Localization & SEO

* Multilingual ready thanks to [Laravel Localization](https://github.com/mcamara/laravel-localization) package. Each routes are prefixed by locale in URL for best SEO support. For this boilerplate, EN, FR locales are 100% supported, including translated routes,
* Spanish language added thanks to [Codedeep](https://github.com/codedeep),
* Arabic language with RTL support added thanks to [AhmadOf](https://github.com/AhmadOf),
* Russian language added thanks to [Limych](https://github.com/Limych),
* Model Translatable Fields support (JSON format) with [Spatie Laravel Translatable](https://github.com/spatie/laravel-translatable), used for metatags and posts,
* Robots and Sitemap integrated, including multilingual alternates,
* Full Metatags manager interface with translatable title & description. Meta entity can be either linked to route or specific entity like post,
* 301/302 redirections manager interface, with CSV import feature.

### Developer Specific

* Usage of [Spatie Laravel Medialibrary](https://github.com/spatie/laravel-medialibrary) package for orderable media model management, used for featured image on posts,
* Permissions configuration based on config file rather than database,
* Form types defined on config file for settings & submission support. This boilerplate include just one "contact form" type,
* Custom webpack integration rather than laravel mix, for better flexibility (cf bellow),

## Install

### Requirements

* PHP 7.1
* MySQL 5.7 with JSON support or PostgreSQL

> For Mariadb you can use this [laravel-mariadb package](https://packagist.org/packages/ybr-nx/laravel-mariadb).

[![Deploy](https://www.herokucdn.com/deploy/button.png)](https://heroku.com/deploy)

1. `composer create-project --prefer-dist --stability=dev adr1enbe4udou1n/laravel-boilerplate my-new-project`
2. Set database and environment variables from **.env.example**
3. Set Web write permission if needed to `bootstrap/cache` and `storage` folders.
4. Launch follow commands :

### For Local/Development

```shell
composer install
php artisan key:generate
php artisan storage:link
php artisan migrate [--seed]
```

### For Production

```shell
# Running this on development environment will throw error so run below command only on production
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan storage:link
php artisan migrate --force
```

### Initialize search index for posts

```shell
php artisan scout:import "App\Models\Post"
```

Laravel Scout takes care of updating posts index on Create, Update and Delete (CUD) operations.

### Install with docker-compose
After installation the site will be available on `127.0.0.1:8080`

## Mac and Linux dev environment
First of all you need to build the containers
```bash
docker-compose build
```

After that you have to start the containers
```bash
docker-compose up
```

Set up your application
```bash
docker exec -it boilerplate-php-fpm php /app/artisan key:generate \
	&& docker exec -it boilerplate-php-fpm php /app/artisan storage:link
```

Rename `.env.docker` to `.env` and apply the migrations
```bash
docker exec -it boilerplate-php-fpm php /app/artisan migrate
```

Or apply the migrations with demo data
```bash
docker exec -it boilerplate-php-fpm php /app/artisan migrate --seed
``` 

## Mac and Linux production environment
```bash
docker-compose build
```

After that you have to start the containers
```bash
docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d
```

Set up your application
```bash
docker exec -it boilerplate-php-fpm php /app/artisan key:generate \
	&& docker exec -it boilerplate-php-fpm php /app/artisan storage:link
```

Rename `.env.docker` to `.env` and apply the migrations
```bash
docker exec -it boilerplate-php-fpm php /app/artisan migrate
```

## Install with make file
### Deploy dev

Run
```bash
make build
make start.dev
```

After first start rename `.env.docker` to `.env` and apply the migrations by the following command
```bash
make install.dev
```

### Deploy prod
Run
```bash
make build
make start.prod
```

After first start rename `.env.docker` to `.env` and apply the migrations by the following command
```bash
make install.prod
```

## Install on Windows
First of all set up your docker environment
- On Command Line: `set COMPOSE_CONVERT_WINDOWS_PATHS=1`;
- Restart Docker for Windows;
- Go to `Docker for Windows settings > Shared Drives > Reset credentials > select drive > Apply;`
- Reopen Command Line
- Kill the Containers (if you have started any)
- Rerun the Containers (if you have run any)
- Login the docker from cli, because docker login gui is separated from docker login cli.
 Also note, that you do not have to use your email, you need to enter docker id

```
Note, if the prompt from the needed drive disapears after restarting the container
You may have to reset your docker:
Go to Docker for Windows settings > Reset > Reset to factory defaults...
```

Than you can proceed with `Mac and Linux` install instructions section

### Backend access

The first user to register will be automatically super admin with no restriction and will cannot be deletable.
Both frontend and backend have dedicated login pages.

## Development notes

### Compiling assets with Webpack

1. Install dependencies with `yarn`
2. Launch `yarn dev` for compiling assets and start dev-server with HMR enabled (preferred way for fast admin building)

> N1 : Use DEV_SERVER_PORT variable to configure local port of Webpack Dev Server,  
> N2 : Use DEV_SERVER_URL to configure HTTP access to Webpack Dev Server from your host, especially useful if you work on homestead/docker),  
> N3 : Use `yarn watch` if you prefer old school watcher,  
> N4 : If assets modified, don't forget to launch `yarn prod` before deploy on production environment.

### Permissions definitions

Unlike other known project as [ENTRUST](https://github.com/Zizaco/entrust) or [laravel-permission](https://github.com/spatie/laravel-permission), which are very well suited for generic roles/permissions, i preferred a more lite and integrated custom solution.

The mainly difference is that instead of store all permissions into specific SQL table, there are directly defined in a specific config file permissions. SQL side, roles entities relies only to a list of permissions key names.

Indeed i feel this approach better for maintainability simply because permissions are hardly tied to the application with Laravel Authorization. This is anyway the standard way in CMS as Drupal where each module have specific config permission file. Permissions should be only owned by developers.

### Note on Laravel Mix

You will observe that this boilerplate does not use [Laravel Mix](https://github.com/JeffreyWay/laravel-mix) which is shipped in Laravel for all assets management.

Laravel Mix still stay awesome for newcomers thanks to Jeffrey Way's laravel-like webpack fluent API, but, even if Laravel Mix can be easily overridden, for this project i preferred use my custom framework-free webpack setup in order to have total control of assets workflow.

For instance, with this custom setup HMR work natively with configurable port (essential for easy vue admin development) and productions assets are bundled into specific "dist" directory.

### Code styling

PHP-CS-Fixer & ESLint are used for strong style guidelines for both server and client side code.

PHP is pre-configured for official Laravel styling, just launch `./vendor/bin/php-cs-fixer fix` for global project auto-formatting.

JS use [Prettier Standard Style](https://github.com/prettier/prettier/) & eslint-loader is used within webpack for dynamic code styling recommendations.  
Moreover, [Official ESLint plugin for Vue.js](https://github.com/vuejs/eslint-plugin-vue) is included for heavy consistent code through all components vue files.

## TODO

* [ ] Inclusion of unit/featured/browser tests (stand by for now)

## License

This project is open-sourced software licensed under the [MIT license](https://adr1enbe4udou1n.mit-license.org).
