<?php

return [
    'access' => [
        'backend' => [
            'display_name' => 'Backoffice access',
            'description' => 'Can access to administration pages',
        ],
    ],

    'manage' => [
        'form_settings' => [
            'display_name' => 'Manage form settings',
            'description' => 'Can manage all form settings (create, update, delete)',
        ],

        'form_submissions' => [
            'display_name' => 'Manage form submissions',
            'description' => 'Can manage all form submissions (view, delete)',
        ],

        'users' => [
            'display_name' => 'Manage users',
            'description' => 'Can manage all users (create, update, delete)',
        ],

        'roles' => [
            'display_name' => 'Manage roles',
            'description' => 'Can manage all roles (create, update, delete)',
        ],

        'metas' => [
            'display_name' => 'Manage metas',
            'description' => 'Can manage all metas (create, update, delete)',
        ],

        'redirections' => [
            'display_name' => 'Manage redirections',
            'description' => 'Can manage all redirections (create, update, delete)',
        ],
    ],

    'impersonate' => [
        'display_name' => 'Impersonate user',
        'description' => 'Can take ownership of others user identities. Useful for tests.',
    ],

    'account' => [
        'delete' => [
            'display_name' => 'Own account delete',
            'description' => 'User can delete its own account.',
        ],
    ],
];
