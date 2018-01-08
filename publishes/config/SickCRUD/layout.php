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
        ],
        [
            'path' => 'vendor/bootstrap/css/bootstrap.min.css',
            'local' => true
        ],
        [
            'path' => 'css/sick-crud.min.css',
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
        'navbar-fixed' => true,
        'logo' => [
            'text' => [
                'logo-mini' => 'SC',
                'logo-large' => '<b>Sick</b>CRUD'
            ]
        ]

    ],

    /**
     * Here there's a list of plugins that you can disable (they are enabled by default)
     *
     * CssBrowserSelector: Is a plugin without dependencies (js vanilla) for using some CSS rules for specific browsers (should not be touched)
     * jQuery: The main dependency (should not be touched)
     * HideShowPassword: A plugin that adds a show/hide system to the password field
     *
     */
    'optional-plugins' => [
        'CssBrowserSelector',
        'jQuery',
        'HideShowPassword'
    ],

    /**
     * Preinitialized plugins templates Array (name => ['css' => [], 'js' => [])
     */
    'optional-plugins-list'  => [
        'CssBrowserSelector' => [
            'js' => 'vendor/css_browser_selector/js/css_browser_selector.min.js'
        ],
        'jQuery' => [
            'js' => 'vendor/jquery/js/jquery-2.2.4.min.js'
        ],
        'HideShowPassword' => [
            'css' => 'vendor/hideShowPassword/css/hideShowPassword.css',
            'js' => [
                'vendor/hideShowPassword/js/hideShowPassword.min.js',
                'js/HideShowPassword.min.js'
            ]
        ]
    ]

];
