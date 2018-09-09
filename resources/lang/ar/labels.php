<?php

return [
    'language'            => 'اللغة',
    'actions'             => 'الإجراءات',
    'general'             => 'عام',
    'no_results'          => 'لا يوجد نتائج',
    'search'              => 'بحث',
    'validate'            => 'تحقق',
    'choose_file'         => 'أختر ملف',
    'no_file_chosen'      => 'لم يتم إختيار ملف',
    'are_you_sure'        => 'هل أنت متأكد ؟',
    'delete_image'        => 'حذف الصورة',
    'yes'                 => 'نعم',
    'no'                  => 'لا',
    'add_new'             => 'إضافة',
    'export'              => 'تصدير',
    'more_info'           => 'المزيد من المعلومات',
    'author'              => 'الكاتب',
    'last_access_at'      => 'أخر وصول في',
    'published_at'        => 'تم النشر بتاريخ',
    'created_at'          => 'تم الإنشاء بتاريخ',
    'updated_at'          => 'تم التعديل بتاريخ',
    'deleted_at'          => 'تم الحذف بتاريخ',
    'no_value'            => 'لا يوجد قيمة',
    'upload_image'        => 'رفع صورة',
    'anonymous'           => 'مجهول',
    'all_rights_reserved' => 'جميع الحقوق محفوظة.',
    'with'                => 'مع',
    'by'                  => 'بواسطة',

    'datatables' => [
        'no_results'         => 'لا يوجد نتائج',
        'no_matched_results' => 'لا يوجد نتائج مطابقة',
        'show_per_page'      => 'إظهار',
        'entries_per_page'   => 'عنصر بالصفحة',
        'search'             => 'بحث',
        'infos'              => 'إظهار :offset_start حتى :offset_end من أصل :total عنصر',
    ],

    'morphs' => [
        'post' => 'مقالة، المعرف :id',
        'user' => 'مستخدم، المعرف :id',
    ],

    'auth' => [
        'disabled' => 'تم إلغاء تفعيل الحساب الخاص بك.',
    ],

    'http' => [
        '403' => [
            'title'       => 'وصول مرفوض',
            'description' => 'عذراً، ليس لديك صلاحية الوصول لهذه الصفحة.',
        ],
        '404' => [
            'title'       => 'الصفحة غير موجودة',
            'description' => 'عذراً، إن الصفحة التي تحاول الوصول لها غير موجودة.',
        ],
        '500' => [
            'title'       => 'خطأ في المخدّم',
            'description' => 'عذراً، حدث خطأ غير متوقع في المخدم. سيتم معالجة المشكلة بالسرعة الممكنة.',
        ],
    ],

    'localization' => [
        'en' => 'إنكليزي',
        'fr' => 'فرنسي',
        'ar' => 'عربي',
    ],

    'placeholders' => [
        'route' => 'يرجى إختيار مسار داخلي صحيح',
        'tags'  => 'إختر أو أنشئ وسماً',
    ],

    'cookieconsent' => [
        'message' => 'يستخدم موقع الويب هذا ملفات تعريف الارتباط لضمان حصولك على أفضل تجربة على موقعنا.',
        'dismiss' => 'تم !',
    ],

    'descriptions' => [
        'allowed_image_types' => 'أنواع الصور المسموحة: png gif jpg jpeg.',
    ],

    'user' => [
        'dashboard'                 => 'لوحة التحكم',
        'remember'                  => 'تذكرني',
        'login'                     => 'تسجيل الدخول',
        'logout'                    => 'تسجيل الخروج',
        'password_forgot'           => 'نسيت كلمة المرور ؟',
        'send_password_link'        => 'إرسال رابط إعادة تعيين كلمة المرور',
        'password_reset'            => 'إعادة تعيين كلمة المرور',
        'register'                  => 'تسجيل',
        'space'                     => 'مساحتي',
        'settings'                  => 'إعدادات',
        'account'                   => 'حسابي',
        'profile'                   => 'ملفي',
        'avatar'                    => 'الصورة الرمزية',
        'online'                    => 'أون لاين',
        'edit_profile'              => 'تعديل ملفي',
        'change_password'           => 'تغير كلمة مروري',
        'delete'                    => 'حذف حسابي',
        'administration'            => 'إدارة',
        'member_since'              => 'عضو منذ :date',
        'profile_updated'           => 'تم تعديل معومات الملف بنجاح.',
        'password_updated'          => 'تم تعديل كلمة المرور بنجاح',
        'super_admin'               => 'مدير بصلاحيات كاملة',

        'account_delete'  => '<p>إن القيام بهذا الإجراء سيؤدي لحذف حسابك بشكل كامل من الموقع مع جميع المعلومات ذات الصلة.</p>',
        'account_deleted' => 'تم حذف الحساب بنجاح',

        'titles' => [
            'space'   => 'مساحتي',
            'account' => 'حسابي',
        ],
    ],

    'alerts' => [
        'login_as'      => 'يتم تسجيل دخولك فعليًا باسم <strong>:name </strong> ، ويمكنك الخروج كـ <a href=":route" data-turbolinks="false">:admin </a>.',
    ],

    'backend' => [
        'dashboard' => [
            'new_posts'            => 'مقالات جديدة',
            'pending_posts'        => 'مقالات معلّقة',
            'published_posts'      => 'مقالات منشورة',
            'active_users'         => 'مستخدمين فعّالين',
            'form_submissions'     => 'مرسَلات',
            'last_posts'           => 'أحدث المقالات',
            'last_published_posts' => 'أحدث المنشورات',
            'last_pending_posts'   => 'أحدث المقالات المعلّقة',
            'last_new_posts'       => 'أحدث المقالات الجديدة',
            'all_posts'            => 'جميع المقالات',
        ],

        'new_menu' => [
            'post'         => 'مقالة جديدة',
            'form_setting' => 'إعداد إستمارة جديد',
            'user'         => 'مستخدم جديد',
            'role'         => 'دور جديد',
            'meta'         => 'معلومة وصفية جديدة',
            'redirection'  => 'قاعدة توجيه جديدة',
        ],

        'sidebar' => [
            'content' => 'إدارة المحتوى',
            'forms'   => 'إدارة الإستمارات',
            'access'  => 'إدارة الوصول',
            'seo'     => 'إعدادات تحسين محركات البحث',
        ],

        'titles' => [
            'dashboard' => 'لوحة التحكم',
        ],

        'users' => [
            'titles' => [
                'main'   => 'إدارة المستخدمين',
                'index'  => 'عرض المستخدمين',
                'create' => 'إنشاء مستخدم',
                'edit'   => 'تعديل مستخدم',
            ],

            'actions' => [
                'destroy' => 'حذف المستخدمين المختارين',
                'enable'  => 'تفعيل المستخدمين المختارين',
                'disable' => 'إلغاء تفعيل المستخدمين المختارين',
            ],
        ],

        'roles' => [
            'titles' => [
                'main'   => 'إدارة الأدوار',
                'index'  => 'عرض الأدوار',
                'create' => 'إنشاء دور',
                'edit'   => 'تعديل دور',
            ],
        ],

        'metas' => [
            'titles' => [
                'main'   => 'إدارة المعلومات الوصفية',
                'index'  => 'عرض المعلومات الوصفية',
                'create' => 'إنشاء معلومة وصفية',
                'edit'   => 'تعديل معلومة وصفية',
            ],

            'actions' => [
                'destroy' => 'حذف المعلومات الوصفية المختارة',
            ],
        ],

        'form_submissions' => [
            'titles' => [
                'main'  => 'إدارة المرسَلات',
                'index' => 'عرض المرسَلات',
                'show'  => 'تفاصل المُرسَل',
            ],

            'actions' => [
                'destroy' => 'حذف المرسَلات المختارة',
            ],
        ],

        'form_settings' => [
            'titles' => [
                'main'   => 'إعدادات الإستمارة',
                'index'  => 'عرض إعدادات الإستمارة',
                'create' => 'إنشاء إعداد إستمارة',
                'edit'   => 'تعديل إعداد إستمارة',
            ],

            'descriptions' => [
                'recipients' => 'مثل: \'webmaster@example.com\' أو \'sales@example.com,support@example.com\' . لتحديد أكثر من مستقبل، يرجى فصلهم بفاصلة.',
                'message'    => 'الرسالة المراد عرضها للمستخدم بعد عملية إرسال معلومات الإستمارة. اتركها فارغة إذا لم ترد عرض أي رسالة',
            ],
        ],

        'redirections' => [
            'titles' => [
                'main'   => 'إدارة قواعد التوجيه',
                'index'  => 'عرض قواعد التوجيه',
                'create' => 'إنشاء قاعدة توجيه',
                'edit'   => 'تعديل قاعدة توجيه',
            ],

            'actions' => [
                'destroy' => 'حذف قواعد التوجيه المختارة',
                'enable'  => 'تفعيل قواعد التوجيه المختارة',
                'disable' => 'إلغاء تفعيل قواعد التوجيه المختارة',
            ],

            'types' => [
                'permanent' => 'إعادة توجيه دائم (301)',
                'temporary' => 'إعادة توجيه مؤقت (302)',
            ],

            'import' => [
                'title'       => 'إستيراد ملف CSV',
                'label'       => 'إختر ملف CSV ليتم إستيراده',
                'description' => 'الملف يجب أن يحوي عمودين بالترويسة "source" و "target" علماً أن إعادة التوجيه ستكون من النوع الدائم بشكل إفتراضي',
            ],
        ],

        'posts' => [
            'statuses' => [
                'draft'     => 'مسودة',
                'pending'   => 'معلّقة',
                'published' => 'منشورة',
            ],

            'titles' => [
                'main'        => 'إدارة المقالات',
                'index'       => 'عرض المقالات',
                'create'      => 'إنشاء مقالة',
                'edit'        => 'تعديل مقالة',
                'publication' => 'خيارات النشر',
            ],

            'descriptions' => [
                'meta_title'       => 'في حال كانت فارغة، فإن العنوان سيكون مطابق لعنوان المقالة بشكل إفتراضي',
                'meta_description' => 'في حال كانت فارغة، فإن الوصف سيكون مطابق لملخص المقالة بشكل إفتراضي',
            ],

            'placeholders' => [
                'body'             => 'أكتب المحتوى...',
                'meta_title'       => 'عنوان المقالة.',
                'meta_description' => 'ملخص المقالة.',
            ],

            'actions' => [
                'destroy' => 'حذف المقالات المختارة',
                'publish' => 'نشر المقالات المختارة',
                'pin'     => 'تثبيت المقالات المختارة',
                'promote' => 'ترقية المقالات المختارة',
            ],
        ],
    ],

    'frontend' => [
        'titles' => [
            'home'           => 'الرئيسية',
            'about'          => 'حول',
            'contact'        => 'إتصل بنا',
            'blog'           => 'المدونة',
            'message_sent'   => 'تم إرسال الرسالة',
            'legal_mentions' => 'إشارات قانونية',
            'administration' => 'إدارة',
        ],

        'submissions' => [
            'message_sent' => '<p>تم إرسال رسالتك بنجاح</p>',
        ],

        'placeholders' => [
            'locale'   => 'يرجى إختيار اللغة الخاصة بك',
            'timezone' => 'يرجى إختيار النطاق الزمني الخاص بك',
        ],

        'blog' => [
            'published_at'                     => 'نشرت بتاريخ :date',
            'published_at_with_owner_linkable' => 'نشرت بتاريخ :date من قبل <a href=":link">:name</a>',
            'tags'                             => 'وسوم',
        ],
    ],
];
