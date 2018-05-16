<?php
/**
 * Created by PhpStorm.
 * User: Demon Warlock
 * Date: 5/11/2018
 * Time: 6:49 PM
 */
return array(

    'javascript' => [
        'jquery',
        'nicescroll',
        'jquery-ui',
        'slimscroll',
        'bootstrap',
        'form',
        'eakroko',
        'application',
        'demonstration',
        'toastr',
        'core'
    ],
    'stylesheets' => [
        'bootstrap',
        'jquery-ui',
        'core',
        'themes',
        'toastr'
    ],
    'resources' => [
        'javascript' => [
            'jquery' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/js/jquery.min.js',
                ],
            ],
            'nicescroll' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/js/plugins/nicescroll/jquery.nicescroll.min.js',
                ],
            ],
            'jquery-ui' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/js/plugins/jquery-ui/jquery-ui.js',
                ],
            ],
            'slimscroll' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/js/plugins/slimscroll/jquery.slimscroll.min.js',
                ],
            ],
            'validation' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => [
                        'js/plugins/validation/jquery.validate.min.js',
                        'js/plugins/validation/additional-methods.min.js'
                    ]
                ],
            ],
            'icheck' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => 'js/plugins/icheck/jquery.icheck.min.js'
                ]
            ],
            'bootstrap' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/js/bootstrap.min.js',
                ],
            ],
            'form' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/js/plugins/form/jquery.form.min.js',
                ],
            ],
            'toastr' => [
                'use_cdn' => true,
                'location' => 'bottom',
                'src' => [
                    'local' => '/js/plugins/toastr/toastr.min.js',
                    'cdn' => '//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.2/toastr.min.js',
                ],
            ],
            'eakroko' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/js/eakroko.js',
                ],
            ],
            'application' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/js/application.min.js',
                ],
            ],
            'demonstration' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/js/demonstration.min.js"',
                ],
            ],
            'core' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/js/core.js',
                ],
            ],
        ],
        'stylesheets' => [
            'bootstrap' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => '/css/bootstrap.min.css',
                ],
            ],
            'icheck' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => '/css/plugins/icheck/all.css',
                ],
            ],
            'jquery-ui' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => '/css/plugins/jquery-ui/jquery-ui.min.css',
                ],
            ],
            'toastr' => [
                'use_cdn' => true,
                'location' => 'top',
                'src' => [
                    'local' => '/css/plugins/toastr/toastr.min.css',
                    'cdn' => '//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.2/toastr.min.css',
                ],
            ],
            'core' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => '/css/style.css',
                ],
            ],
            'themes' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => '/css/themes.css',
                ],
            ],
        ],
    ]
);