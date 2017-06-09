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
            Route::get('/about', 'FrontendController@about')->name('about');
            Route::match(['GET', 'POST'], '/contact',
                'FrontendController@contact')
                ->name('contact');
            Route::get('/contact-sent', 'FrontendController@contactSent')->name(
                'contact-sent'
            );
            Route::get('/legal-mentions', 'FrontendController@legalMentions')
                ->name(
                    'legal-mentions'
                );
        }
    );

    Route::group(
        ['namespace' => 'Auth'],
        function () {
            if (config('app.registration')) {
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
        }
    );
});
