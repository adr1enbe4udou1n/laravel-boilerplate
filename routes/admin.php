<?php

Route::get('/', 'BackendController@index')
    ->name('home');
Route::get('routes/search', 'AjaxController@routesSearch')
    ->name('routes.search');
Route::get('tags/search', 'AjaxController@tagsSearch')
    ->name('tags.search');
Route::post('images/upload', 'AjaxController@imageUpload')
    ->name('images.upload');

Route::group(
    ['middleware' => ['can:manage form_settings']],
    function () {
        Route::get('form_settings/form_types', 'FormSettingController@getFormTypes')
            ->name('form_settings.get_form_types');

        Route::post('form_settings/search', 'FormSettingController@search')
            ->name('form_settings.search');

        Route::resource('form_settings', 'FormSettingController', [
            'only' => ['show', 'store', 'update', 'destroy'],
        ]);
    }
);

Route::group(
    ['middleware' => ['can:manage form_submissions']],
    function () {
        Route::get('form_submissions/counter', 'FormSubmissionController@getFormSubmissionCounter')
            ->name('form_submissions.counter');

        Route::post('form_submissions/search', 'FormSubmissionController@search')
            ->name('form_submissions.search');

        Route::resource('form_submissions', 'FormSubmissionController', [
            'only' => ['show', 'destroy'],
        ]);

        Route::post('form_submissions/batch_action',
            'FormSubmissionController@batchAction')->name(
            'form_submissions.batch_action'
        );
    }
);

Route::group(
    ['middleware' => ['can:manage users']],
    function () {
        Route::get('users/active_counter', 'UserController@getActiveUserCounter')
            ->name('users.active.counter');

        Route::get('users/roles', 'UserController@getRoles')
            ->name('users.get_roles');

        Route::post('users/search', 'UserController@search')
            ->name('users.search');

        Route::resource('users', 'UserController', [
            'only' => ['show', 'store', 'update', 'destroy'],
        ]);

        Route::post('users/batch_action',
            'UserController@batchAction')->name(
            'users.batch_action'
        );
    }
);

Route::group(
    ['middleware' => ['can:manage roles']],
    function () {
        Route::get('roles/permissions', 'RoleController@getPermissions')
            ->name('roles.get_permissions');

        Route::post('roles/search', 'RoleController@search')
            ->name('roles.search');

        Route::resource('roles', 'RoleController', [
            'only' => ['show', 'store', 'update', 'destroy'],
        ]);
    }
);

Route::group(
    ['middleware' => ['can:manage metas']],
    function () {
        Route::post('metas/search', 'MetaController@search')
            ->name('metas.search');

        Route::resource('metas', 'MetaController', [
            'only' => ['show', 'store', 'update', 'destroy'],
        ]);

        Route::post('metas/batch_action',
            'MetaController@batchAction')->name(
            'metas.batch_action'
        );
    }
);

Route::group(
    ['middleware' => ['can:manage redirections']],
    function () {
        Route::get('redirections/redirection_types', 'RedirectionController@getRedirectionTypes')
            ->name('redirections.get_redirection_types');

        Route::post('redirections/search', 'RedirectionController@search')
            ->name('redirections.search');

        Route::resource('redirections', 'RedirectionController', [
            'only' => ['show', 'store', 'update', 'destroy'],
        ]);

        Route::post('redirections/batch_action',
            'RedirectionController@batchAction')->name(
            'redirections.batch_action'
        );

        Route::post('redirections/import', 'RedirectionController@import')
            ->name('redirections.import');
    }
);

if (config('blog.enabled')) {
    Route::group(
        ['middleware' => ['can:manage own posts']],
        function () {
            Route::get('posts/draft_counter', 'PostController@getDraftPostCounter')
                ->name('posts.draft.counter');
            Route::get('posts/pending_counter', 'PostController@getPendingPostCounter')
                ->name('posts.pending.counter');
            Route::get('posts/published_counter', 'PostController@getPublishedPostCounter')
                ->name('posts.published.counter');
            Route::get('posts/latest', 'PostController@getLastestPosts')
                ->name('posts.latest');

            Route::post('posts/search', 'PostController@search')
                ->name('posts.search');

            Route::resource('posts', 'PostController', [
                'only' => ['show', 'store', 'update', 'destroy'],
            ]);

            Route::post('posts/batch_action',
                'PostController@batchAction')->name(
                'posts.batch_action'
            );
        }
    );
}
