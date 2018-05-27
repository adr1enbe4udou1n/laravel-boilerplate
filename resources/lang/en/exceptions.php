<?php

return [
    'general'      => 'Server exception',
    'unauthorized' => 'Action not allowed',

    'backend' => [
        'users' => [
            'create'                            => 'Error on user creation',
            'update'                            => 'Error on user updating',
            'delete'                            => 'Error on user deletion',
            'first_user_cannot_be_edited'       => 'You cannot edit super admin user',
            'first_user_cannot_be_disabled'     => 'Super admin user cannot be disabled',
            'first_user_cannot_be_destroyed'    => 'Super admin user cannot be deleted',
            'first_user_cannot_be_impersonated' => 'Super admin user cannot be impersonated',
            'cannot_set_superior_roles'         => 'You cannot attribute roles superior to yours',
        ],

        'roles' => [
            'create' => 'Error on role creation',
            'update' => 'Error on role updating',
            'delete' => 'Error on role deletion',
        ],

        'metas' => [
            'create'        => 'Error on meta creation',
            'update'        => 'Error on meta updating',
            'delete'        => 'Error on meta deletion',
            'already_exist' => 'There is already a meta for this locale route',
        ],

        'form_submissions' => [
            'create' => 'Error on submission creation',
            'delete' => 'Error on submission deletion',
        ],

        'form_settings' => [
            'create'        => 'Error on form setting creation',
            'update'        => 'Error on form setting updating',
            'delete'        => 'Error on form setting deletion',
            'already_exist' => 'There is already a setting linked to this form',
        ],

        'redirections' => [
            'create'        => 'Error on redirection creation',
            'update'        => 'Error on redirection updating',
            'delete'        => 'Error on redirection deletion',
            'already_exist' => 'There is already a redirection for this path',
        ],

        'posts' => [
            'create' => 'Error on post creation',
            'update' => 'Error on post updating',
            'save'   => 'Error on post saving',
            'delete' => 'Error on post deletion',
        ],
    ],

    'frontend' => [
        'user' => [
            'email_taken'       => 'That e-mail address is already taken.',
            'password_mismatch' => 'That is not your old password.',
            'delete_account'    => 'Error on account deletion.',
            'updating_disabled' => 'Account editing is disabled.',
        ],

        'auth' => [
            'registration_disabled' => 'Registration is disabled.',
        ],
    ],
];
