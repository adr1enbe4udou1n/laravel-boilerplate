<?php

return [
    // Uncomment the languages that your site supports - or add new ones.
    // These are sorted by the native name, which is the order you might show them in a language selector.
    // Regional languages are sorted by their base language, so "British English" sorts as "English, British"
    'supportedLocales' => [
        'en' => [
            'name'         => 'labels.localization.en',
            'script'       => 'Latn',
            'native'       => 'English',
            'regional'     => 'en_US',
            'locale_win'   => 'English_United States.1252',
            'date_formats' => [
                'default' => 'm/d/Y h:i:s A',
            ],
        ],
        'fr' => [
            'name'         => 'labels.localization.fr',
            'script'       => 'Latn',
            'native'       => 'Français',
            'regional'     => 'fr_FR',
            'locale_win'   => 'French_France.1252',
            'date_formats' => [
                'default' => 'd/m/Y H:i:s',
            ],
        ],
        'de' => [
            'name'         => 'labels.localization.de',
            'script'       => 'Latn',
            'native'       => 'Deutsch',
            'regional'     => 'de_DE',
            'locale_win'   => 'German_Germany.1252',
            'date_formats' => [
                'default' => 'd.m.Y H:i:s',
            ],
        ],
        'es' => [
            'name'         => 'labels.localization.es',
            'script'       => 'Latn',
            'native'       => 'Español',
            'regional'     => 'es_ES',
            'locale_win'   => 'Spanish_Spain.1252',
            'date_formats' => [
                'default' => 'j/m/Y H:i:s',
            ],
        ],
        'pt' => [
            'name'         => 'labels.localization.pt',
            'script'       => 'Latn',
            'native'       => 'Português',
            'regional'     => 'pt_PT',
            'locale_win'   => 'Portuguese_Portugal.1252',
            'date_formats' => [
                'default' => 'Y/m/d H:i:s',
            ],
        ],
        'ru' => [
            'name'         => 'labels.localization.ru',
            'script'       => 'Cyrl',
            'native'       => 'Русский',
            'regional'     => 'ru_RU',
            'locale_win'   => 'Russian_Russia.1251',
            'date_formats' => [
                'default' => 'd.m.Y H:i:s',
            ],
        ],
        'ar' => [
            'name'         => 'labels.localization.ar',
            'script'       => 'Arab',
            'native'       => 'عربي',
            'regional'     => 'ar_SA',
            'locale_win'   => 'Arabic_Saudi Arabia.1256',
            'date_formats' => [
                'default' => 'd/m/Y H:i:s',
            ],
            'dir' => 'rtl',
        ],
        'zn' => [
            'name'         => 'labels.localization.zn',
            'script'       => 'Hans',
            'native'       => '中文',
            'regional'     => 'zh_TW',
            'locale_win'   => 'Chinese_Taiwan.950',
            'date_formats' => [
                'default' => 'Y-m-d h:i:s A',
            ],
        ],
    ],

    // Negotiate for the user locale using the Accept-Language header if it's not defined in the URL?
    // If false, system will take app.php locale attribute
    'useAcceptLanguageHeader' => true,

    // If LaravelLocalizationRedirectFilter is active and hideDefaultLocaleInURL
    // is true, the url would not have the default application language
    //
    // IMPORTANT - When hideDefaultLocaleInURL is set to true, the unlocalized root is treated as the applications default locale "app.locale".
    // Because of this language negotiation using the Accept-Language header will NEVER occur when hideDefaultLocaleInURL is true.
    //
    'hideDefaultLocaleInURL' => true,

    // If you want to display the locales in particular order in the language selector you should write the order here.
    //CAUTION: Please consider using the appropriate locale code otherwise it will not work
    //Example: 'localesOrder' => ['es','en'],
    'localesOrder' => [],
];
