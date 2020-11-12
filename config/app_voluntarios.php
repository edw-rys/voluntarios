<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Site config
    |--------------------------------------------------------------------------
    |
    */
    'version'               => '1.0',
    'date_format'           => 'Y-m-d',
    'time_format'           => 'H:i:s',
    'chunks'                => 20,
    'logging_session_key'   => 'user_live_time',


    /*
    |--------------------------------------------------------------------------
    | Page config
    |--------------------------------------------------------------------------
    |
    */
    'prefix_page'           => 'pages',

    /*
    |--------------------------------------------------------------------------
    | Filesystems config
    |--------------------------------------------------------------------------
    |
    */
    'widgets'               => 'widgets',

    /*
    |--------------------------------------------------------------------------
    | Image config
    |--------------------------------------------------------------------------
    |
    */
    'profile'               => [
        'thumbnail_path'    => 'img/profiles/thumbnails',
        'cover_path'        => 'img/profiles/covers',
        'default_user'      => 'img/profiles/default_user.png',
    ],
    'common'                => [
        'thumbnail_path'    => 'img/uploaded/thumbnails',
        'cover_path'        => 'img/uploaded/covers',
    ],


    'settings'          => [
        'notifications_delay'   => 60,
        'optimus_prime'         => '659721767',
        'optimus_inverse'       => '1044382103',
        'optimus_random'        => '619970903',
        'meta_keywords'         => 'voluntarios',
        'meta_author'           => '',
        'version'               => '',
        'getSiteVersion'        => '',
        'company_icon'          => '',
        'meta_robots'           => '',

    ],
    'meta_title'                => 'Voluntarios',
    'key_maps'                  => env('KEY_MAPS', ''),
    /**
     * Preguntas
     */
    'horarios'  => [
        'MATUTINO',
        'VESPERTINO',
        'NOCTURNO',
        'ROTATIVO',
    ],
    'permission'    => env('PERMISSION'),
    'menus'         => [
        (object) [
            'route'         => 'admin.dashboard',
            'icon'          => 'nav-icon fas fa-tachometer-alt',
            'lang'          => 'global.menu.dashboard',
            'route_name'    => 'admin.dashboard',
            'permisos'      => 'dashboard',
        ],
        (object) [
            'route'         => 'admin.voluntarios.create',
            'icon'          => 'nav-icon fas fa-tachometer-alt',
            'lang'          => 'global.menu.ingreso',
            'route_name'    => 'admin.voluntarios.create',
            'permisos'      => 'crear_voluntarios',
        ],
        (object) [
            'route'         => 'admin.voluntarios.index',
            'icon'          => 'nav-icon fas fa-tachometer-alt',
            'lang'          => 'global.menu.voluntariado',
            'route_name'    => 'admin.voluntarios.index',
            'permisos'      => 'acceso_voluntarios',
        ],
        (object) [
            'route'         => 'admin.evaluaciones.index',
            'icon'          => 'nav-icon fas fa-tachometer-alt',
            'lang'          => 'global.menu.evaluaciones',
            'route_name'    => 'admin.evaluaciones.index',
            'permisos'      => 'acceso_evaluaciiones',
        ],
        (object) [
            'route'         => 'admin.certificados.index',
            'icon'          => 'nav-icon fas fa-tachometer-alt',
            'lang'          => 'global.menu.certificates',
            'route_name'    => 'admin.certificados.index',
            'permisos'      => 'acceso_certificados',
        ],
    ],

    // Gráficos

    'graficos'                  => [
        (object) [
            'id'        => 'grafico-universidad',
            'titulo'    => 'Universidades'
        ],
        (object) [
            'id'        => 'grafico-facultad',
            'titulo'    => 'Facultad'
        ],
        (object) [
            'id'        => 'grafico-departamentos',
            'titulo'    => 'Departamentos'
        ],
    ],
    'modos_graficos'            => [
        (object)[
            'class_canvas'      => 'bar-chart',
            'nombre'            => 'bar',
            'class_parent'      => 'bar-chart-container'
        ],
        // (object)[
        //     'class_canvas'      => 'doughnut-chart',
        //     'nombre'            => 'doughnut',
        //     'class_parent'      => 'doughnut-chart-container'
        // ],
        // (object)[
        //     'class_canvas'      => 'mixed-chart',
        //     'nombre'            => 'mixed',
        //     'class_parent'      => 'mixed-chart-container'
        // ],
    ]
];
