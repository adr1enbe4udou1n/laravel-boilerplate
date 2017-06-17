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
    'last_access_at' => 'Dernier accès le',
    'created_at' => 'Créé le',
    'updated_at' => 'Modifié le',
    'deleted_at' => 'Supprimé le',
    'no_value' => 'Aucune valeur',
    'all_rights_reserved' => 'Tous droits réservés.',

    'auth' => [
        'disabled' => 'Votre compte a été désactivé.'
    ],

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

    'localization' => [
        'en' => 'Anglais',
        'fr' => 'Français',
    ],

    'placeholder' => [
        'route' => 'Sélectionner une route interne valide',
    ],

    'cookieconsent' => [
        'message' => 'En poursuivant votre navigation sur ce site, vous acceptez l’utilisation de Cookies afin de réaliser des statistiques de visites.',
        'dismiss' => 'J\'ai compris !',
    ],

    'descriptions' => [
        'metas' => [
            'route' => 'La valeur doit correspondre à un nom de route valide',
        ],

        'form_settings' => [
            'recipients' => 'Exemple: \'webmaster@example.com\' or \'sales@example.com,support@example.com\' . Pour déclarer des destinataires multiples, séparer chaque adresse par une virgule.',
            'message' => 'Le message à afficher après la soumission de ce formulaire. Laissez vide pour n\'afficher aucun message.',
        ],
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
        'avatar' => 'Avatar',
        'online' => 'En ligne',
        'edit_profile' => 'Mettre à jour mon profil',
        'change_password' => 'Changer mon mot de passe',
        'delete' => 'Supprimer mon compte',
        'administration' => 'Administration',
        'member_since' => 'Membre depuis le :date',
        'profile_updated' => 'Profil modifié avec succès.',
        'password_updated' => 'Mot de passe modifié avec succès.',
        'email_confirmation_sended' => 'Mail de confirmation envoyé.',
        'email_confirmed' => 'Email confirmé avec succès.',
        'super_admin' => 'Super admin',

        'account_delete' => '<p>Cette action supprimera définitivement votre compte de ce site ainsi que toutes vos données associées.</p>',
        'account_deleted' => 'Compte supprimé avec succès',

        'titles' => [
            'space' => 'Mon espace',
            'account' => 'Mon compte',
        ],
    ],

    'alerts' => [
        'login_as' => 'Vous êtes actuellement connecté en tant que <strong>:name</strong>, vous pouvez à tout moment vous reconnecter en tant que <a href=":route">:admin</a>.',
        'not_confirmed' => 'Votre compte sera en mode limité tant que votre email ne sera pas confirmé. <a href=":route">Cliquez ici</a> pour relancer l\'envoie du mail de confirmation.',
    ],

    'backend' => [
        'sidebar' => [
            'forms' => 'Gestion des formulaires',
            'access' => 'Gestion des accès',
            'seo' => 'Paramétrages SEO',
        ],

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

            'actions' => [
                'destroy' => 'Supprimer les utilisateurs sélectionnés',
                'enable' => 'Activer les utilisateurs sélectionnés',
                'disable' => 'Désactiver les utilisateurs sélectionnés',
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

        'metas' => [
            'titles' => [
                'main' => 'Gestion des metas',
                'index' => 'Liste des metas',
                'create' => 'Créer une meta',
                'edit' => 'Editer une meta',
            ],

            'actions' => [
                'destroy' => 'Supprimer les metas sélectionnés',
            ],
        ],

        'form_submissions' => [
            'titles' => [
                'main' => 'Gestion des soumissions',
                'index' => 'Liste des soumissions',
                'show' => 'Détail de la soumission',
            ],

            'actions' => [
                'destroy' => 'Supprimer les soumissions sélectionnées',
            ],
        ],

        'form_settings' => [
            'titles' => [
                'main' => 'Paramètres de formulaire',
                'index' => 'Liste des paramètres de formulaire',
                'create' => 'Création d\'un paramètre de formulaire',
                'edit' => 'Edition d\'un paramètre de formulaire',
            ],
        ],

        'redirections' => [
            'titles' => [
                'main' => 'Gestion des redirections',
                'index' => 'Liste des redirections',
                'create' => 'Création d\'une redirection',
                'edit' => 'Modification d\'une redirection',
            ],

            'actions' => [
                'destroy' => 'Supprimer les redirections sélectionnées',
                'enable' => 'Activer les redirections sélectionnées',
                'disable' => 'Désactiver les redirections sélectionnées',
            ],

            'types' => [
                'permanent' => 'Redirection permanente (301)',
                'temporary' => 'Redirection temporaire (302)',
            ],

            'import' => [
                'title' => 'Import de fichier CSV/Excel',
                'label' => 'Sélectionner un fichier CSV/Excel à importer',
                'description' => 'Le fichier doit avoir 2 colonnes avec en-têtes de colonne "source" et "target", la redirection sera du type permanent par défaut',
            ],
        ],
    ],

    'frontend' => [
        'titles' => [
            'home' => 'Accueil',
            'about' => 'Qui sommes-nous ?',
            'contact' => 'Contact',
            'message_sent' => 'Message envoyé',
            'legal_mentions' => 'Mention légales',
        ],

        'submissions' => [
            'message_sent' => '<p>Votre demande de contact a bien été envoyée</p>',
        ],

        'placeholders' => [
            'locale' => 'Sélectionnez votre langue',
            'timezone' => 'Sélectionnez votre fuseau horaire',
        ],
    ],
];
