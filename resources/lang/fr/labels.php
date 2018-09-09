<?php

return [
    'language'            => 'Langue',
    'actions'             => 'Actions',
    'general'             => 'Général',
    'no_results'          => 'Aucun résultat trouvé',
    'search'              => 'Rechercher',
    'validate'            => 'Valider',
    'choose_file'         => 'Sélectionner un fichier',
    'no_file_chosen'      => 'Aucun fichier sélectionné',
    'are_you_sure'        => 'Etes-vous sûr ?',
    'delete_image'        => 'Supprimer l\'image',
    'yes'                 => 'Oui',
    'no'                  => 'Non',
    'add_new'             => 'Ajouter',
    'export'              => 'Exporter',
    'more_info'           => 'Plus d\'info',
    'last_access_at'      => 'Dernier accès le',
    'author'              => 'Auteur',
    'author_id'           => 'ID Auteur',
    'published_at'        => 'Publié le',
    'created_at'          => 'Créé le',
    'updated_at'          => 'Modifié le',
    'deleted_at'          => 'Supprimé le',
    'no_value'            => 'Aucune valeur',
    'upload_image'        => 'Transférer une image',
    'anonymous'           => 'Anonyme',
    'all_rights_reserved' => 'Tous droits réservés.',
    'with'                => 'avec',
    'by'                  => 'par',

    'datatables' => [
        'no_results'         => 'Aucun résultat trouvé',
        'no_matched_results' => 'Aucun résultat correspondant à votre recherche',
        'show_per_page'      => 'Afficher',
        'entries_per_page'   => 'éléments par page',
        'search'             => 'Rechercher',
        'infos'              => 'Affichage de l\'élément :offset_start à :offset_end sur :total éléments',
    ],

    'morphs' => [
        'post' => 'Article, identifiant :id',
        'user' => 'Utilisateur, identifiant :id',
    ],

    'auth' => [
        'disabled' => 'Votre compte a été désactivé.',
    ],

    'http' => [
        '403' => [
            'title'       => 'Accès non autorisé',
            'description' => 'Désolé, mais vous n\'avez pas les permissions pour accéder à cette page.',
        ],
        '404' => [
            'title'       => 'Page introuvable',
            'description' => 'Désolé, mais la page à laquelle vous tentez d\'accéder n\'existe pas.',
        ],
        '500' => [
            'title'       => 'Erreur serveur',
            'description' => 'Désolé, mais le serveur a rencontré une erreur non prévue. Nous la fixerons dès que possible.',
        ],
    ],

    'localization' => [
        'en' => 'Anglais',
        'fr' => 'Français',
    ],

    'placeholders' => [
        'route' => 'Sélectionner une route interne valide',
        'tags'  => 'Sélectionner ou créer une étiquette',
    ],

    'cookieconsent' => [
        'message' => 'En poursuivant votre navigation sur ce site, vous acceptez l’utilisation de Cookies afin de réaliser des statistiques de visites.',
        'dismiss' => 'J\'ai compris !',
    ],

    'descriptions' => [
        'allowed_image_types' => 'Extensions autorisés: png gif jpg jpeg.',
    ],

    'user' => [
        'dashboard'                 => 'Tableau de bord',
        'remember'                  => 'Se souvenir',
        'login'                     => 'Connexion',
        'logout'                    => 'Déconnexion',
        'password_forgot'           => 'Mot de passe oublié ?',
        'send_password_link'        => 'Envoyer le mot de passe de réinitialisation',
        'password_reset'            => 'Réinitialisation du mot de passe',
        'register'                  => 'S\'inscrire',
        'space'                     => 'Mon espace',
        'settings'                  => 'Paramètres',
        'account'                   => 'Mon compte',
        'profile'                   => 'Mon profil',
        'avatar'                    => 'Avatar',
        'online'                    => 'En ligne',
        'edit_profile'              => 'Mettre à jour mon profil',
        'change_password'           => 'Changer mon mot de passe',
        'delete'                    => 'Supprimer mon compte',
        'administration'            => 'Administration',
        'member_since'              => 'Membre depuis le :date',
        'profile_updated'           => 'Profil modifié avec succès.',
        'password_updated'          => 'Mot de passe modifié avec succès.',
        'super_admin'               => 'Super admin',

        'account_delete'  => '<p>Cette action supprimera définitivement votre compte de ce site ainsi que toutes vos données associées.</p>',
        'account_deleted' => 'Compte supprimé avec succès',

        'titles' => [
            'space'   => 'Mon espace',
            'account' => 'Mon compte',
        ],
    ],

    'alerts' => [
        'login_as'      => 'Vous êtes actuellement connecté en tant que <strong>:name</strong>, vous pouvez à tout moment vous reconnecter en tant que <a href=":route" data-turbolinks="false">:admin</a>.',
    ],

    'backend' => [
        'dashboard' => [
            'new_posts'            => 'Nouveaux articles',
            'pending_posts'        => 'Articles en attente de publication',
            'published_posts'      => 'Articles publiés',
            'active_users'         => 'Utilisateurs actifs',
            'form_submissions'     => 'Soumissions',
            'last_posts'           => 'Dernier articles',
            'last_published_posts' => 'Dernières publications',
            'last_pending_posts'   => 'Derniers articles en attente de publication',
            'last_new_posts'       => 'Derniers nouveaux articles',
            'all_posts'            => 'Voir tous les articles',
        ],

        'new_menu' => [
            'post'         => 'Nouvel article',
            'form_setting' => 'Nouveau paramétrage de formulaire',
            'user'         => 'Nouvel utilisateur',
            'role'         => 'Nouveau rôle',
            'meta'         => 'Nouvelle meta',
            'redirection'  => 'Nouvelle redirection',
        ],

        'sidebar' => [
            'content' => 'Gestion de contenu',
            'forms'   => 'Gestion des formulaires',
            'access'  => 'Gestion des accès',
            'seo'     => 'Paramétrages SEO',
        ],

        'titles' => [
            'dashboard' => 'Tableau de bord',
        ],

        'users' => [
            'titles' => [
                'main'   => 'Utilisateurs',
                'index'  => 'Liste des utilisateurs',
                'create' => 'Créer un utilisateur',
                'edit'   => 'Editer un utilisateur',
            ],

            'actions' => [
                'destroy' => 'Supprimer les utilisateurs sélectionnés',
                'enable'  => 'Activer les utilisateurs sélectionnés',
                'disable' => 'Désactiver les utilisateurs sélectionnés',
            ],
        ],

        'roles' => [
            'titles' => [
                'main'   => 'Rôles',
                'index'  => 'Liste des rôles',
                'create' => 'Créer un rôle',
                'edit'   => 'Editer un rôle',
            ],
        ],

        'metas' => [
            'titles' => [
                'main'   => 'Metas',
                'index'  => 'Liste des metas',
                'create' => 'Créer une meta',
                'edit'   => 'Editer une meta',
            ],

            'actions' => [
                'destroy' => 'Supprimer les metas sélectionnés',
            ],
        ],

        'form_submissions' => [
            'titles' => [
                'main'  => 'Soumissions',
                'index' => 'Liste des soumissions',
                'show'  => 'Détail de la soumission',
            ],

            'actions' => [
                'destroy' => 'Supprimer les soumissions sélectionnées',
            ],
        ],

        'form_settings' => [
            'titles' => [
                'main'   => 'Formulaires',
                'index'  => 'Liste des paramètres de formulaire',
                'create' => 'Création d\'un paramètre de formulaire',
                'edit'   => 'Edition d\'un paramètre de formulaire',
            ],

            'descriptions' => [
                'recipients' => 'Exemple: \'webmaster@example.com\' or \'sales@example.com,support@example.com\' . Pour déclarer des destinataires multiples, séparer chaque adresse par une virgule.',
                'message'    => 'Le message à afficher après la soumission de ce formulaire. Laissez vide pour n\'afficher aucun message.',
            ],
        ],

        'redirections' => [
            'titles' => [
                'main'   => 'Redirections',
                'index'  => 'Liste des redirections',
                'create' => 'Création d\'une redirection',
                'edit'   => 'Modification d\'une redirection',
            ],

            'actions' => [
                'destroy' => 'Supprimer les redirections sélectionnées',
                'enable'  => 'Activer les redirections sélectionnées',
                'disable' => 'Désactiver les redirections sélectionnées',
            ],

            'types' => [
                'permanent' => 'Redirection permanente (301)',
                'temporary' => 'Redirection temporaire (302)',
            ],

            'import' => [
                'title'       => 'Import de fichier CSV',
                'label'       => 'Sélectionner un fichier CSV à importer',
                'description' => 'Le fichier doit avoir 2 colonnes avec en-têtes de colonne "source" et "target", la redirection sera du type permanent par défaut',
            ],
        ],

        'posts' => [
            'statuses' => [
                'draft'     => 'Brouillon',
                'pending'   => 'En attente',
                'published' => 'Publié',
            ],

            'titles' => [
                'main'        => 'Articles',
                'index'       => 'Liste des articles',
                'create'      => 'Créer un article',
                'edit'        => 'Editer un article',
                'publication' => 'Options de publication',
            ],

            'actions' => [
                'destroy' => 'Supprimer les articles sélectionnés',
                'publish' => 'Publier les articles sélectionnés',
                'pin'     => 'Epingler les articles sélectionnés',
                'promote' => 'Mettre en avant les articles sélectionnés',
            ],

            'descriptions' => [
                'meta_title'       => 'Si vide, le titre par défaut sera celui de l\'article.',
                'meta_description' => 'Si vide, la description par défaut sera le résumé de l\'article.',
            ],

            'placeholders' => [
                'body'             => 'Saisissez votre contenu...',
                'meta_title'       => 'Titre de l\'article.',
                'meta_description' => 'Résumé de l\'article.',
            ],
        ],
    ],

    'frontend' => [
        'titles' => [
            'home'           => 'Accueil',
            'about'          => 'Qui sommes-nous ?',
            'contact'        => 'Contact',
            'blog'           => 'Blog',
            'message_sent'   => 'Message envoyé',
            'legal_mentions' => 'Mention légales',
            'administration' => 'Administration',
        ],

        'submissions' => [
            'message_sent' => '<p>Votre demande de contact a bien été envoyée</p>',
        ],

        'placeholders' => [
            'locale'   => 'Sélectionnez votre langue',
            'timezone' => 'Sélectionnez votre fuseau horaire',
        ],

        'blog' => [
            'published_at'                     => 'Publié le :date',
            'published_at_with_owner_linkable' => 'Publié le :date par <a href=":link">:name</a>',
            'tags'                             => 'Tags',
        ],
    ],
];
