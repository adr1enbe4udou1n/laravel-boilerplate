<?php

return [
    'backend' => [
        'users' => [
            'create' => 'Error on user creation',
            'update' => 'Error on user updating',
            'delete' => 'Error on user deletion',
            'first_user_cannot_be_disabled' => 'Super admin user cannot be disabled',
            'first_user_cannot_be_destroyed' => 'Super admin user cannot be deleted',
        ],

        'roles' => [
            'create' => 'Error on role creation',
            'update' => 'Error on role updating',
            'delete' => 'Error on role deletion',
        ],

        'metas' => [
            'create' => 'Error on meta creation',
            'update' => 'Error on meta updating',
            'delete' => 'Error on meta deletion',
            'already_exist' => 'There is already a meta for this locale route',
        ],

        'form_submissions' => [
            'create' => 'Error on submission creation',
            'delete' => 'Error on submission deletion',
        ],

        'form_settings' => [
            'create' => 'Error on form setting creation',
            'update' => 'Error on form setting updating',
            'delete' => 'Error on form setting deletion',
            'already_exist' => 'There is already a setting linked to this form',
        ],

        'redirections' => [
            'create' => 'Error on redirection creation',
            'update' => 'Error on redirection updating',
            'delete' => 'Error on redirection deletion',
            'already_exist' => 'There is already a redirection for this path',
        ],
    ],

    'frontend' => [
        'user' => [
            'email_taken' => 'That e-mail address is already taken.',
            'password_mismatch' => 'That is not your old password.',
            'delete_account' => 'Error on account deletion.',
        ],

        'auth' => [
            'registration_disabled' => 'Registration is disabled.'
        ],
    ],
];
