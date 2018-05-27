<?php

return [
    'categories' => [
        'blog'   => 'Blog',
        'form'   => 'Formulaires',
        'access' => 'Accès',
        'seo'    => 'SEO',
    ],

    'access' => [
        'backend' => [
            'display_name' => 'Accès au backoffice',
            'description'  => 'Permet l\'accès aux pages du backoffice.',
        ],
    ],

    'view' => [
        'form_settings' => [
            'display_name' => 'Voir les paramètres de formulaires',
            'description'  => 'Peut voir des paramètres de formulaires.',
        ],

        'form_submissions' => [
            'display_name' => 'Voir les soumissions de formulaire',
            'description'  => 'Peut voir des soumissions de formulaire.',
        ],

        'users' => [
            'display_name' => 'Voir les utilisateurs',
            'description'  => 'Peut voir des utilisateurs.',
        ],

        'roles' => [
            'display_name' => 'Voir les rôles',
            'description'  => 'Peut voir des rôles.',
        ],

        'metas' => [
            'display_name' => 'Voir les metas',
            'description'  => 'Peut voir des metas.',
        ],

        'redirections' => [
            'display_name' => 'Voir les redirections',
            'description'  => 'Peut voir des redirections.',
        ],

        'posts' => [
            'display_name' => 'Voir tous les articles',
            'description'  => 'Peut voir l\'ensemble des articles.',
        ],

        'own' => [
            'posts' => [
                'display_name' => 'Voir ses propres articles',
                'description'  => 'Peut voir ses propres articles.',
            ],
        ],
    ],

    'create' => [
        'form_settings' => [
            'display_name' => 'Créer les paramètres de formulaires',
            'description'  => 'Peut créer des paramètres de formulaires.',
        ],

        'users' => [
            'display_name' => 'Créer les utilisateurs',
            'description'  => 'Peut créer des utilisateurs.',
        ],

        'roles' => [
            'display_name' => 'Créer les rôles',
            'description'  => 'Peut créer des rôles.',
        ],

        'metas' => [
            'display_name' => 'Créer les metas',
            'description'  => 'Peut créer des metas.',
        ],

        'redirections' => [
            'display_name' => 'Créer les redirections',
            'description'  => 'Peut créer des redirections.',
        ],

        'posts' => [
            'display_name' => 'Créer les articles',
            'description'  => 'Peut créer des articles.',
        ],
    ],

    'edit' => [
        'form_settings' => [
            'display_name' => 'Modifier les paramètres de formulaires',
            'description'  => 'Peut modifier des paramètres de formulaires.',
        ],

        'users' => [
            'display_name' => 'Modifier les utilisateurs',
            'description'  => 'Peut modifier des utilisateurs.',
        ],

        'roles' => [
            'display_name' => 'Modifier les rôles',
            'description'  => 'Peut modifier des rôles.',
        ],

        'metas' => [
            'display_name' => 'Modifier les metas',
            'description'  => 'Peut modifier des metas.',
        ],

        'redirections' => [
            'display_name' => 'Modifier les redirections',
            'description'  => 'Peut modifier des redirections.',
        ],

        'posts' => [
            'display_name' => 'Modifier tous les articles',
            'description'  => 'Peut modifier l\'ensemble des articles.',
        ],

        'own' => [
            'posts' => [
                'display_name' => 'Modifier ses propres articles',
                'description'  => 'Peut modifier ses propres articles.',
            ],
        ],
    ],

    'delete' => [
        'form_settings' => [
            'display_name' => 'Supprimer les paramètres de formulaires',
            'description'  => 'Peut supprimer des paramètres de formulaires.',
        ],

        'form_submissions' => [
            'display_name' => 'Supprimer les soumissions de formulaire',
            'description'  => 'Peut supprimer des soumissions de formulaire.',
        ],

        'users' => [
            'display_name' => 'Supprimer les utilisateurs',
            'description'  => 'Peut supprimer des utilisateurs.',
        ],

        'roles' => [
            'display_name' => 'Supprimer les rôles',
            'description'  => 'Peut supprimer des rôles.',
        ],

        'metas' => [
            'display_name' => 'Supprimer les metas',
            'description'  => 'Peut supprimer des metas.',
        ],

        'redirections' => [
            'display_name' => 'Supprimer les redirections',
            'description'  => 'Peut supprimer des redirections.',
        ],

        'posts' => [
            'display_name' => 'Supprimer tous les articles',
            'description'  => 'Peut supprimer l\'ensemble des articles.',
        ],

        'own' => [
            'posts' => [
                'display_name' => 'Supprimer ses propres articles',
                'description'  => 'Peut supprimer ses propres articles.',
            ],
        ],
    ],

    'publish' => [
        'posts' => [
            'display_name' => 'Publier les articles',
            'description'  => 'Possibilité de gérer la publication des articles.',
        ],
    ],

    'impersonate' => [
        'display_name' => 'Usurpation d\'utilisateur',
        'description'  => 'Permet de prendre l\'identité d\'un autre utilisateur. Utile pour les tests.',
    ],
];
