<?php

return [
    'language' => 'Langue',
    'actions' => 'Actions',
    'general' => 'Général',
    'no_results' => 'Aucune donnée disponible dans le tableau',
    'are_you_sure' => 'Etes-vous sûr ?',
    'yes' => 'Oui',
    'no' => 'Non',
    'more_info' => 'Plus d\'info',
    'created_at' => 'Créé le',
    'updated_at' => 'Modifié le',
    'deleted_at' => 'Supprimé le',
    'all_rights_reserved' => 'Tous droits réservés.',

    'http' => [
        '403' => [
            'title' => 'Accès non autorisé',
            'description' => 'Désolé, mais vous n\'avez pas les permissions pour accéder à cette page.',
        ],
        '404' => [
            'title' => 'Page introuvable',
            'description' => 'Désolé, mais la page à laquelle vous tentez d\'accéder n\'existe pas.',
        ],
        '500' => [
            'title' => 'Erreur serveur',
            'description' => 'Désolé, mais le serveur a rencontré une erreur non prévue. Nous la fixerons dès que possible.',
        ],
    ],

    'cookieconsent' => [
        'message' => 'En poursuivant votre navigation sur ce site, vous acceptez l’utilisation de Cookies afin de réaliser des statistiques de visites.',
        'dismiss' => 'J\'ai compris !',
    ],

    'user' => [
        'dashboard' => 'Tableau de bord',
        'remember' => 'Se souvenir',
        'login' => 'Se connecter',
        'logout' => 'Déconnexion',
        'password_forgot' => 'Mot de passe oublié ?',
        'send_password_link' => 'Envoyer le mot de passe de réinitialisation',
        'password_reset' => 'Réinitialisation du mot de passe',
        'register' => 'S\'inscrire',
        'space' => 'Mon espace',
        'account' => 'Mon compte',
        'profile' => 'Mon profil',
        'edit_profile' => 'Mettre à jour mon profil',
        'change_password' => 'Changer mon mot de passe',
        'administration' => 'Administration',
        'member_since' => 'Membre depuis le :date',
        'profile_updated' => 'Profil modifié avec succès.',
        'password_updated' => 'Mot de passe modifié avec succès.',

        'titles' => [
            'space' => 'Mon espace',
            'account' => 'Mon compte',
        ],

        'attributes' => [
            'name' => 'Nom',
            'email' => 'Email',
            'created_at' => 'Date de création',
            'updated_at' => 'Date de mise à jour',
        ],
    ],

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
        ],

        'roles' => [
            'titles' => [
                'main' => 'Gestion des rôles',
                'index' => 'Liste des rôles',
                'create' => 'Créer un rôle',
                'edit' => 'Editer un rôle',
            ],
        ],
    ],

    'frontend' => [

        'titles' => [
            'home' => 'Accueil',
            'about' => 'Qui sommes-nous ?',
            'contact' => 'Contact',
            'legal_mentions' => 'Mention légales',
        ],
    ],
];
