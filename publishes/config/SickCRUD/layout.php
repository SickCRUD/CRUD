<?php

return [

    /*
     * --------------------------------------------------------------------------
     * SickCRUD\CRUD Layout preferences
     * --------------------------------------------------------------------------
     */

    /**
     * Page title settings, this can be overwritten from the /resources/views/vendor/SickCRUD/layout/partials/title.blade.php view
     */
    'page-title' => [
        // specify the title format, try to change it to '%title v2'
        'title-format' => '%title',
        // specify the title separator, 'MyAwesomeTitle - SickCRUD' where '-' is the separator
        'title-separator' => '-',
        // specify the suffix for the title after the separator
        'title-suffix' => 'SickCRUD'
    ],

    /**
     * Styles to include globally into the layout
     */
    'styles' => [
        [
            // this path can be a local path or eventually a CDN link
            'path' => 'ciao/custom.css',
            // set local true if you want to wrap the path up with the asset() function, the default value is true
            'local' => true
        ]
    ],

    /**
     * Styles to include globally into the layout
     */
    'scripts' => [
        [
            // this path can be a local path or eventually a CDN link
            'path' => 'ciao/custom.js',
            // set local true if you want to wrap the path up with the asset() function, the default value is true
            'local' => true
        ]
    ],

    /**
     * Navbar settings
     */
    'navbar' => [
        'navbar-fixed' => false,
        'logo' => [
            'text' => [
                'logo-mini' => 'SC',
                'logo-large' => '<b>Sick</b>CRUD'
            ]
        ]

    ]

];
