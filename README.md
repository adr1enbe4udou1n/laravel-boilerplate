# Laravel Boilerplate
> This is a Bootstrap 4 starter kit site with full user account registration/management and backend based on Laravel 5.5, inspired by the popular [Laravel 5 Boilerplate](https://github.com/rappasoft/laravel-5-boilerplate). Unit & feature tests are not integrated yet, therefore this project isn't rock-solid for now. 

[![Build Status](https://drone.pc-world.fr/api/badges/adr1enbe4udou1n/laravel-boilerplate/status.svg)](https://drone.pc-world.fr/adr1enbe4udou1n/laravel-boilerplate)
[![License](https://poser.pugx.org/adr1enbe4udou1n/laravel-boilerplate/license)](https://packagist.org/packages/adr1enbe4udou1n/laravel-boilerplate)

## Demo

<p align="center">
<img src="https://user-images.githubusercontent.com/3679080/29774712-d2f213e6-8c02-11e7-89b9-9578a6780f54.gif">
</p>

* Frontend demo : [https://laravel-boilerplate.pc-world.fr](https://laravel-boilerplate.pc-world.fr)
* Backend demo : [https://laravel-boilerplate.pc-world.fr/admincp](https://laravel-boilerplate.pc-world.fr/admincp) (demo@example.com/demo, read-only)

## Features

### Frontend

* Bootstrap 4 (beta) Frontend with basic home-about-contact and legal mentions pages.
* [Slick carousel](http://kenwheeler.github.io/slick/) and [Cookie Consent](https://cookieconsent.insites.com/) integrated.
* Blog section, including navigation by tags & authors.
* Intervention image cache for dynamic optimized images.
* Login throttle by recaptcha & password strength meter.
* Frontend user space and profile management. Email validation included. Registration can be disabled by environment parameter.
* Social login with all supported socialite providers (facebook/twitter/linkedin/github/bitbucket).

### Backend

#### Underlying layer

* Based on Bootstrap 4 [CoreUI](https://github.com/mrholek/CoreUI-Free-Bootstrap-Admin-Template) theme with many useful plugins (DataTables, SweetAlert2, Flatpickr, CKEditor, etc.).
* Entirely written with Vue components, including vue-route for instant client-side navigation
* All main CRUD actions are ajaxified
* Client-side validation with [vee-validate](https://github.com/baianat/vee-validate)
* Native [vue-select](https://github.com/sagalbot/vue-select) component for powerful select system (autocomplete, tags, etc.)
* Batch actions integrated within DataTables thanks to his select plugin.
* Client-side CSV export feature included by buttons DataTable plugin.

#### Features included

* User and permissions management (classic users <-> roles <-> permissions structure).
* Impersonation feature for quick user context testing.
* Frontend forms module, including settings (recipients and translatable message confirmation) & submissions management.
* Posts management for frontend blog, with granular publication permissions (classic draft-pending-published workflow). Posts include title, summary, html body, tags, featured image, metas. They can be published at specific datetime and pinned if needed. Specific user can be limited to modify own posts only, according to his permissions.
* No media manager interface included with this boilerplate, but the "uploadimage" CKEditor plugin is installed in order to support direct drag & drop image files.

### Localization & SEO

* Multilingual ready thanks to [Laravel Localization](https://github.com/mcamara/laravel-localization) package. Each routes are prefixed by locale in URL for best SEO support. For this boilerplate, EN & FR locales are 100% supported, including translated routes.
* Model Field Translatable support with [Laravel Translatable](https://github.com/dimsav/laravel-translatable), used for contact form confirmed message, metatags and posts.
* Robots and Sitemap integrated, including multilingual alternates.
* Full Metatags manager interface with translatable title & description. Meta entity can be either linked to route or specific entity like post.
* 301/302 redirections manager interface, with CSV/XLSX import feature.

### Developer Specific

* Server-side (blade) and client-side (vue) form components bootstrap helpers.
* Usage of [Laravel-Mediable](https://github.com/plank/laravel-mediable) package for orderable media model management, used for featured image on posts.
* Permissions configuration based on config file rather than database.
* Form types defined on config file for settings & submission support. This boilerplate include just one "contact form" type.
* Custom webpack integration rather than laravel mix, for better flexibility (cf bellow).

## Install

[![Deploy](https://www.herokucdn.com/deploy/button.png)](https://heroku.com/deploy)

1. `composer create-project --prefer-dist --stability=dev adr1enbe4udou1n/laravel-boilerplate my-new-project`
2. Set database and environment variables from **.env.example**
3. Set Web write permission if needed to `bootstrap/cache` and `storage` folders.
4. Launch follow commands :

### For Production :

```shell
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan storage:link
php artisan migrate --force
```

### For Local/Development :

```shell
composer install
php artisan key:generate
php artisan storage:link
php artisan migrate [--seed]
```

### Backend access

The first user to register will be automatically super admin with no restriction and will cannot be deletable.
Both frontend and backend have dedicated login pages.

## Development notes

### Compiling assets with Webpack

1. Install dependencies with `yarn`
2. Launch `yarn watch` for compiling assets and start browsersync

> Note : If assets modified, don't forget to launch `yarn production` before deploy on each production environment.

### Permissions definitions

Unlike other known project as [ENTRUST](https://github.com/Zizaco/entrust) or [laravel-permission](https://github.com/spatie/laravel-permission), which are well suited for generic roles/permissions, i preferred a more lite and integrated custom solution.

You will especially note that relations between roles and permissions are a bit different, while links between users and roles stay a classic many-to-many relationship. Instead of store all permissions into specific SQL table and link them with roles by a many-to-many relationship, these latter must be directly defined in a specific config file permissions. Roles just own only a list of permissions key names.

Indeed i feel this approach even more logical for maintainability simply because permissions are hardly tied to the application with Laravel Authorization. This is anyway the standard way in CMS as Drupal where each module have specific config permission file. Permissions should be only owned by developers.

### Note on Laravel Mix

You will observe that this boilerplate does not use [Laravel Mix](https://github.com/JeffreyWay/laravel-mix) which is shipped in Laravel for all assets management.

Laravel Mix still stay awesome for newcomers thanks to his laravel-like webpack fluent API, but, even if Laravel Mix can be easily overridden, for this project i preferred use my custom framework-free webpack setup in order to have total control of assets workflow.

For instance, with this custom setup HMR work natively with configurable port and productions assets are correctly cleanup after each compilation in specific "dist" directory.

This webpack setup is a direct recovery from my other little side-project [Express Boilerplate](https://github.com/adr1enbe4udou1n/express-boilerplate) which is optimized for quick prototype frontend development based on express Node framework.

## TODO

- [x] <s>Data seeds</s>
- [x] <s>Batch actions</s>
- [x] <s>Form & menu access helpers</s>
- [x] <s>Metas management</s>
- [x] <s>Permissions management</s>
- [x] <s>Form submissions management</s>
- [x] <s>Client validation with vee-validate</s>
- [x] <s>301 redirection management with CSV/XLS import</s>
- [x] <s>Export Datatables to CSV/Excel buttons</s>
- [x] <s>Own account deletion</s>
- [x] <s>Account language & timezone selection</s>
- [x] <s>Account mail confirmation</s>
- [x] <s>Account avatar</s>
- [x] <s>Facebook/Twitter/Google Sign in with socialite package</s>
- [x] <s>Blog system (posts, publication date, multilangue, HTML wysiwyg, tags, featured image, medias, public user profile)</s>
- [x] <s>Dashboard</s>
- [x] <s>Switch to full Bootstrap 4 beta for both Frontend & Backend</s>
- [x] <s>Create client-side Vue components Form Helpers</s>
- [x] <s>With previous task done, then why not consider 100% client-side Vue backend with vue-route ? Will be nice but seems a lot to do...</s>
- [ ] Refactor & debug
- [ ] Inclusion of unit/featured/browser tests

## License

This project is open-sourced software licensed under the [MIT license](https://adr1enbe4udou1n.mit-license.org).
