<?php
/**
 * @author Andrey "Limych" Khrolenok <andrey@khrolenok.ru>
 */

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

    'accepted'        => ':attribute должен быть принят.',
    'active_url'      => ':attribute является некорректным URL.',
    'after'           => ':attribute должен быть датой после :date.',
    'after_or_equal'  => ':attribute должен быть датой после или равной :date.',
    'alpha'           => ':attribute может содержать только буквы.',
    'alpha_dash'      => ':attribute может содержать только буквы, цифры и дефисы.',
    'alpha_num'       => ':attribute может содержать только буквы и цифры.',
    'array'           => ':attribute должен быть списком.',
    'before'          => ':attribute должен быть датой до :date.',
    'before_or_equal' => ':attribute должен быть датой до или равной :date.',
    'between'         => [
        'numeric' => ':attribute должен быть между :min и :max.',
        'file'    => ':attribute должен быть между :min и :max kilobytes.',
        'string'  => ':attribute должен быть между :min и :max characters.',
        'array'   => ':attribute должен содержать от :min до :max элементов.',
    ],
    'boolean'        => ':attribute должен быть «истина» или «ложь».',
    'confirmed'      => ':attribute подтверждение не совпадает.',
    'date'           => ':attribute не является корректной датой.',
    'date_format'    => ':attribute не совпадает с форматом :format.',
    'different'      => ':attribute и :other должны различаться.',
    'digits'         => ':attribute должен содержать :digits цифр.',
    'digits_between' => ':attribute должен быть от :min до :max цифр.',
    'dimensions'     => ':attribute содержит неверные размеры изображения.',
    'distinct'       => ':attribute содержит дублирующее значение.',
    'email'          => ':attribute должен быть корректным почтовым адресом.',
    'exists'         => 'выбранный :attribute неверен.',
    'file'           => ':attribute должен быть файлом.',
    'filled'         => ':attribute должен быть заполнен.',
    'image'          => ':attribute должен быть изображением.',
    'in'             => 'выбранный :attribute неверен.',
    'in_array'       => ':attribute отсутствует в :other.',
    'integer'        => ':attribute должен быть целым.',
    'ip'             => ':attribute должен быть корректным IP-адресом.',
    'ipv4'           => ':attribute должен быть корректным IPv4-адресом.',
    'ipv6'           => ':attribute должен быть корректным IPv6-адресом.',
    'json'           => ':attribute должен быть корректной JSON-строкой.',
    'max'            => [
        'numeric' => ':attribute не может быть более чем :max.',
        'file'    => ':attribute не может быть более чем :max Кб.',
        'string'  => ':attribute не может быть более чем :max символов.',
        'array'   => ':attribute не может содержать более чем :max значений.',
    ],
    'mimes'     => ':attribute должен быть файлом типа :values.',
    'mimetypes' => ':attribute должен быть файлом типа :values.',
    'min'       => [
        'numeric' => ':attribute должен быть не менее чем :min.',
        'file'    => ':attribute должен быть не менее чем :min Кб.',
        'string'  => ':attribute должен содержать не менее чем :min символов.',
        'array'   => ':attribute должен содержать не менее чем :min значений.',
    ],
    'not_in'               => 'выбранный :attribute неверен.',
    'not_regex'            => 'формат :attribute неверен.',
    'numeric'              => ':attribute должен быть числом.',
    'present'              => 'поле :attribute должно присутствовать.',
    'regex'                => 'формат :attribute неверен.',
    'required'             => 'поле :attribute обязательно.',
    'required_if'          => 'поле :attribute обязательно, когда :other равно :value.',
    'required_unless'      => 'поле :attribute обязательно, если :other в :values.',
    'required_with'        => ':attribute field is required when :values is present.',
    'required_with_all'    => ':attribute field is required when :values is present.',
    'required_without'     => ':attribute field is required when :values is not present.',
    'required_without_all' => ':attribute field is required when none of :values are present.',
    'same'                 => ':attribute и :other must match.',
    'size'                 => [
        'numeric' => ':attribute must be :size.',
        'file'    => ':attribute must be :size kilobytes.',
        'string'  => ':attribute must be :size characters.',
        'array'   => ':attribute must contain :size items.',
    ],
    'string'   => ':attribute must be a string.',
    'timezone' => ':attribute must be a valid zone.',
    'unique'   => ':attribute has already been taken.',
    'uploaded' => ':attribute failed to upload.',
    'url'      => ':attribute format is invalid.',

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
        'name'                      => 'Name',
        'display_name'              => 'Display name',
        'username'                  => 'Pseudo',
        'email'                     => 'Email',
        'first_name'                => 'Firstname',
        'last_name'                 => 'Lastname',
        'password'                  => 'Password',
        'password_confirmation'     => 'Confirm password',
        'old_password'              => 'Old password',
        'new_password'              => 'New password',
        'new_password_confirmation' => 'Confirm new password',
        'postal_code'               => 'Postal code',
        'city'                      => 'City',
        'country'                   => 'Country',
        'address'                   => 'Address',
        'phone'                     => 'Phone',
        'mobile'                    => 'Mobile',
        'age'                       => 'Age',
        'sex'                       => 'Sex',
        'gender'                    => 'Gender',
        'day'                       => 'Day',
        'month'                     => 'Month',
        'year'                      => 'Year',
        'hour'                      => 'Hour',
        'minute'                    => 'Minute',
        'second'                    => 'Second',
        'title'                     => 'Title',
        'content'                   => 'Content',
        'description'               => 'Description',
        'summary'                   => 'Summary',
        'excerpt'                   => 'Excerpt',
        'date'                      => 'Date',
        'time'                      => 'Time',
        'available'                 => 'Available',
        'size'                      => 'Size',
        'roles'                     => 'Roles',
        'permissions'               => 'Permissions',
        'active'                    => 'Active',
        'message'                   => 'Message',
        'g-recaptcha-response'      => 'Captcha',
        'locale'                    => 'Localization',
        'route'                     => 'Route',
        'url'                       => 'URL alias',
        'form_type'                 => 'Form type',
        'form_data'                 => 'Form data',
        'recipients'                => 'Recipients',
        'source_path'               => 'Original path',
        'target_path'               => 'Target path',
        'redirect_type'             => 'Redirect type',
        'timezone'                  => 'Timezone',
        'order'                     => 'Display order',
        'image'                     => 'Image',
        'status'                    => 'Status',
        'pinned'                    => 'Pinned',
        'promoted'                  => 'Promoted',
        'body'                      => 'Body',
        'tags'                      => 'Tags',
        'published_at'              => 'Publish at',
        'unpublished_at'            => 'Unpublish at',
        'metable_type'              => 'Entity',
    ],
];
