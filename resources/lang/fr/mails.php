<?php

return [
    'layout' => [
        'hello'               => 'Bonjour !',
        'regards'             => 'Cordialement',
        'trouble'             => 'Si vous rencontrer un problème en cliquant sur le bouton :action, copier et coller l\'URL suivante dans votre navigateur :',
        'all_rights_reserved' => 'Tous droits réservés.',
    ],
    'password_reset' => [
        'subject' => 'Réinitialisation de mon mot de passe',
        'intro'   => 'Vous recevez cet email car vous avez effectué une demande de réinitialisation de mot de passe.',
        'action'  => 'Réinitialiser le mot de passe',
        'outro'   => 'Si vous n\'avez pas fait cette demande de réinitialisation, aucune action n\'est requise.',
    ],
    'email_confirmation' => [
        'subject' => 'Confirmation de mon email',
        'intro'   => 'La confirmation de votre email est requise pour débrider votre compte.',
        'action'  => 'Confirmer mon email',
        'outro'   => 'Votre compte sera limité tant que votre email ne sera pas confirmé.',
    ],
    'contact' => [
        'subject'     => 'Nouveau message de contact',
        'new_contact' => 'Vous avez reçu un nouveau message de contact. Détail de la soumission :',
    ],
    'alert' => [
        'subject' => '[:app_name] Exception error',
        'message' => 'Une exception serveur non prévue a été levée dont le message est : :message.',
        'trace'   => 'Trace complète :',
    ],
];
