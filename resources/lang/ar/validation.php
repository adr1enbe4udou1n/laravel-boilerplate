<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'        => 'يجب قبول الحقل :attribute.',
    'active_url'      => 'الحقل :attribute لا يُمثّل رابطًا صحيحًا.',
    'after'           => 'يجب على الحقل :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'after_or_equal'  => 'يجب على الحقل :attribute أن يكون تاريخًا مساوٍ أو لاحقًا للتاريخ :date.',
    'alpha'           => 'يجب أن لا يحتوي الحقل :attribute سوى على حروف.',
    'alpha_dash'      => 'يجب أن لا يحتوي الحقل :attribute على حروف، أرقام ومطّات.',
    'alpha_num'       => 'يجب أن يحتوي :attribute على حروف وأرقام فقط.',
    'array'           => 'يجب أن يكون الحقل :attribute ًمصفوفة.',
    'before'          => 'يجب على الحقل :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before_or_equal' => 'يجب على الحقل :attribute أن يكون تاريخًا سابقًا أو مساوٍ للتاريخ :date.',
    'between'         => [
        'numeric' => 'يجب أن تكون قيمة :attribute محصورة ما بين :min و :max.',
        'file'    => 'يجب أن يكون حجم الملف :attribute محصورًا ما بين :min و :max كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف النّص :attribute محصورًا ما بين :min و :max.',
        'array'   => 'يجب أن يحتوي :attribute على عدد من العناصر محصورًا ما بين :min و :max.',
    ],
    'boolean'        => 'يجب أن تكون قيمة الحقل :attribute إما true أو false.',
    'confirmed'      => 'حقل التأكيد غير مُطابق للحقل :attribute.',
    'date'           => 'الحقل :attribute ليس تاريخًا صحيحاً.',
    'date_format'    => 'لا يتوافق الحقل :attribute مع الشكل :format.',
    'different'      => 'يجب أن يكون الحقلان :attribute و :other مُختلفان.',
    'digits'         => 'يجب أن يحتوي الحقل :attribute على :digits رقمًا/أرقام.',
    'digits_between' => 'يجب أن يحتوي الحقل :attribute ما بين :min و :max رقمًا/أرقام.',
    'dimensions'     => ' أبعاد الصورة :attribute غير صالحة.',
    'distinct'       => 'للحقل :attribute قيمة مُكرّرة.',
    'email'          => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح البُنية.',
    'exists'         => 'الحقل :attribute لاغٍ.',
    'file'           => 'الحقل :attribute يجب أن يكون ملف.',
    'filled'         => 'الحقل :attribute إجباري.',
    'image'          => 'يجب أن يكون الحقل :attribute صورة.',
    'in'             => 'الحقل :attribute لاغٍ.',
    'in_array'       => 'الحقل :attribute غير موجود في :other.',
    'integer'        => 'يجب أن يكون الحقل :attribute عدد صحيح.',
    'ip'             => 'يجب أن يكون الحقل :attribute عنوان IP ذي بُنية صحيحة.',
    'ipv4'           => 'يجب أن يكون الحقل :attribute عنوان IPv4 ذي بُنية صحيحة.',
    'ipv6'           => 'يجب أن يكون الحقل :attribute عنوان IPv6 ذي بُنية صحيحة.',
    'json'           => 'يجب أن يكون الحقل :attribute نصآ من نوع JSON.',
    'max'            => [
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute أصغر من :max.',
        'file'    => 'يجب أن يكون حجم الملف :attribute أصغر من :max كيلوبايت.',
        'string'  => 'يجب أن لا يتجاوز طول النّص :attribute :max حروفٍ/حرفًا.',
        'array'   => 'يجب أن لا يحتوي الحقل :attribute على أكثر من :max عناصر/عنصر.',
    ],
    'mimes'     => 'يجب أن يكون الحقل ملفًا من نوع : :values.',
    'mimetypes' => 'يجب أن يكون الحقل ملفًا من نوع : :values.',
    'min'       => [
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute أكبر من :min.',
        'file'    => 'يجب أن يكون حجم الملف :attribute أكبر من :min كيلوبايت.',
        'string'  => 'يجب أن يكون طول النص :attribute أكبر من :min حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي الحقل :attribute على الأقل على :min عُنصرًا/عناصر.',
    ],
    'not_in'               => 'الحقل :attribute لاغٍ.',
    'numeric'              => 'يجب على الحقل :attribute أن يكون رقماً.',
    'present'              => 'الحقل :attribute يجب أن يكون موجوداً.',
    'regex'                => 'صيغة الحقل :attribute غير صحيحة.',
    'required'             => 'الحقل :attribute مطلوب.',
    'required_if'          => 'الحقل :attribute مطلوب في حال ما إذا كان :other يساوي :value.',
    'required_unless'      => 'الحقل :attribute مطلوب في حال ما لم يكن :other يساوي :values.',
    'required_with'        => 'الحقل :attribute مطلوب إذا توفّر :values.',
    'required_with_all'    => 'الحقل :attribute مطلوب إذا توفّر :values.',
    'required_without'     => 'الحقل :attribute مطلوب إذا لم يتوفّر :values.',
    'required_without_all' => 'الحقل :attribute مطلوب إذا لم يتوفّر :values.',
    'same'                 => 'يجب أن يتطابق الحقل :attribute مع :other',
    'size'                 => [
        'numeric' => 'يجب أن تكون قيمة :attribute أكبر من :size.',
        'file'    => 'يجب أن يكون حجم الملف :attribute أكبر من :size كيلو بايت.',
        'string'  => 'يجب أن يحتوي النص :attribute عن ما لا يقل عن  :size حرفٍ/أحرف.',
        'array'   => 'يجب أن يحتوي الحقل :attribute عن ما لا يقل عن:min عنصرٍ/عناصر.',
    ],
    'string'   => 'يجب أن يكون الحقل :attribute نصآ.',
    'timezone' => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا',
    'unique'   => 'قيمة الحقل :attribute مُستخدمة من قبل.',
    'uploaded' => 'فشل في تحميل :attribute.',
    'url'      => 'صيغة الرابط :attribute غير صحيحة.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name'                      => 'الاسم',
        'display_name'              => 'اسم العرض',
        'username'                  => 'اسم المستخدم',
        'email'                     => 'عنوان البريد الإلكتروني',
        'first_name'                => 'الاسم الأول',
        'last_name'                 => 'الاسم الأخير',
        'password'                  => 'كلمة المرور',
        'password_confirmation'     => 'تأكيد كلمة المرور',
        'old_password'              => 'كلمة المرور القديمة',
        'new_password'              => 'كلمة المرور الجديدة',
        'new_password_confirmation' => 'تأكيد كلمة المرور الجديدة',
        'postal_code'               => 'الرمز البريدي',
        'city'                      => 'المدينة',
        'country'                   => 'الدولة',
        'address'                   => 'العنوان',
        'phone'                     => 'الهاتف',
        'mobile'                    => 'المحمول',
        'age'                       => 'العمر',
        'sex'                       => 'الجنس',
        'gender'                    => 'الجنس',
        'day'                       => 'اليوم',
        'month'                     => 'الشهر',
        'year'                      => 'السنة',
        'hour'                      => 'الساعة',
        'minute'                    => 'الدقيقة',
        'second'                    => 'الثانية',
        'title'                     => 'العنوان',
        'content'                   => 'المحتوى',
        'description'               => 'الوصف',
        'summary'                   => 'الملخص',
        'excerpt'                   => 'مقتطفات',
        'date'                      => 'التاريخ',
        'time'                      => 'الوقت',
        'available'                 => 'متوفر',
        'size'                      => 'الحجم',
        'roles'                     => 'الأدوار',
        'permissions'               => 'الصلاحيات',
        'active'                    => 'فعال',
        'message'                   => 'رسالة',
        'g-recaptcha-response'      => 'رمز حماية Captcha',
        'locale'                    => 'تعريب',
        'route'                     => 'توجيه',
        'url'                       => 'اسم الرابط المستعار',
        'form_type'                 => 'نوع الإستمارة',
        'form_data'                 => 'معلومات الإستمارة',
        'recipients'                => 'المستلمين',
        'source_path'               => 'المسار الأصلي',
        'target_path'               => 'المسار الهدف',
        'redirect_type'             => 'نوع التوجيه',
        'timezone'                  => 'نطاق زمني',
        'order'                     => 'ترتيب العرض',
        'image'                     => 'صورة',
        'status'                    => 'حالة',
        'pinned'                    => 'مثبت',
        'promoted'                  => 'مُرقّى',
        'body'                      => 'جسم',
        'tags'                      => 'وسوم',
        'published_at'              => 'منشور في',
        'unpublished_at'            => 'إيقاف النشر في',
        'metable_type'              => 'كيان',
    ],
];
