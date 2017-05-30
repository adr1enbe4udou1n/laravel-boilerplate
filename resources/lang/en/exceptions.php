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
    ],

    'frontend' => [
        'user' => [
            'email_taken' => 'That e-mail address is already taken.',
            'password_mismatch' => 'That is not your old password.',
        ]
    ],
];
