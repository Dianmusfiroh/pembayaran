<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#61-title
    |
    */

'title' => 'SIPENAS',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#62-favicon
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#63-logo
    |
    */

    'logo' => '<b>SIPEN</b>AS',
    'logo_img' => 'img/logo.png',
    'logo_img_class' => 'brand-image',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'SIPENAS LOGO',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#64-user-menu
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#71-layout
    |
    */

    'layout_topnav' => true,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#721-authentication-views-classes
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#722-admin-panel-classes
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#73-sidebar
    |
    */

    'sidebar_mini' => true,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#74-control-sidebar-right-sidebar
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#65-urls
    |
    */

    'use_route_url' => false,

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'login_url' => 'login',

    'register_url' => 'register',

    'password_reset_url' => 'password/reset',

    'password_email_url' => 'password/email',

    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#92-laravel-mix
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#8-menu-configuration
    |
    */

    'menu' => [
        [
            'text' => 'Dashboard',
            'url' => 'home',
            'icon' => 'nav-icon fas fa-tachometer-alt'
        ],
        // [
        //     'can' =>  ['isAdmin','isPendaftaran'],
        //     'text' => 'Formasi',
        //     'url' => '#',
        //     'icon' => 'fa fa-fw fa-users',
        //     'submenu' => [
        //         [
        //             'text' => 'APBD',
        //             'url' => '#',
        //             'submenu' => [
        //                 [
        //                     'text' => 'Guru',
        //                     'url' => 'apps/formasi/apbd/guru'
        //                 ],
        //                 [
        //                     'text' => 'Tendik',
        //                     'url' => 'apps/formasi/apbd/tendik'
        //                 ],
        //             ]
        //         ],
        //         [
        //             'text' => 'DANA BOS',
        //             'url' => '#',
        //             'submenu' => [
        //                 [
        //                     'text' => 'Guru',
        //                     'url' => 'apps/formasi/dana-bos/guru'
        //                 ],
        //                 [
        //                     'text' => 'Tendik',
        //                     'url' => 'apps/formasi/dana-bos/tendik'
        //                 ],
        //             ]
        //         ],
        //         [
        //             'text' => 'APBD DESA',
        //             'url' => '#',
        //             'submenu' => [
        //                 [
        //                     'text' => 'Guru',
        //                     'url' => 'apps/formasi/apbd-desa/guru'
        //                 ],
        //                 [
        //                     'text' => 'Tendik',
        //                     'url' => 'apps/formasi/apbd-desa/tendik'
        //                 ],
        //             ]
        //         ],
        //     ]
        // ],
        // [
        //     'can' => 'isPendaftaran',
        //     'text' => 'Peserta',
        //     'url' => '#',
        //     'icon' => 'fa fa-fw fa-user-md',
        //     'submenu' => [
        //         [
        //             'text' => 'APBD',
        //             'url' => '#',
        //             'submenu' => [
        //                 [
        //                     'text' => 'Guru',
        //                     'url' => 'pendaftaran/peserta/guru/apbd'
        //                 ],
        //                 [
        //                     'text' => 'Tendik',
        //                     'url' => 'pendaftaran/peserta/tendik/apbd'
        //                 ],
        //             ]
        //         ],
        //         [
        //             'text' => 'DANA BOS',
        //             'url' => '#',
        //             'submenu' => [
        //                 [
        //                     'text' => 'Guru',
        //                     'url' => 'pendaftaran/peserta/guru/dana-bos'
        //                 ],
        //                 [
        //                     'text' => 'Tendik',
        //                     'url' => 'pendaftaran/peserta/tendi/dana-bos'
        //                 ],
        //             ]
        //         ],
        //         [
        //             'text' => 'APBD DESA',
        //             'url' => '#',
        //             'submenu' => [
        //                 [
        //                     'text' => 'Guru',
        //                     'url' => 'pendaftaran/peserta/guru/apbd-desa'
        //                 ],
        //                 [
        //                     'text' => 'Tendik',
        //                     'url' => 'pendaftaran/peserta/tendik/apbd-desa'
        //                 ],
        //             ]
        //         ],
        //     ]
        // ],
        // [
        //     'can' => 'isPendaftaran',
        //     'text' => 'Penilaian',
        //     'url' => '#',
        //     'icon' => 'fa fa-fw fa-tasks',
        //     'submenu' => [
        //         [
        //             'text' => 'APBD',
        //             'url' => '#',
        //             'submenu' => [
        //                 [
        //                     'text' => 'Guru',
        //                     'url' => 'pendaftaran/penilaian/guru/apbd'
        //                 ],
        //                 [
        //                     'text' => 'Tendik',
        //                     'url' => 'pendaftaran/penilaian/tendik/apbd'
        //                 ],
        //             ]
        //         ],
        //         [
        //             'text' => 'DANA BOS',
        //             'url' => '#',
        //             'submenu' => [
        //                 [
        //                     'text' => 'Guru',
        //                     'url' => 'pendaftaran/penilaian/guru/dana-bos'
        //                 ],
        //                 [
        //                     'text' => 'Tendik',
        //                     'url' => 'pendaftaran/penilaian/tendi/dana-bos'
        //                 ],
        //             ]
        //         ],
        //         [
        //             'text' => 'APBD DESA',
        //             'url' => '#',
        //             'submenu' => [
        //                 [
        //                     'text' => 'Guru',
        //                     'url' => 'pendaftaran/penilaian/guru/apbd-desa'
        //                 ],
        //                 [
        //                     'text' => 'Tendik',
        //                     'url' => 'pendaftaran/penilaian/tendik/apbd-desa'
        //                 ],
        //             ]
        //         ],
        //     ]
        // ],
        // [
        //     'can' => 'isPendaftaran',
        //     'text' => 'SK',
        //     'url' => 'apps/sk',
        //     'icon' => 'fa fa-fw fa-certificate'
        // ],
        [
            'can' => 'isPembayaran',
            'text' => 'SK',
            'url' => 'apps/sk',
            'icon' => 'fa fa-fw fa-certificate'
        ],
        [
            'can' => 'isPembayaran',
            'text' => 'Tagihan',
            'url' => 'pembayaran/tagihan',
            'icon' => 'fa fa-fw fa-money-bill',
        ],
        // [
        //     'can' => 'isOperatordinas',
        //     'text' => 'GTT',
        //     'url' => 'apps/gtt',
        //     'icon' => 'fa fa-fw fa-money-bill',
        // ],
        // [
        //     'can' => 'isOperatordinas',
        //     'text' => 'Anggaran',
        //     'url' => 'pengaturan/sumber-anggaran',
        //     'icon' => 'fa fa-fw fa-money-bill',
        // ],
        [
            'can' => ['isPembayaran','isPimpinan'],
            'text' => 'Laporan',
            'url' => '#',
            'icon' => 'fa fa-fw fa-chart-bar',
            'submenu' => [
                [
                    'text' => 'Rekap Kecamatan',
                    'url' => 'pembayaran/laporan/rekap-kecamatan'
                ],
                [
                    'text' => 'Rekap Total',
                    'url' => 'pembayaran/laporan/rekap-total'
                ],
            ]
        ],
        [
            'text'        => 'Gtt',
            'icon'        => 'fa fa-fw fa-file',
            'can' => ['isAdmin','isOperatordinas'],
            'url' =>'master/gtt'
            // 'submenu' => [
                // [
                //     'text' => 'Guru',
                //     'url' => '#',
                //     // 'submenu' => [
                //     //     [
                //     //         'text' => 'Guru',
                //     //         'url' => 'pendaftaran/peserta/guru'
                //     //     ],
                //     //     [
                //     //         'text' => 'Tendik',
                //     //         'url' => 'pendaftaran/peserta/tendik'
                //     //     ],
                //     // ]
                // ],
                // [
                //     'text' => 'Tendik',
                //     'url' => '#',
                //     // 'submenu' => [
                //     //     [
                //     //         'text' => 'Guru',
                //     //         'url' => 'pendaftaran/penilaian/guru'
                //     //     ],
                //     //     [
                //     //         'text' => 'Tendik',
                //     //         'url' => 'pendaftaran/penilaian/tendik'
                //     //     ],
                //     // ]
                // ],
                // [
                //     'text' => 'SK',
                //     'url' => 'apps/sk'
                // ],
            // ]
        ],
        // [
        //     'text'        => 'GTT',
        //     'icon'        => 'fa fa-fw fa-file',
        //     'can' => 'isOperatordinas',
        //     'url' => 'apps/biodata'
        // ],
        // [
        //     'text'        => 'Anggaran',
        //     'icon'        => 'fa fa-fw fa-info',
        //     'can' => 'isOperatordinas',
        //     'url' => 'apps/informasi'
        // ],
        [
            'icon' => 'fa fa-fw fa-money-bill',
            'can' =>['isOperatorsekolah','isAdmin'],
            'text' => 'Kinerja',
            'url' => 'kinerja'
        ],
        [
            'text' => 'Pembayaran',
            'icon' => 'fa fa-fw fa-money-bill',
            'can' =>[ 'isAdmin'],
            'submenu' => [
                [
                    'text' => 'SK',
                    'url' => 'apps/sk'
                ],
                [
                    'text' => 'Tagihan',
                    'url' => 'pembayaran/tagihan'
                ],
                [
                    'text' => 'Laporan',
                    'url' => '#',
                    'submenu' => [
                        [
                            'text' => 'Rekap Kecamatan',
                            'url' => 'pembayaran/laporan/rekap-kecamatan'
                        ],
                        [
                            'text' => 'Rekap Total',
                            'url' => 'pembayaran/laporan/rekap-total'
                        ],
                    ]
                ],
            ]
        ],
        [
            'text'    => 'Master Data',
            'icon'    => 'fas fa-fw fa-archive',
            'can' => 'isAdmin',
            'submenu' => [
                [
                    'text' => 'Instansi',
                    'url'  => 'master/instansi',
                    'can' => 'isAdmin'
                ],
                [
                    'text' => 'Jabatan',
                    'url'  => 'master/jabatan',
                    'can' => 'isAdmin'
                ],
                // [
                //     'text' => 'Formasi',
                //     'url'  => 'master/formasi',
                //     'can' => ['isAdmin', 'isPendaftaran'],
                //     'submenu' => [
                //         [
                //             'text' => 'Formasi APBD List',
                //             'url' => 'master/formasi/apbd'
                //         ],
                //         [
                //             'text' => 'Formasi Dana BOS List',
                //             'url' => 'master/formasi/dana-bos'
                //         ],
                //         [
                //             'text' => 'Formasi APBDDesa List',
                //             'url' => 'master/formasi/apbd-desa'
                //         ],
                //     ]
                // ],
                [
                    'text' => 'Kualifikasi',
                    'url'  => 'master/qualifikasi',
                    'can' => 'isAdmin'
                ],
                [
                    'text'    => 'Wilayah',
                    'can' => 'isAdmin',
                    'submenu' => [
                        [
                            'text' => 'Propinsi',
                            'url'  => 'master/wilayah/provinsi',
                        ],
                        [
                            'text' => 'Kabupaten',
                            'url'  => 'master/wilayah/kabupaten',
                        ],
                        [
                            'text' => 'Kecamatan',
                            'url'  => 'master/wilayah/kecamatan',
                        ],
                        [
                            'text' => 'Desa',
                            'url'  => 'master/wilayah/desa',
                        ]
                    ],
                ],
                [
                    'text'    => 'Penilaian',
                    'can' => 'isAdmin',
                    'submenu' => [
                        [
                            'text' => 'Opsi Penilaian',
                            'url'  => 'master/assesment-option',
                        ],
                        [
                            'text' => 'Nilai Default',
                            'url'  => 'master/assesment-score',
                        ],
                        [
                            'text' => 'Form',
                            'url'  => 'master/assesment-form',
                        ]
                    ],
                ]
            ],
        ],
        [
            'icon' => 'fa fa-fw fa-cogs',
            'text' => 'Pagu',
            'can' => 'isOperatordinas',

            'url' => 'pengaturan/pagu'
        ],
        [
            'text' => 'Pengaturan',
            'icon' => 'fa fa-fw fa-cogs',
            'can' => 'isAdmin',
            'submenu' => [
                [
                    'text' => 'Umum',
                    'url'  => 'pengaturan/umum',
                ],
                [
                    'text' => 'Pengguna',
                    'url'  => 'pengaturan/pengguna',
                ],
                [
                    'text' => 'Pagu',
                    'url' => 'pengaturan/pagu'
                ],
                [
                    'text' => 'Sumber Anggaran',
                    'url' => 'pengaturan/sumber-anggaran'
                ],
            ]
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#83-custom-menu-filters
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#91-plugins
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4@4.0.1/bootstrap-4.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#93-livewire
    */

    'livewire' => false,
];
