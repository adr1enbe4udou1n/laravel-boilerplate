<?php
/**
 * @author Andrey "Limych" Khrolenok <andrey@khrolenok.ru>
 */

return [
    'categories' => [
        'blog'   => 'Блог',
        'form'   => 'Формы',
        'access' => 'Доступ',
        'seo'    => 'SEO',
    ],

    'access' => [
        'backend' => [
            'display_name' => 'Доступ к бэк-офису',
            'description'  => 'Доступ к страницам администрирования.',
        ],
    ],

    'view' => [
        'form_settings' => [
            'display_name' => 'Просмотр настроек формы',
            'description'  => 'Можно просматривать настройки формы.',
        ],

        'form_submissions' => [
            'display_name' => 'Просмотр заполнений форм',
            'description'  => 'Пожно просматривать данные заполнения форм.',
        ],

        'users' => [
            'display_name' => 'Просмотр пользователей',
            'description'  => 'Можно видеть список пользователей.',
        ],

        'roles' => [
            'display_name' => 'Просмотр ролей',
            'description'  => 'Можно видеть список ролей.',
        ],

        'metas' => [
            'display_name' => 'Просмотр метаданных',
            'description'  => 'Можно видеть метаданные.',
        ],

        'redirections' => [
            'display_name' => 'Просмотр перенаправлений',
            'description'  => 'Можно видеть список перенаправлений.',
        ],

        'posts' => [
            'display_name' => 'Просмотр всех статей',
            'description'  => 'Можно видеть все статьи.',
        ],

        'own' => [
            'posts' => [
                'display_name' => 'Просмотр своих статей',
                'description'  => 'Можно видеть свои статьи.',
            ],
        ],
    ],

    'create' => [
        'form_settings' => [
            'display_name' => 'Создание форм',
            'description'  => 'Можно создавать новые формы.',
        ],

        'users' => [
            'display_name' => 'Создание пользователей',
            'description'  => 'Можно создавать новых пользователей.',
        ],

        'roles' => [
            'display_name' => 'Создание ролей',
            'description'  => 'Можно создавать новые роли.',
        ],

        'metas' => [
            'display_name' => 'Создание метаданных',
            'description'  => 'Можно создавать новые метаданные.',
        ],

        'redirections' => [
            'display_name' => 'Создание перенеправлений',
            'description'  => 'Можно создавать новые перенаправления.',
        ],

        'posts' => [
            'display_name' => 'Создание статей',
            'description'  => 'Можно создавать новые статьи.',
        ],
    ],

    'edit' => [
        'form_settings' => [
            'display_name' => 'Правка форм',
            'description'  => 'Можно изменять данные форм.',
        ],

        'users' => [
            'display_name' => 'Правка пользователей',
            'description'  => 'Можно изменять данные пользователей.',
        ],

        'roles' => [
            'display_name' => 'Правка ролей',
            'description'  => 'Можно изменять данные ролей.',
        ],

        'metas' => [
            'display_name' => 'Правка метаданных',
            'description'  => 'Можно изменять данные метаданных.',
        ],

        'redirections' => [
            'display_name' => 'Правка перенаправлений',
            'description'  => 'Можно изменять данные перенаправлений.',
        ],

        'posts' => [
            'display_name' => 'Правка всех статей',
            'description'  => 'Можно изменять данные всех статей.',
        ],

        'own' => [
            'posts' => [
                'display_name' => 'Правка своих статей',
                'description'  => 'Можно изменять данные своих статей.',
            ],
        ],
    ],

    'delete' => [
        'form_settings' => [
            'display_name' => 'Удаление форм',
            'description'  => 'Можно удалять формы.',
        ],

        'form_submissions' => [
            'display_name' => 'Удаление заполнений форм',
            'description'  => 'Можно удалять данные заполнения форм.',
        ],

        'users' => [
            'display_name' => 'Удаление пользователей',
            'description'  => 'Можно удалять пользователей.',
        ],

        'roles' => [
            'display_name' => 'Удаление ролей',
            'description'  => 'Можно удалять роли.',
        ],

        'metas' => [
            'display_name' => 'Удаление метаданных',
            'description'  => 'Можно удалять метаданные.',
        ],

        'redirections' => [
            'display_name' => 'Удаление перенаправлений',
            'description'  => 'Можно удалять перенаправления.',
        ],

        'posts' => [
            'display_name' => 'Удаление всех статьи',
            'description'  => 'Можно удалять все статьи.',
        ],

        'own' => [
            'posts' => [
                'display_name' => 'Удаление своих статей',
                'description'  => 'Можно удалять свои статьи.',
            ],
        ],
    ],

    'publish' => [
        'posts' => [
            'display_name' => 'Публикация статей',
            'description'  => 'Можно управлять публикацией статей.',
        ],
    ],

    'impersonate' => [
        'display_name' => 'Войти под видом пользователя',
        'description'  => 'Можно войти под видом другого пользователя. Полезно для тестирования.',
    ],
];
