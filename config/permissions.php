<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Application Permissions
    |--------------------------------------------------------------------------
    */

    'access backend' => [
        'display_name' => 'permissions.access.backend.display_name',
        'description'  => 'permissions.access.backend.description',
        'category'     => 'permissions.categories.access',
    ],

    'view posts' => [
        'display_name' => 'permissions.view.posts.display_name',
        'description'  => 'permissions.view.posts.description',
        'category'     => 'permissions.categories.blog',
        'children'     => ['view own posts'],
    ],

    'create posts' => [
        'display_name' => 'permissions.create.posts.display_name',
        'description'  => 'permissions.create.posts.description',
        'category'     => 'permissions.categories.blog',
    ],

    'edit posts' => [
        'display_name' => 'permissions.edit.posts.display_name',
        'description'  => 'permissions.edit.posts.description',
        'category'     => 'permissions.categories.blog',
        'children'     => ['edit own posts'],
    ],

    'delete posts' => [
        'display_name' => 'permissions.delete.posts.display_name',
        'description'  => 'permissions.delete.posts.description',
        'category'     => 'permissions.categories.blog',
        'children'     => ['delete own posts'],
    ],

    'view own posts' => [
        'display_name' => 'permissions.view.own.posts.display_name',
        'description'  => 'permissions.view.own.posts.description',
        'category'     => 'permissions.categories.blog',
    ],

    'edit own posts' => [
        'display_name' => 'permissions.edit.own.posts.display_name',
        'description'  => 'permissions.edit.own.posts.description',
        'category'     => 'permissions.categories.blog',
    ],

    'delete own posts' => [
        'display_name' => 'permissions.delete.own.posts.display_name',
        'description'  => 'permissions.delete.own.posts.description',
        'category'     => 'permissions.categories.blog',
    ],

    'publish posts' => [
        'display_name' => 'permissions.publish.posts.display_name',
        'description'  => 'permissions.publish.posts.description',
        'category'     => 'permissions.categories.blog',
    ],

    'view form_settings' => [
        'display_name' => 'permissions.view.form_settings.display_name',
        'description'  => 'permissions.view.form_settings.description',
        'category'     => 'permissions.categories.form',
    ],

    'create form_settings' => [
        'display_name' => 'permissions.create.form_settings.display_name',
        'description'  => 'permissions.create.form_settings.description',
        'category'     => 'permissions.categories.form',
    ],

    'edit form_settings' => [
        'display_name' => 'permissions.edit.form_settings.display_name',
        'description'  => 'permissions.edit.form_settings.description',
        'category'     => 'permissions.categories.form',
    ],

    'delete form_settings' => [
        'display_name' => 'permissions.delete.form_settings.display_name',
        'description'  => 'permissions.delete.form_settings.description',
        'category'     => 'permissions.categories.form',
    ],

    'view form_submissions' => [
        'display_name' => 'permissions.view.form_submissions.display_name',
        'description'  => 'permissions.view.form_submissions.description',
        'category'     => 'permissions.categories.form',
    ],

    'delete form_submissions' => [
        'display_name' => 'permissions.delete.form_submissions.display_name',
        'description'  => 'permissions.delete.form_submissions.description',
        'category'     => 'permissions.categories.form',
    ],

    'view users' => [
        'display_name' => 'permissions.view.users.display_name',
        'description'  => 'permissions.view.users.description',
        'category'     => 'permissions.categories.access',
    ],

    'create users' => [
        'display_name' => 'permissions.create.users.display_name',
        'description'  => 'permissions.create.users.description',
        'category'     => 'permissions.categories.access',
    ],

    'edit users' => [
        'display_name' => 'permissions.edit.users.display_name',
        'description'  => 'permissions.edit.users.description',
        'category'     => 'permissions.categories.access',
    ],

    'delete users' => [
        'display_name' => 'permissions.delete.users.display_name',
        'description'  => 'permissions.delete.users.description',
        'category'     => 'permissions.categories.access',
    ],

    'impersonate users' => [
        'display_name' => 'permissions.impersonate.display_name',
        'description'  => 'permissions.impersonate.description',
        'category'     => 'permissions.categories.access',
    ],

    'view roles' => [
        'display_name' => 'permissions.view.roles.display_name',
        'description'  => 'permissions.view.roles.description',
        'category'     => 'permissions.categories.access',
    ],

    'create roles' => [
        'display_name' => 'permissions.create.roles.display_name',
        'description'  => 'permissions.create.roles.description',
        'category'     => 'permissions.categories.access',
    ],

    'edit roles' => [
        'display_name' => 'permissions.edit.roles.display_name',
        'description'  => 'permissions.edit.roles.description',
        'category'     => 'permissions.categories.access',
    ],

    'delete roles' => [
        'display_name' => 'permissions.delete.roles.display_name',
        'description'  => 'permissions.delete.roles.description',
        'category'     => 'permissions.categories.access',
    ],

    'view metas' => [
        'display_name' => 'permissions.view.metas.display_name',
        'description'  => 'permissions.view.metas.description',
        'category'     => 'permissions.categories.seo',
    ],

    'create metas' => [
        'display_name' => 'permissions.create.metas.display_name',
        'description'  => 'permissions.create.metas.description',
        'category'     => 'permissions.categories.seo',
    ],

    'edit metas' => [
        'display_name' => 'permissions.edit.metas.display_name',
        'description'  => 'permissions.edit.metas.description',
        'category'     => 'permissions.categories.seo',
    ],

    'delete metas' => [
        'display_name' => 'permissions.delete.metas.display_name',
        'description'  => 'permissions.delete.metas.description',
        'category'     => 'permissions.categories.seo',
    ],

    'view redirections' => [
        'display_name' => 'permissions.view.redirections.display_name',
        'description'  => 'permissions.view.redirections.description',
        'category'     => 'permissions.categories.seo',
    ],

    'create redirections' => [
        'display_name' => 'permissions.create.redirections.display_name',
        'description'  => 'permissions.create.redirections.description',
        'category'     => 'permissions.categories.seo',
    ],

    'edit redirections' => [
        'display_name' => 'permissions.edit.redirections.display_name',
        'description'  => 'permissions.edit.redirections.description',
        'category'     => 'permissions.categories.seo',
    ],

    'delete redirections' => [
        'display_name' => 'permissions.delete.redirections.display_name',
        'description'  => 'permissions.delete.redirections.description',
        'category'     => 'permissions.categories.seo',
    ],
];
