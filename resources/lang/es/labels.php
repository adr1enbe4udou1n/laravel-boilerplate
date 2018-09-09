<?php

return [
    'language'            => 'Idioma',
    'actions'             => 'Acciones',
    'general'             => 'General',
    'no_results'          => 'No hay resultados disponibles',
    'search'              => 'Buscar',
    'validate'            => 'Validar',
    'choose_file'         => 'Seleccione el archivo',
    'no_file_chosen'      => 'Ningún archivo seleccionado',
    'are_you_sure'        => 'Estás seguro ?',
    'delete_image'        => 'Eliminar imagen',
    'yes'                 => 'Sí',
    'no'                  => 'No',
    'add_new'             => 'Añadir',
    'export'              => 'Exportar',
    'more_info'           => 'Más información',
    'author'              => 'Autor',
    'author_id'           => 'Autor ID',
    'last_access_at'      => 'Último acceso a',
    'published_at'        => 'Publicado en',
    'created_at'          => 'Creado en',
    'updated_at'          => 'Actualizado en',
    'deleted_at'          => 'Eliminado en',
    'no_value'            => 'Sin valor',
    'upload_image'        => 'Cargar imagen',
    'anonymous'           => 'Anónimo',
    'all_rights_reserved' => 'Todos los derechos reservados.',
    'with'                => 'con',
    'by'                  => 'por',

    'datatables' => [
        'no_results'         => 'No hay resultados disponibles',
        'no_matched_results' => 'No hay resultados coincidentes disponibles',
        'show_per_page'      => 'Mostrar',
        'entries_per_page'   => 'entradas por página',
        'search'             => 'Buscar',
        'infos'              => 'Mostrando :offset_start a :offset_end de :total entries',
    ],

    'morphs' => [
        'post' => 'Articulo, identidad :id',
        'user' => 'Usuario, identidad:id',
    ],

    'auth' => [
        'disabled' => 'Your account has been disabled.',
    ],

    'http' => [
        '403' => [
            'title'       => 'Acceso denegado',
            'description' => 'Lo sentimos, pero no tienes permisos para acceder a esta página.',
        ],
        '404' => [
            'title'       => 'Página no encontrada',
            'description' => 'Lo sentimos, pero la página que intentabas ver no existe.',
        ],
        '500' => [
            'title'       => 'Error del Servidor',
            'description' => 'Lo sentimos, pero el servidor ha encontrado una situación que no sabe cómo manejar. Arreglaremos esto lo antes posible.',
        ],
    ],

    'localization' => [
        'en' => 'Inglés',
        'fr' => 'Francés',
        'es' => 'Español',
    ],

    'placeholders' => [
        'route' => 'Seleccione una ruta interna válida',
        'tags'  => 'Seleccione o cree una etiqueta',
    ],

    'cookieconsent' => [
        'message' => 'Este sitio web utiliza cookies para garantizar que obtenga la mejor experiencia en nuestro sitio web.',
        'dismiss' => 'Estoy de acuerdo !',
    ],

    'descriptions' => [
        'allowed_image_types' => 'Tipos permitidos: png gif jpg jpeg.',
    ],

    'user' => [
        'dashboard'                 => 'Controles',
        'remember'                  => 'Recuerda',
        'login'                     => 'Iniciar sesión',
        'logout'                    => 'Cerrar sesión',
        'password_forgot'           => 'Contraseña olvidada ?',
        'send_password_link'        => 'Enviar enlace para restablecer contraseña',
        'password_reset'            => 'Restablecimiento de contraseña',
        'register'                  => 'Registro',
        'space'                     => 'Mi espacio',
        'settings'                  => 'Settings',
        'account'                   => 'Mi cuenta',
        'profile'                   => 'Mi perfil',
        'avatar'                    => 'Avatar',
        'online'                    => 'En línea',
        'edit_profile'              => 'Editar mi perfil',
        'change_password'           => 'Cambiar mi contraseña',
        'delete'                    => 'Borrar mi cuenta',
        'administration'            => 'Administración',
        'member_since'              => 'Miembro desde :date',
        'profile_updated'           => 'Perfil actualizado con éxito.',
        'password_updated'          => 'Contraseña actualizada con éxito.',
        'super_admin'               => 'Súper administrador',

        'account_delete'  => '<p>Esta acción eliminará por completo su cuenta de este sitio, así como todos los datos asociados.</p>',
        'account_deleted' => 'Cuenta eliminada con éxito',

        'titles' => [
            'space'   => 'Mi espacio',
            'account' => 'Mi cuenta',
        ],
    ],

    'alerts' => [
        'login_as'      => 'Actualmente as iniciado session como <strong>:name</strong>, puedes cerrar sesión como <a href=":route" data-turbolinks="false">:admin</a>.',
    ],

    'backend' => [
        'dashboard' => [
            'new_posts'            => 'Artículos nuevos',
            'pending_posts'        => 'Artículos pendientes',
            'published_posts'      => 'Artículos Publicados',
            'active_users'         => 'Usuarios activos',
            'form_submissions'     => 'Solicitudes',
            'last_posts'           => 'Últimos artículos',
            'last_published_posts' => 'Últimos artículos publicados',
            'last_pending_posts'   => 'Últimos artículos pendientes',
            'last_new_posts'       => 'Últimos artículos nuevos',
            'all_posts'            => 'Todos los artículos',
        ],

        'new_menu' => [
            'post'         => 'Nuevo articulo',
            'form_setting' => 'Nueva configuración de formulario',
            'user'         => 'Nuevo usuario',
            'role'         => 'Nuevo rol',
            'meta'         => 'Nueva meta',
            'redirection'  => 'Nueva redirección',
        ],

        'sidebar' => [
            'content' => 'Gestión de contenido',
            'forms'   => 'Gestión de formularios',
            'access'  => 'Gestión de Acceso',
            'seo'     => 'Ajustes SEO',
        ],

        'titles' => [
            'dashboard' => 'Controles',
        ],

        'users' => [
            'titles' => [
                'main'   => 'Gestión de usuarios',
                'index'  => 'Lista de usuarios',
                'create' => 'Creación de usuario',
                'edit'   => 'Modificación del usuario',
            ],

            'actions' => [
                'destroy' => 'Eliminar usuarios seleccionados',
                'enable'  => 'Habilitar usuarios seleccionados',
                'disable' => 'Desactivar usuarios seleccionados',
            ],
        ],

        'roles' => [
            'titles' => [
                'main'   => 'Gestión de roles',
                'index'  => 'Lista de roles',
                'create' => 'Creación de roles',
                'edit'   => 'Modificación de roles',
            ],
        ],

        'metas' => [
            'titles' => [
                'main'   => 'Meta gestión',
                'index'  => 'Lista Meta',
                'create' => 'Creación de Meta',
                'edit'   => 'Modificación de meta',
            ],

            'actions' => [
                'destroy' => 'Eliminar metas seleccionadas',
            ],
        ],

        'form_submissions' => [
            'titles' => [
                'main'  => 'Gestión de solicitudes',
                'index' => 'Lista de solicitudes',
                'show'  => 'Detalle de solicitud',
            ],

            'actions' => [
                'destroy' => 'Elimiar solicitudes seleccionadas',
            ],
        ],

        'form_settings' => [
            'titles' => [
                'main'   => 'Configuración de formulario',
                'index'  => 'Lista de configuración de formulario',
                'create' => 'Creación de configuración de formulario',
                'edit'   => 'Modificación de configuración de formulario',
            ],

            'descriptions' => [
                'recipients' => 'Ejemplo: \'webmaster@example.com\' o \'sales@example.com,support@example.com\' . Para especificar múltiples destinatarios, separe cada dirección de correo electrónico con una coma.',
                'message'    => 'El mensaje para mostrar al usuario después del envío de este formulario. Dejar en blanco para ningún mensaje.',
            ],
        ],

        'redirections' => [
            'titles' => [
                'main'   => 'Gestión de redirección',
                'index'  => 'Lista de redirección',
                'create' => 'Creación de redirección',
                'edit'   => 'Modificación de redirección',
            ],

            'actions' => [
                'destroy' => 'Eliminar las redirecciones seleccionadas',
                'enable'  => 'Habilitar redirecciones seleccionadas',
                'disable' => 'Deshabilitar redirecciones seleccionadas',
            ],

            'types' => [
                'permanent' => 'Redirección permanente (301)',
                'temporary' => 'Redirección temporal (302)',
            ],

            'import' => [
                'title'       => 'Importación de archivo CSV',
                'label'       => 'Seleccionar archivo CSV para importar',
                'description' => 'El archivo debe tener 2 columnas con "source" y "target" como encabezado, la redirección será permanente por defecto',
            ],
        ],

        'posts' => [
            'statuses' => [
                'draft'     => 'Borrador',
                'pending'   => 'Pendiente',
                'published' => 'Publicado',
            ],

            'titles' => [
                'main'        => 'Gestión de artículos',
                'index'       => 'Lista de artículos',
                'create'      => 'Crear articulo',
                'edit'        => 'Editar articulo',
                'publication' => 'Opciones de publicación',
            ],

            'descriptions' => [
                'meta_title'       => 'If leave empty, title will be that of article\' title by default.',
                'meta_description' => 'If leave empty, description will be that of article\'s summary by default.',
            ],

            'placeholders' => [
                'body'             => 'Escribe tu contenido...',
                'meta_title'       => 'Título del articulo.',
                'meta_description' => 'Resumen del articulo.',
            ],

            'actions' => [
                'destroy' => 'Eliminar artículos seleccionados',
                'publish' => 'Publicar artículos seleccionados',
                'pin'     => 'Fijar artículos seleccionados',
                'promote' => 'Promover artículos seleccionados',
            ],
        ],
    ],

    'frontend' => [
        'titles' => [
            'home'           => 'Inicio',
            'about'          => 'Acerca de',
            'contact'        => 'Contacto',
            'blog'           => 'Blog',
            'message_sent'   => 'Mensaje enviado',
            'legal_mentions' => 'Menciones legales',
            'administration' => 'Administración',
        ],

        'submissions' => [
            'message_sent' => '<p>Su mensaje ha sido enviado con éxito</p>',
        ],

        'placeholders' => [
            'locale'   => 'Selecciona tu idioma',
            'timezone' => 'Selecciona tu zona horaria',
        ],

        'blog' => [
            'published_at'                     => 'Publicado en :date',
            'published_at_with_owner_linkable' => 'Publicado en :date por <a href=":link">:name</a>',
            'tags'                             => 'Etiquetas',
        ],
    ],
];
