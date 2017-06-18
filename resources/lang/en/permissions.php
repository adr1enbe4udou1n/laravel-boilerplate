<?php

return [
    'categories' => [
        'blog' => 'Blog',
        'form' => 'Forms',
        'access' => 'Access',
        'seo' => 'SEO',
    ],

    'access' => [
        'backend' => [
            'display_name' => 'Backoffice access',
            'description' => 'Can access to administration pages.',
        ],
    ],

    'manage' => [
        'form_settings' => [
            'display_name' => 'Administer form settings',
            'description' => 'Can manage all form settings (create, update, delete).',
        ],

        'form_submissions' => [
            'display_name' => 'Administer form submissions',
            'description' => 'Can manage all form submissions (view, delete).',
        ],

        'users' => [
            'display_name' => 'Administer users',
            'description' => 'Can manage all users (create, update, delete).',
        ],

        'roles' => [
            'display_name' => 'Administer roles',
            'description' => 'Can manage all roles (create, update, delete).',
        ],

        'metas' => [
            'display_name' => 'Administer metas',
            'description' => 'Can manage all metas (create, update, delete).',
        ],

        'redirections' => [
            'display_name' => 'Administer redirections',
            'description' => 'Can manage all redirections (create, update, delete).',
        ],

        'posts' => [
            'display_name' => 'Administer posts',
            'description' => 'Can manage all posts (create, update, delete).',
        ],

        'own' => [
            'posts' => [
                'display_name' => 'Manage own posts',
                'description' => 'Can manage own posts (create, update, delete).',
            ],
        ],
    ],

    'impersonate' => [
        'display_name' => 'Impersonate user',
        'description' => 'Can take ownership of others user identities. Useful for tests.',
    ],
];
