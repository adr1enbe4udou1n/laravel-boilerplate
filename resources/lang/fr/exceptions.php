<?php

return [
    'general'      => 'Erreur serveur',
    'unauthorized' => 'Action non autorisée',

    'backend' => [
        'users' => [
            'create'                            => 'Erreur lors de la création de l\'utilisateur',
            'update'                            => 'Erreur lors de la mise à jour de l\'utilisateur',
            'delete'                            => 'Erreur lors de la suppression de l\'utilisateur',
            'first_user_cannot_be_edited'       => 'Vous ne pouvez pas éditer l\'utilisateur super admin',
            'first_user_cannot_be_disabled'     => 'L\'utilisateur super admin ne peut pas être désactivé',
            'first_user_cannot_be_destroyed'    => 'L\'utilisateur super admin ne peut pas être supprimé',
            'first_user_cannot_be_impersonated' => 'L\'utilisateur super admin ne peut pas être usurpé',
            'cannot_set_superior_roles'         => 'Vous ne pouvez pas attribuer de rôle supérieur au vôtre',
        ],

        'roles' => [
            'create' => 'Erreur lors de la création du rôle',
            'update' => 'Erreur lors de la mise à jour du rôle',
            'delete' => 'Erreur lors de la suppression du rôle',
        ],

        'metas' => [
            'create'        => 'Erreur lors de la création de la meta',
            'update'        => 'Erreur lors de la mise à jour de la meta',
            'delete'        => 'Erreur lors de la suppression de la meta',
            'already_exist' => 'Il existe déjà une meta pour cette route',
        ],

        'form_submissions' => [
            'create' => 'Erreur lors de la création de la soumission',
            'delete' => 'Erreur lors de la suppression de la soumission',
        ],

        'form_settings' => [
            'create'        => 'Erreur lors de la création du paramètre de formulaire',
            'update'        => 'Erreur lors de la mise à jour du paramètre de formulaire',
            'delete'        => 'Erreur lors de la suppression du paramètre de formulaire',
            'already_exist' => 'Il existe déjà un paramétrage pour ce formulaire',
        ],

        'redirections' => [
            'create'        => 'Erreur lors de la création de la redirection',
            'update'        => 'Erreur lors de la mise à jour de la redirection',
            'delete'        => 'Erreur lors de la suppression de la redirection',
            'already_exist' => 'Il existe déjà une redirection pour ce chemin',
        ],

        'posts' => [
            'create' => 'Erreur lors de la création de l\'article',
            'update' => 'Erreur lors de la mise à jour de l\'article',
            'save'   => 'Erreur lors de l\'enregistrement de l\'article',
            'delete' => 'Erreur lors de la suppression de l\'article',
        ],
    ],

    'frontend' => [
        'user' => [
            'email_taken'       => 'Cet email est déjà utilisé par un compte existant.',
            'password_mismatch' => 'L\'ancien mot de passe est incorrect.',
            'delete_account'    => 'Erreur lors de la suppression de votre compte.',
            'updating_disabled' => 'La modification de compte est désactivée.',
        ],

        'auth' => [
            'registration_disabled' => 'L\'enregistrement d\'utilisateurs est désactivé.',
        ],
    ],
];
