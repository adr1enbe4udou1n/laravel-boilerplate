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

            Route::group(
                ['middleware' => ['can:manage users']],
                function () {
                    Route::resource('user', 'UserController',
                        ['except' => ['show']]);
                    Route::post('user/search', 'UserController@search')->name(
                        'user.search'
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
                ['middleware' => ['can:impersonate users']],
                function () {
                    Route::get('user/{user}/login-as', 'UserController@loginAs')
                        ->name(
                            'user.login-as'
                        );

                    Route::get('logout-as', 'UserController@logoutAs')->name(
                        'user.logout-as'
                    );
                }
            );
        }
    );
});
