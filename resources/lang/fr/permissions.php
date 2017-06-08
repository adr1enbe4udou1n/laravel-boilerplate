<?php

return [
    'access' => [
        'backend' => [
            'display_name' => 'Accès au backoffice',
            'description' => 'Permet l\'accès aux pages du backoffice.',
        ],
    ],

    'manage' => [
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
    ],

    'impersonate' => [
        'display_name' => 'Usurpation d\'utilisateur',
        'description' => 'Permet de prendre l\'identité d\'un autre utilisateur. Utile pour les tests.',
    ],
];
