<?php

return [
    'categories' => [
        'blog' => 'Blog',
        'form' => 'Formulaires',
        'access' => 'Accès',
        'seo' => 'SEO',
    ],

    'access' => [
        'backend' => [
            'display_name' => 'Accès au backoffice',
            'description' => 'Permet l\'accès aux pages du backoffice.',
        ],
    ],

    'manage' => [
        'form_settings' => [
            'display_name' => 'Administrer les paramètres de formulaires',
            'description' => 'Possibilité de gérer la liste des paramètres de formulaires (création, mise à jour, suppression).',
        ],

        'form_submissions' => [
            'display_name' => 'Administrer les soumissions de formulaire',
            'description' => 'Possibilité de gérer la liste des soumissions de formulaire (détail, suppressions)',
        ],

        'users' => [
            'display_name' => 'Administrer les utilisateurs',
            'description' => 'Possibilité de gérer la liste des utilisateurs (création, mise à jour, suppression).',
        ],

        'roles' => [
            'display_name' => 'Administrer les rôles',
            'description' => 'Possibilité de gérer la liste des rôles (création, mise à jour, suppression).',
        ],

        'metas' => [
            'display_name' => 'Administrer les metas',
            'description' => 'Possibilité de gérer la liste des metas (création, mise à jour, suppression).',
        ],

        'redirections' => [
            'display_name' => 'Administrer les redirections',
            'description' => 'Possibilité de gérer la liste des redirections (création, mise à jour, suppression).',
        ],

        'posts' => [
            'display_name' => 'Administrer les articles',
            'description' => 'Possibilité de gérer l\'ensemble des articles (création, mise à jour, suppression).',
        ],

        'own' => [
            'posts' => [
                'display_name' => 'Gérer ses propres articles',
                'description' => 'Possibilité de gérer ses propres articles (création, mise à jour, suppression).',
            ],
        ],
    ],

    'impersonate' => [
        'display_name' => 'Usurpation d\'utilisateur',
        'description' => 'Permet de prendre l\'identité d\'un autre utilisateur. Utile pour les tests.',
    ],
];
