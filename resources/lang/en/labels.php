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
    'created_at' => 'Created at',
    'updated_at' => 'Updated at',
    'deleted_at' => 'Deleted at',
    'all_rights_reserved' => 'All rights reserved.',

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

    'cookieconsent' => [
        'message' => 'This website uses cookies to ensure you get the best experience on our website.',
        'dismiss' => 'Got it !',
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
        'edit_profile' => 'Edit my profile',
        'change_password' => 'Change my password',
        'administration' => 'Administration',
        'member_since' => 'Member since :date',
        'profile_updated' => 'Profile successfully updated.',
        'password_updated' => 'Password successfully updated.',

        'titles' => [
            'space' => 'My space',
            'account' => 'My account',
        ],

        'attributes' => [
            'name' => 'Name',
            'email' => 'Email',
            'created_at' => 'Creation date',
            'updated_at' => 'Last updated date',
        ],
    ],

    'backend' => [
        'login-as' => 'You are actually logged as <strong>:name</strong>, you can logout as <a href=":route">:admin</a>.',

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
        ],

        'roles' => [
            'titles' => [
                'main' => 'Role management',
                'index' => 'Role list',
                'create' => 'Role creation',
                'edit' => 'Role modification',
            ],
        ],
    ],

    'frontend' => [

        'titles' => [
            'home' => 'Home',
            'about' => 'About',
            'contact' => 'Contact',
            'legal_mentions' => 'Legal mentions',
        ],
    ],
];
