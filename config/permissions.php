<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Application Permissions
    |--------------------------------------------------------------------------
    */

    'access backend' => [
        'display_name' => 'permissions.access.backend.display_name',
        'description' => 'permissions.access.backend.description',
        'category' => 'permissions.categories.access',
    ],

    'manage posts' => [
        'display_name' => 'permissions.manage.posts.display_name',
        'description' => 'permissions.manage.posts.description',
        'category' => 'permissions.categories.blog',
    ],

    'manage own posts' => [
        'display_name' => 'permissions.manage.own.posts.display_name',
        'description' => 'permissions.manage.own.posts.description',
        'category' => 'permissions.categories.blog',
    ],

    'publish posts' => [
        'display_name' => 'permissions.publish.posts.display_name',
        'description' => 'permissions.publish.posts.description',
        'category' => 'permissions.categories.blog',
    ],

    'manage form_settings' => [
        'display_name' => 'permissions.manage.form_settings.display_name',
        'description' => 'permissions.manage.form_settings.description',
        'category' => 'permissions.categories.form',
    ],

    'manage form_submissions' => [
        'display_name' => 'permissions.manage.form_submissions.display_name',
        'description' => 'permissions.manage.form_submissions.description',
        'category' => 'permissions.categories.form',
    ],

    'manage users' => [
        'display_name' => 'permissions.manage.users.display_name',
        'description' => 'permissions.manage.users.description',
        'category' => 'permissions.categories.access',
    ],

    'impersonate users' => [
        'display_name' => 'permissions.impersonate.display_name',
        'description' => 'permissions.impersonate.description',
        'category' => 'permissions.categories.access',
    ],

    'manage roles' => [
        'display_name' => 'permissions.manage.roles.display_name',
        'description' => 'permissions.manage.roles.description',
        'category' => 'permissions.categories.access',
    ],

    'manage metas' => [
        'display_name' => 'permissions.manage.metas.display_name',
        'description' => 'permissions.manage.metas.description',
        'category' => 'permissions.categories.seo',
    ],

    'manage redirections' => [
        'display_name' => 'permissions.manage.redirections.display_name',
        'description' => 'permissions.manage.redirections.description',
        'category' => 'permissions.categories.seo',
    ],
];
