<?php

return [
    'backend' => [
        'users' => [
            'create' => 'Error when user creation',
            'update' => 'Error when user updating',
            'delete' => 'Error when user deletion',
        ],

        'roles' => [
            'create' => 'Error when role creation',
            'update' => 'Error when role updating',
            'delete' => 'Error when role deletion',
        ],

        'metas' => [
            'create' => 'Error when meta creation',
            'update' => 'Error when meta updating',
            'delete' => 'Error when meta deletion',
            'already_exist' => 'There is already a meta for this locale route'
        ],
    ],

    'frontend' => [
        'user' => [
            'email_taken' => 'That e-mail address is already taken.',
            'password_mismatch' => 'That is not your old password.',
        ]
    ],
];
