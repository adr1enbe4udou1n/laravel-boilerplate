<?php
/**
 * @author Andrey "Limych" Khrolenok <andrey@khrolenok.ru>
 */

return [
    'language'            => 'Язык',
    'actions'             => 'Действия',
    'general'             => 'Основные',
    'no_results'          => 'Нет доступных результатов',
    'search'              => 'Искать',
    'validate'            => 'Validate',
    'choose_file'         => 'Выберите файл',
    'no_file_chosen'      => 'Файл не выбран',
    'are_you_sure'        => 'Вы уверены?',
    'delete_image'        => 'Удалить изображение',
    'yes'                 => 'Да',
    'no'                  => 'Нет',
    'add_new'             => 'Добавить',
    'export'              => 'Экспорт',
    'more_info'           => 'Больше информации',
    'author'              => 'Автор',
    'author_id'           => 'ID автора',
    'last_access_at'      => 'Последний доступ',
    'published_at'        => 'Опубликовано',
    'created_at'          => 'Создано',
    'updated_at'          => 'Обновлено',
    'deleted_at'          => 'Удалено',
    'no_value'            => 'Нет значения',
    'upload_image'        => 'Загрузить изображение',
    'anonymous'           => 'Аноним',
    'all_rights_reserved' => 'Все права зарезервированы.',
    'with'                => 'с',
    'by'                  => '',

    'datatables' => [
        'no_results'         => 'No results available',
        'no_matched_results' => 'No matched results available',
        'show_per_page'      => 'Показать',
        'entries_per_page'   => 'записей на страницу',
        'search'             => 'Искать',
        'infos'              => 'Showing :offset_start to :offset_end of :total entries',
    ],

    'morphs' => [
        'post' => 'Post, identity :id',
        'user' => 'User, identity :id',
    ],

    'auth' => [
        'disabled' => 'Ваш аккаунт заблокирован.',
    ],

    'http' => [
        '403' => [
            'title'       => 'Доступ запрещён',
            'description' => 'Извините, но у вас нет прав доступа к этой странице.',
        ],
        '404' => [
            'title'       => 'Ресурс не найден',
            'description' => 'Извините, но этого ресурса не существует.',
        ],
        '500' => [
            'title'       => 'Ошибка сервера',
            'description' => 'Извините, но сервер столкнулся с ситуацией, которую он не может обработать. Мы исправим это как можно скорее.',
        ],
    ],

    'localization' => [
        'en' => 'Английский',
        'ru' => 'Русский',
        'fr' => 'Французский',
        'es' => 'Испанский',
        'de' => 'Немецкий',
        'zh' => 'Китайский',
        'ar' => 'Арабский',
        'pt' => 'Португальский',
    ],

    'placeholders' => [
        'route' => 'Выберите правильный внутренний маршрут',
        'tags'  => 'Выберите или создайте метку',
    ],

    'cookieconsent' => [
        'message' => 'На этом сайте используются файлы cookie, чтобы вам было комфортнее им пользоваться.',
        'dismiss' => 'Понятно!',
    ],

    'descriptions' => [
        'allowed_image_types' => 'ДОступные типы: PNG GIF Jpg Jpeg.',
    ],

    'user' => [
        'dashboard'                 => 'Панель управления',
        'remember'                  => 'Запомнить',
        'login'                     => 'Вход',
        'logout'                    => 'Выход',
        'password_forgot'           => 'Забыли пароль?',
        'send_password_link'        => 'Отправить ссылку сброса пароля',
        'password_reset'            => 'Сброс пароля',
        'register'                  => 'Регистрация',
        'space'                     => 'Моё пространство',
        'settings'                  => 'Настройки',
        'account'                   => 'Мой аккаунт',
        'profile'                   => 'Мой профиль',
        'avatar'                    => 'Аватар',
        'online'                    => 'В&nbsp;сети',
        'edit_profile'              => 'Изменить мой профиль',
        'change_password'           => 'Изменить мой пароль',
        'delete'                    => 'Удалить мой аккаунт',
        'administration'            => 'Администрирование',
        'member_since'              => 'Member since :date',
        'profile_updated'           => 'Профиль успешно изменён.',
        'password_updated'          => 'Пароль успешно изменён.',
        'super_admin'               => 'Супер-администратор',

        'account_delete'  => '<p>Это действие полностью удалит вашу учетную запись с этого сайта, а также все связанные данные.</p>',
        'account_deleted' => 'Аккаунт успешно удалён',

        'titles' => [
            'space'   => 'Моё пространство',
            'account' => 'Мой аккаунт',
        ],
    ],

    'alerts' => [
        'login_as'      => 'Вы вошли как <strong>:name</strong>, вы можете обратно войти как <a href=":route" data-turbolinks="false">:admin</a>.',
    ],

    'backend' => [
        'dashboard' => [
            'new_posts'            => 'Новые статьи',
            'pending_posts'        => 'Ожидающие статьи',
            'published_posts'      => 'Опубликованные статьи',
            'active_users'         => 'Активные пользователи',
            'form_submissions'     => 'Submissions',
            'last_posts'           => 'Last posts',
            'last_published_posts' => 'Last publications',
            'last_pending_posts'   => 'Last pending posts',
            'last_new_posts'       => 'Last new posts',
            'all_posts'            => 'All posts',
        ],

        'new_menu' => [
            'post'         => 'New post',
            'form_setting' => 'New form setting',
            'user'         => 'New user',
            'role'         => 'New role',
            'meta'         => 'New meta',
            'redirection'  => 'New redirection',
        ],

        'sidebar' => [
            'content' => 'Content management',
            'forms'   => 'Form management',
            'access'  => 'Access management',
            'seo'     => 'SEO settings',
        ],

        'titles' => [
            'dashboard' => 'Dashboard',
        ],

        'users' => [
            'titles' => [
                'main'   => 'User',
                'index'  => 'User list',
                'create' => 'User creation',
                'edit'   => 'User modification',
            ],

            'actions' => [
                'destroy' => 'Delete selected users',
                'enable'  => 'Enable selected users',
                'disable' => 'Disable selected users',
            ],
        ],

        'roles' => [
            'titles' => [
                'main'   => 'Role',
                'index'  => 'Role list',
                'create' => 'Role creation',
                'edit'   => 'Role modification',
            ],
        ],

        'metas' => [
            'titles' => [
                'main'   => 'Meta',
                'index'  => 'Meta list',
                'create' => 'Meta creation',
                'edit'   => 'Meta modification',
            ],

            'actions' => [
                'destroy' => 'Delete selected metas',
            ],
        ],

        'form_submissions' => [
            'titles' => [
                'main'  => 'Submission',
                'index' => 'Submission list',
                'show'  => 'Submission detail',
            ],

            'actions' => [
                'destroy' => 'Delete selected submissions',
            ],
        ],

        'form_settings' => [
            'titles' => [
                'main'   => 'Forms',
                'index'  => 'Form setting list',
                'create' => 'Form setting creation',
                'edit'   => 'Form setting modification',
            ],

            'descriptions' => [
                'recipients' => 'Example: \'webmaster@example.com\' or \'sales@example.com,support@example.com\' . To specify multiple recipients, separate each email address with a comma.',
                'message'    => 'The message to display to the user after submission of this form. Leave blank for no message.',
            ],
        ],

        'redirections' => [
            'titles' => [
                'main'   => 'Redirection',
                'index'  => 'Redirection list',
                'create' => 'Redirection creation',
                'edit'   => 'Redirection modification',
            ],

            'actions' => [
                'destroy' => 'Delete selected redirections',
                'enable'  => 'Enable selected redirections',
                'disable' => 'Disable selected redirections',
            ],

            'types' => [
                'permanent' => 'Permanent redirect (301)',
                'temporary' => 'Temporary redirect (302)',
            ],

            'import' => [
                'title'       => 'CSV file import',
                'label'       => 'Select CSV file to import',
                'description' => 'File must have 2 columns with "source" and "target" as heading, redirection will be permanent by default',
            ],
        ],

        'posts' => [
            'statuses' => [
                'draft'     => 'Draft',
                'pending'   => 'Pending',
                'published' => 'Published',
            ],

            'titles' => [
                'main'        => 'Posts',
                'index'       => 'Post list',
                'create'      => 'Create post',
                'edit'        => 'Edit post',
                'publication' => 'Publication options',
            ],

            'descriptions' => [
                'meta_title'       => 'If leave empty, title will be that of article\' title by default.',
                'meta_description' => 'If leave empty, description will be that of article\'s summary by default.',
            ],

            'placeholders' => [
                'body'             => 'Write your content...',
                'meta_title'       => 'Article\'s title.',
                'meta_description' => 'Article\'s summary.',
            ],

            'actions' => [
                'destroy' => 'Delete selected posts',
                'publish' => 'Publish selected posts',
                'pin'     => 'Pin selected posts',
                'promote' => 'Promote selected posts',
            ],
        ],
    ],

    'frontend' => [
        'titles' => [
            'home'           => 'Home',
            'about'          => 'About',
            'contact'        => 'Contact',
            'blog'           => 'Blog',
            'message_sent'   => 'Message sent',
            'legal_mentions' => 'Legal mentions',
            'administration' => 'Administration',
        ],

        'submissions' => [
            'message_sent' => '<p>Your message has been successfully sent</p>',
        ],

        'placeholders' => [
            'locale'   => 'Select your language',
            'timezone' => 'Select your timezone',
        ],

        'blog' => [
            'published_at'                     => 'Published at :date',
            'published_at_with_owner_linkable' => 'Published at :date by <a href=":link">:name</a>',
            'tags'                             => 'Tags',
        ],
    ],
];
