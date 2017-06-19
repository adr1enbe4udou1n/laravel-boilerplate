<?php

return [
    'language' => 'Language',
    'actions' => 'Actions',
    'general' => 'General',
    'no_results' => 'No results availible',
    'are_you_sure' => 'Are you sure ?',
    'yes' => 'Yes',
    'no' => 'No',
    'more_info' => 'More info',
    'last_access_at' => 'Last access at',
    'created_at' => 'Created at',
    'updated_at' => 'Updated at',
    'deleted_at' => 'Deleted at',
    'no_value' => 'No value',
    'all_rights_reserved' => 'All rights reserved.',

    'auth' => [
        'disabled' => 'Your account has been disabled.',
    ],

    'http' => [
        '403' => [
            'title' => 'Access Denied',
            'description' => 'Sorry, but you do not have permissions to access this page.',
        ],
        '404' => [
            'title' => 'Page Not Found',
            'description' => 'Sorry, but the page you were trying to view does not exist.',
        ],
        '500' => [
            'title' => 'Server Error',
            'description' => 'Sorry, but the server has encountered a situation it doesn\'t know how to handle. We\'ll fix this as soon as possible.',
        ],
    ],

    'localization' => [
        'en' => 'English',
        'fr' => 'French',
    ],

    'placeholder' => [
        'route' => 'Select a valid internal route',
    ],

    'cookieconsent' => [
        'message' => 'This website uses cookies to ensure you get the best experience on our website.',
        'dismiss' => 'Got it !',
    ],

    'descriptions' => [
        'metas' => [
            'route' => 'Value should correspond to an valid route name',
        ],

        'form_settings' => [
            'recipients' => 'Example: \'webmaster@example.com\' or \'sales@example.com,support@example.com\' . To specify multiple recipients, separate each email address with a comma.',
            'message' => 'The message to display to the user after submission of this form. Leave blank for no message.',
        ],
    ],

    'user' => [
        'dashboard' => 'Dashboard',
        'remember' => 'Remember',
        'login' => 'Login',
        'logout' => 'Logout',
        'password_forgot' => 'Forget password ?',
        'send_password_link' => 'Send reset password link',
        'password_reset' => 'Password Reset',
        'register' => 'Register',
        'space' => 'My space',
        'account' => 'My account',
        'profile' => 'My profile',
        'avatar' => 'Avatar',
        'online' => 'Online',
        'edit_profile' => 'Edit my profile',
        'change_password' => 'Change my password',
        'delete' => 'Delete my account',
        'administration' => 'Administration',
        'member_since' => 'Member since :date',
        'profile_updated' => 'Profile successfully updated.',
        'password_updated' => 'Password successfully updated.',
        'email_confirmation_sended' => 'Mail confirmation sended.',
        'email_confirmed' => 'Email successfully confirmed.',
        'super_admin' => 'Super administrateur',

        'account_delete' => '<p>This action will delete entirely your account from this site as well as all associated data.</p>',
        'account_deleted' => 'Account successfully deleted',

        'titles' => [
            'space' => 'My space',
            'account' => 'My account',
        ],
    ],

    'alerts' => [
        'login_as' => 'You are actually logged as <strong>:name</strong>, you can logout as <a href=":route">:admin</a>.',
        'not_confirmed' => 'Your account will be in limited mode as long as your email remains not confirmed. <a href=":route">Click here</a> in order to resend mail confirmation.',
    ],

    'backend' => [
        'sidebar' => [
            'forms' => 'Form management',
            'access' => 'Access management',
            'seo' => 'SEO settings',
        ],

        'titles' => [
            'dashboard' => 'Dashboard',
        ],

        'users' => [
            'titles' => [
                'main' => 'User management',
                'index' => 'User list',
                'create' => 'User creation',
                'edit' => 'User modification',
            ],

            'actions' => [
                'destroy' => 'Delete selected users',
                'enable' => 'Enable selected users',
                'disable' => 'Disable selected users',
            ],
        ],

        'roles' => [
            'titles' => [
                'main' => 'Role management',
                'index' => 'Role list',
                'create' => 'Role creation',
                'edit' => 'Role modification',
            ],
        ],

        'metas' => [
            'titles' => [
                'main' => 'Meta management',
                'index' => 'Meta list',
                'create' => 'Meta creation',
                'edit' => 'Meta modification',
            ],

            'actions' => [
                'destroy' => 'Delete selected metas',
            ],
        ],

        'form_submissions' => [
            'titles' => [
                'main' => 'Submission management',
                'index' => 'Submission list',
                'show' => 'Submission detail',
            ],

            'actions' => [
                'destroy' => 'Delete selected submissions',
            ],
        ],

        'form_settings' => [
            'titles' => [
                'main' => 'Form setting',
                'index' => 'Form setting list',
                'create' => 'Form setting creation',
                'edit' => 'Form setting modification',
            ],
        ],

        'redirections' => [
            'titles' => [
                'main' => 'Redirection management',
                'index' => 'Redirection list',
                'create' => 'Redirection creation',
                'edit' => 'Redirection modification',
            ],

            'actions' => [
                'destroy' => 'Delete selected redirections',
                'enable' => 'Enable selected redirections',
                'disable' => 'Disable selected redirections',
            ],

            'types' => [
                'permanent' => 'Permanent redirect (301)',
                'temporary' => 'Temporary redirect (302)',
            ],

            'import' => [
                'title' => 'CSV/Excel file import',
                'label' => 'Select CSV/Excel file to import',
                'description' => 'File must have 2 columns with "source" and "target" as heading, redirection will be permanent by default',
            ],
        ],

        'posts' => [
            'statuses' => [
                'draft' => 'Draft',
                'pending' => 'Pending',
                'published' => 'Published',
            ],
        ],
    ],

    'frontend' => [
        'titles' => [
            'home' => 'Home',
            'about' => 'About',
            'contact' => 'Contact',
            'message_sent' => 'Message sent',
            'legal_mentions' => 'Legal mentions',
        ],

        'submissions' => [
            'message_sent' => '<p>Your message has been successfully sent</p>',
        ],

        'placeholders' => [
            'locale' => 'Select your language',
            'timezone' => 'Select your timezone',
        ],
    ],
];
