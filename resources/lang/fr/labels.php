<?php

return [
    'backend' => [
        'login-as' => 'Vous êtes actuellement connecté en tant que <strong>:name</strong>, vous pouvez à tout moment vous reconnecter en tant que <a href=":route">:admin</a>.',

        'titles' => [
            'dashboard' => 'Tableau de bord',
        ],

        'users' => [
            'titles' => [
                'main' => 'Gestion des utilisateurs',
                'index' => 'Liste des utilisateurs',
                'create' => 'Créer un utilisateur',
                'edit' => 'Editer un utilisateur',
            ],

            'tables' => [
                'name' => 'Nom utilisateur',
                'email' => 'Email',
                'active' => 'Actif',
                'password' => 'Mot de passe',
                'role' => 'Rôle'
            ]
        ]
    ],

    'frontend' => [

    ],

    'general' => [
        'actions' => 'Actions',
        'no_results' => 'Aucune donnée disponible dans le tableau',
        'are_you_sure' => 'Etes-vous sûr ?',
        'yes' => 'Oui',
        'no' => 'Non',
        'more_info' => 'Plus d\'info',
        'created_at' => 'Date création',
        'updated_at' => 'Date modification',
        'deleted_at' => 'Date suppression',
        'profile' => 'Profil',
        'logout' => 'Déconnexion',
        'member_since' => 'Membre depuis le :date',
        'password_confirm' => 'Confirmer le mot de passe',
    ]
];
