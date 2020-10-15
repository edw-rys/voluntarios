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
    'meta_title'                => 'Voluntarios'
];
