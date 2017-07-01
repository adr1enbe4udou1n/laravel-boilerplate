<?php

Route::group(
    [
        'namespace' => 'Backend',
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => ['auth', 'can:access backend'],
    ],
    function () {
        Route::get('/', 'DashboardController@index')
            ->name('home');
        Route::get('/routes/search', 'AjaxController@routesSearch')
            ->name('routes.search');
        Route::get('/tags/search', 'AjaxController@tagsSearch')
            ->name('tags.search');
        Route::post('/images/upload', 'AjaxController@imageUpload')
            ->name('images.upload');

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

        if (config('blog.enabled')) {
            Route::group(
                ['middleware' => ['can:manage own posts']],
                function () {
                    Route::get('post', 'PostController@index')
                        ->name('post.index');
                    Route::get('post/create', 'PostController@create')
                        ->name('post.create');
                    Route::post('post', 'PostController@store')
                        ->name('post.store');
                    Route::get('post/{post}/edit', 'PostController@edit')
                        ->name('post.edit')
                        ->middleware('can:update,post');
                    Route::match(['PUT', 'PATCH'], 'post/{post}',
                        'PostController@update')->name('post.update')
                        ->middleware('can:update,post');
                    Route::delete('post/{post}', 'PostController@destroy')
                        ->name('post.destroy')
                        ->middleware('can:update,post');

                    Route::post('post/search', 'PostController@search')
                        ->name(
                            'post.search'
                        );

                    Route::post('post/batch-action',
                        'PostController@batchAction')->name(
                        'post.batch-action'
                    );
                }
            );
        }
    }
);
