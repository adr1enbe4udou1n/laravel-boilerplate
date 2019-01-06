<?php
/**
 * @author Andrey "Limych" Khrolenok <andrey@khrolenok.ru>
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Строки проверочных сообщений
    |--------------------------------------------------------------------------
    |
    | Следующие языковые строки содержат сообщения об ошибках по умолчанию,
    | используемые классом валидатора. Некоторые из этих правил имеют несколько
    | версий, таких как правила размера. Не стесняйтесь настраивать каждое
    | из этих сообщений под себя.
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
    'required_with'        => 'поле :attribute обязательно, если присутствуют :values.',
    'required_with_all'    => 'поле :attribute обязательно, если присутствуют :values.',
    'required_without'     => 'поле :attribute обязательно, если отсутствуют :values.',
    'required_without_all' => 'поле :attribute обязательно, если нет ничего из :values.',
    'same'                 => ':attribute и :other должны совпадать.',
    'size'                 => [
        'numeric' => ':attribute должно быть :size.',
        'file'    => ':attribute должно быть :size Кб.',
        'string'  => ':attribute должно быть :size символов.',
        'array'   => ':attribute должно содержать :size элементов.',
    ],
    'string'   => ':attribute должно быть строкой.',
    'timezone' => ':attribute должно быть корректным часовым поясом.',
    'unique'   => ':attribute уже есть в базе.',
    'uploaded' => ':attribute не получилось загрузить.',
    'url'      => ':attribute имеет неверный формат.',

    /*
    |--------------------------------------------------------------------------
    | Пользовательские строки
    |--------------------------------------------------------------------------
    |
    | Здесь вы можете указать специальные сообщения для атрибутов, используя
    | соглашение «attribute.rule», чтобы назвать строки. Это позволяет быстро
    | указать конкретную строку для данного правила атрибута.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Пользовательские атрибуты
    |--------------------------------------------------------------------------
    |
    | Следующие строки используются для замены имён атрибутов на что-то более
    | удобное для чтения человеком, таким как «адрес электронной почты» вместо
    | «email». Это просто помогает нам сделать сообщения немного понятнее.
    |
    */

    'attributes' => [
        'name'                      => 'Имя',
        'display_name'              => 'Отображаемое имя',
        'username'                  => 'Псевдоним',
        'email'                     => 'E-mail',
        'first_name'                => 'Имя',
        'last_name'                 => 'Фамилия',
        'password'                  => 'Пароль',
        'password_confirmation'     => 'Подтверждение пароля',
        'old_password'              => 'Старый пароль',
        'new_password'              => 'Новый пароль',
        'new_password_confirmation' => 'Подтверждение нового пароля',
        'postal_code'               => 'Почтовый индекс',
        'city'                      => 'Город',
        'country'                   => 'Страна',
        'address'                   => 'Адрес',
        'phone'                     => 'Телефон',
        'mobile'                    => 'Мобильный',
        'age'                       => 'Возраст',
        'sex'                       => 'Пол',
        'gender'                    => 'Пол',
        'day'                       => 'День',
        'month'                     => 'Месяц',
        'year'                      => 'Год',
        'hour'                      => 'Час',
        'minute'                    => 'Минута',
        'second'                    => 'Секунда',
        'title'                     => 'Заголовок',
        'content'                   => 'Содержание',
        'description'               => 'Описание',
        'summary'                   => 'Резюме',
        'excerpt'                   => 'Отрывок',
        'date'                      => 'Дата',
        'time'                      => 'Время',
        'available'                 => 'Доступный',
        'size'                      => 'Размер',
        'roles'                     => 'Роли',
        'permissions'               => 'Права',
        'active'                    => 'Активный',
        'message'                   => 'Сообщение',
        'g-recaptcha-response'      => 'Защитный код',
        'locale'                    => 'Локализация',
        'route'                     => 'Маршрут',
        'url'                       => 'URL',
        'form_type'                 => 'Тип формы',
        'form_data'                 => 'Данные формы',
        'recipients'                => 'Получатели',
        'source_path'               => 'Исходный путь',
        'target_path'               => 'Целевой путь',
        'redirect_type'             => 'Тип переадресации',
        'timezone'                  => 'Часовой пояс',
        'order'                     => 'Порядок показа',
        'image'                     => 'Изображение',
        'status'                    => 'Статус',
        'pinned'                    => 'Закреплено',
        'promoted'                  => 'Выделено',
        'body'                      => 'Основная часть',
        'tags'                      => 'Метки',
        'published_at'              => 'Опубликовано',
        'unpublished_at'            => 'Снято с публикации',
        'metable_type'              => 'Сущность',
    ],
];
