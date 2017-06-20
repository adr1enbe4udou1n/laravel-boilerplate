<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/robots.txt', 'SeoController@robots');
Route::get('/sitemap.xml', 'SeoController@sitemap');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath',
    ],
], function () {
    Route::group(
        ['namespace' => 'Frontend', 'middleware' => ['metas']],
        function () {
            Route::get('/', 'FrontendController@index')->name('home');
            Route::get(LaravelLocalization::transRoute('routes.about'), 'FrontendController@about')->name('about');
            Route::match(['GET', 'POST'], LaravelLocalization::transRoute('routes.contact'),
                'FrontendController@contact')
                ->name('contact');
            Route::get(LaravelLocalization::transRoute('routes.contact-sent'), 'FrontendController@contactSent')->name(
                'contact-sent'
            );
            Route::get(LaravelLocalization::transRoute('routes.legal-mentions'), 'FrontendController@legalMentions')
                ->name(
                    'legal-mentions'
                );

            if (config('blog.enabled')) {
                Route::get('blog', 'BlogController@index')
                    ->name(
                        'blog.index'
                    );

                Route::get('blog/{slug}', 'BlogController@show')
                    ->name(
                        'blog.show'
                    );
            }
        }
    );

    Route::group(
        ['namespace' => 'Auth'],
        function () {
            if (config('account.can_register')) {
                // Registration Routes...
                Route::get('register',
                    'RegisterController@showRegistrationForm')
                    ->name('register');
                Route::post('register', 'RegisterController@register');
            }

            // Authentication Routes...
            Route::get('login', 'LoginController@showLoginForm')
                ->name('login');
            Route::post('login', 'LoginController@login');
            Route::get('logout', 'LoginController@logout')->name('logout');

            Route::get('login/{provider}', 'LoginController@redirectToProvider')->name('social.login');
            Route::get('login/{provider}/callback', 'LoginController@handleProviderCallback')->name('social.callback');

            Route::group(
                ['middleware' => ['can:impersonate users']],
                function () {
                    Route::get('user/{user}/login-as',
                        'LoginController@loginAs')
                        ->name('login-as');
                }
            );
            Route::get('logout-as', 'LoginController@logoutAs')->name(
                'logout-as'
            );

            // Password Reset Routes...
            Route::get('password/reset',
                'ForgotPasswordController@showLinkRequestForm')
                ->name('password.request');
            Route::post('password/email',
                'ForgotPasswordController@sendResetLinkEmail')
                ->name('password.email');
            Route::get('password/reset/{token}',
                'ResetPasswordController@showResetForm')
                ->name('password.reset');
            Route::post('password/reset', 'ResetPasswordController@reset');

            // Admin specific login forms
            Route::get('admin/login', 'LoginController@showAdminLoginForm')
                ->name('admin.login');
            Route::get('admin/password/reset',
                'ForgotPasswordController@showAdminLinkRequestForm')
                ->name('admin.password.request');
        }
    );

    // Admin Routes
    Route::group(
        [
            'namespace' => 'User',
            'prefix' => 'user',
            'as' => 'user.',
            'middleware' => ['auth'],
        ],
        function () {
            /*
             * User Dashboard Specific
             */
            Route::get('/', 'UserController@index')->name('home');

            /*
             * User Account Specific
             */
            Route::get('account', 'AccountController@index')->name('account');

            /*
             * User Profile Update
             */
            Route::patch('account/update', 'AccountController@update')
                ->name('account.update');

            /*
             * Password Change
             */
            Route::patch('password/change', 'AccountController@changePassword')
                ->name('password.change');

            /*
             * Resend confirmation mail
             */
            Route::get('confirmation/send', 'AccountController@sendConfirmation')->name('confirmation.send');

            /*
             * Confirm email
             */
            Route::get('email/confirm/{token}', 'AccountController@confirmEmail')->name('email.confirm');

            if (config('account.can_delete')) {
                /*
                 * Account delete
                 */
                Route::delete('account/delete', 'AccountController@delete')
                    ->name('account.delete');
            }
        }
    );

    // Admin Routes
    Route::group(
        [
            'namespace' => 'Backend',
            'prefix' => 'admin',
            'as' => 'admin.',
            'middleware' => ['auth', 'can:access backend'],
        ],
        function () {
            Route::get('/', 'BackendController@index')
                ->name('home');
            Route::get('/route/search', 'AjaxController@routeSearch')
                ->name('route.search');

            Route::group(
                ['middleware' => ['can:manage form_settings']],
                function () {
                    Route::get('form-setting', 'FormSettingController@index')
                        ->name('form_setting.index');
                    Route::get('form-setting/create', 'FormSettingController@create')
                        ->name('form_setting.create');
                    Route::post('form-setting', 'FormSettingController@store')
                        ->name('form_setting.store');
                    Route::get('form-setting/{form_setting}/edit', 'FormSettingController@edit')
                        ->name('form_setting.edit');
                    Route::match(['PUT', 'PATCH'], 'form-setting/{form_setting}',
                        'FormSettingController@update')->name('form_setting.update');
                    Route::delete('form-setting/{form_setting}', 'FormSettingController@destroy')
                        ->name('form_setting.destroy');

                    Route::post('form-setting/search', 'FormSettingController@search')->name(
                        'form_setting.search'
                    );
                }
            );

            Route::group(
                ['middleware' => ['can:manage form_submissions']],
                function () {
                    Route::get('form-submission', 'FormSubmissionController@index')
                        ->name('form_submission.index');
                    Route::get('form-submission/{form_submission}', 'FormSubmissionController@show')
                        ->name('form_submission.show');
                    Route::delete('form-submission/{form_submission}', 'FormSubmissionController@destroy')
                        ->name('form_submission.destroy');

                    Route::post('form_submission/search', 'FormSubmissionController@search')->name(
                        'form_submission.search'
                    );

                    Route::post('form_submission/batch-action',
                        'FormSubmissionController@batchAction')->name(
                        'form_submission.batch-action'
                    );
                }
            );

            Route::group(
                ['middleware' => ['can:manage users']],
                function () {
                    Route::resource('user', 'UserController',
                        ['except' => ['show']]);

                    Route::post('user/search', 'UserController@search')->name(
                        'user.search'
                    );

                    Route::post('user/batch-action',
                        'UserController@batchAction')->name(
                        'user.batch-action'
                    );

                    Route::get('user/{user}/login-as', 'UserController@loginAs')
                        ->name(
                            'user.login-as'
                        );
                }
            );

            Route::group(
                ['middleware' => ['can:manage roles']],
                function () {
                    Route::resource('role', 'RoleController',
                        ['except' => ['show']]);

                    Route::post('role/search', 'RoleController@search')->name(
                        'role.search'
                    );
                }
            );

            Route::group(
                ['middleware' => ['can:manage metas']],
                function () {
                    Route::get('meta', 'MetaController@index')
                        ->name('meta.index');
                    Route::get('meta/create', 'MetaController@create')
                        ->name('meta.create');
                    Route::post('meta', 'MetaController@store')
                        ->name('meta.store');
                    Route::get('meta/{meta}/edit', 'MetaController@edit')
                        ->name('meta.edit');
                    Route::match(['PUT', 'PATCH'], 'meta/{meta}',
                        'MetaController@update')->name('meta.update');
                    Route::delete('meta/{meta}', 'MetaController@destroy')
                        ->name('meta.destroy');

                    Route::post('meta/search', 'MetaController@search')->name(
                        'meta.search'
                    );

                    Route::post('meta/batch-action',
                        'MetaController@batchAction')->name(
                        'meta.batch-action'
                    );
                }
            );

            Route::group(
                ['middleware' => ['can:manage redirections']],
                function () {
                    Route::get('redirection', 'RedirectionController@index')
                        ->name('redirection.index');
                    Route::get('redirection/create', 'RedirectionController@create')
                        ->name('redirection.create');
                    Route::post('redirection', 'RedirectionController@store')
                        ->name('redirection.store');
                    Route::get('redirection/{redirection}/edit', 'RedirectionController@edit')
                        ->name('redirection.edit');
                    Route::match(['PUT', 'PATCH'], 'redirection/{redirection}',
                        'RedirectionController@update')->name('redirection.update');
                    Route::delete('redirection/{redirection}', 'RedirectionController@destroy')
                        ->name('redirection.destroy');

                    Route::post('redirection/search', 'RedirectionController@search')->name(
                        'redirection.search'
                    );

                    Route::post('redirection/batch-action',
                        'RedirectionController@batchAction')->name(
                        'redirection.batch-action'
                    );

                    Route::post('redirection/import', 'RedirectionController@import')
                        ->name('redirection.import');
                }
            );
        }
    );
});
