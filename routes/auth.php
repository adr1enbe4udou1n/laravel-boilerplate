<?php

Route::group(
    ['namespace' => 'Auth'],
    function () {
        if (config('account.can_register')) {
            // Registration Routes...
            Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
            Route::post('register', 'RegisterController@register');
        }

        // Authentication Routes...
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');
        Route::get('logout', 'LoginController@logout')->name('logout');

        Route::get('login/{provider}', 'LoginController@redirectToProvider')->name('social.login');
        Route::get('login/{provider}/callback', 'LoginController@handleProviderCallback')->name('social.callback');

        // Password Reset Routes...
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', 'ResetPasswordController@reset');

        // Admin specific login forms
        Route::get(config('app.admin_path').'/login', 'LoginController@showAdminLoginForm')->name('admin.login');
        Route::get(config('app.admin_path').'/logout', 'LoginController@adminLogout')->name('admin.logout');
        Route::get(config('app.admin_path').'/password/reset', 'ForgotPasswordController@showAdminLinkRequestForm')->name('admin.password.request');
    }
);

Route::group(
    [
        'namespace'  => 'User',
        'prefix'     => 'user',
        'as'         => 'user.',
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
        Route::patch('account/update', 'AccountController@update')->name('account.update');

        /*
         * Password Change
         */
        Route::patch('password/change', 'AccountController@changePassword')->name('password.change');

        if (config('account.can_delete')) {
            /*
             * Account delete
             */
            Route::delete('account/delete', 'AccountController@delete')->name('account.delete');
        }
    }
);
