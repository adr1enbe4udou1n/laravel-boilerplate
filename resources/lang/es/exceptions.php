<?php

return [
    'general'      => 'Excepción del servidor',
    'unauthorized' => 'Acción no permitida',

    'backend' => [
        'users' => [
            'create'                            => 'Error en la creación del usuario',
            'update'                            => 'Error en la actualización del usuario',
            'delete'                            => 'Error en la eliminación del usuario',
            'first_user_cannot_be_edited'       => 'No puedes editar el usuario súper administrador',
            'first_user_cannot_be_disabled'     => 'El usuario súper administrador no puede ser deshabilitado',
            'first_user_cannot_be_destroyed'    => 'El usuario súper administrador no puede ser eliminado',
            'first_user_cannot_be_impersonated' => 'El usuario Super administrador no puede ser suplantado',
            'cannot_set_superior_roles'         => 'No puedes atribuir roles superiores a los tuyos',
        ],

        'roles' => [
            'create' => 'Error en la creación de roles',
            'update' => 'Error en la actualización de roles',
            'delete' => 'Error en la eliminación de roles',
        ],

        'metas' => [
            'create'        => 'Error en la creación de la meta',
            'update'        => 'Error en la actualización de la meta',
            'delete'        => 'Error en la eliminación de la meta',
            'already_exist' => 'Ya hay una meta para esta ruta de configuración regional',
        ],

        'form_submissions' => [
            'create' => 'Error en la creación de la solicitud',
            'delete' => 'Error en la eliminación de la solicitud',
        ],

        'form_settings' => [
            'create'        => 'Error en la creación de configuración de formulario',
            'update'        => 'Error en la actualización de configuración del formulario',
            'delete'        => 'Error en la eliminación de configuración del formulario',
            'already_exist' => 'Ya hay una configuración vinculada a este formulario',
        ],

        'redirections' => [
            'create'        => 'Error en la creación de la redirección',
            'update'        => 'Error en la actualización de la redirección',
            'delete'        => 'Error en la eliminación de la redirección',
            'already_exist' => 'Ya hay una redirección para este camino',
        ],

        'posts' => [
            'create' => 'Error en la creación del articulo',
            'update' => 'Error en la actualización del articulo',
            'save'   => 'Error en la salvado del articulo',
            'delete' => 'Error en la eliminación del articulo',
        ],
    ],

    'frontend' => [
        'user' => [
            'email_taken'       => 'Esa dirección de correo electrónico ya está es uso.',
            'password_mismatch' => 'Esa no es tu contraseña anterior.',
            'delete_account'    => 'Error al eliminar la cuenta.',
            'updating_disabled' => 'La edición de cuenta está deshabilitada.',
        ],

        'auth' => [
            'registration_disabled' => 'El registro está desactivado.',
        ],
    ],
];
