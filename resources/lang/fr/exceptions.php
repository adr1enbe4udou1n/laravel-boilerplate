<?php

return [
    'backend' => [
        'users' => [
            'create' => 'Erreur lors de la création de l\'utilisateur',
            'update' => 'Erreur lors de la mise à jour de l\'utilisateur',
            'delete' => 'Erreur lors de la suppression de l\'utilisateur',
        ],

        'roles' => [
            'create' => 'Erreur lors de la création du rôle',
            'update' => 'Erreur lors de la mise à jour du rôle',
            'delete' => 'Erreur lors de la suppression du rôle',
        ],

        'metas' => [
            'create' => 'Erreur lors de la création de la meta',
            'update' => 'Erreur lors de la mise à jour de la meta',
            'delete' => 'Erreur lors de la suppression de la meta',
            'already_exist' => 'Il existe déjà une meta pour cette route',
        ],

        'form_submissions' => [
            'create' => 'Erreur lors de la création de la soumission',
            'delete' => 'Erreur lors de la suppression de la soumission',
        ],
    ],

    'frontend' => [
        'user' => [
            'email_taken' => 'Cet email est déjà utilisé par un compte existant.',
            'password_mismatch' => 'L\'ancien mot de passe est incorrect.',
        ],
    ],
];
