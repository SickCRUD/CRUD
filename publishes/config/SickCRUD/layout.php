<?php

return [

    /*
     * --------------------------------------------------------------------------
     * SickCRUD\CRUD Layout preferences
     * --------------------------------------------------------------------------
     */

    /*
     * Page title settings, this can be overwritten from the /resources/views/vendor/SickCRUD/layout/partials/title.blade.php view
     */
    'page-title' => [
        // specify the title format, try to change it to '%title v2'
        'title-format' => '%title',
        // specify the title separator, 'MyAwesomeTitle - SickCRUD' where '-' is the separator
        'title-separator' => '-',
        // specify the suffix for the title after the separator
        'title-suffix' => 'SickCRUD',
    ],

    /*
     *  All the available skins lass
     *
     *  skin-blue, skin-blue-light
     *  skin-yellow, skin-yellow-light
     *  skin-green, skin-green-light
     *  skin-purple, skin-purple-light
     *  skin-red, skin-red-light
     *  skin-black, skin-black-light
     */
    'css-skin' => 'skin-purple',

    /*
     * Navbar settings
     */
    'navbar' => [
        'navbar-fixed' => true,
        'logo' => [
            'text' => [
                'logo-mini' => 'SC',
                'logo-large' => '<b>Sick</b>CRUD',
            ],
        ],

    ],

    /*
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
        'HideShowPassword',
    ],

    /*
     * Preinitialized plugins templates Array (name => ['css' => [], 'js' => [])
     */
    'optional-plugins-list'  => [
        'CssBrowserSelector' => [
            'js' => 'vendor/css_browser_selector/js/css_browser_selector.min.js',
        ],
        'jQuery' => [
            'js' => 'vendor/jquery/js/jquery-2.2.4.min.js',
        ],
        'HideShowPassword' => [
            'css' => 'vendor/hideShowPassword/css/hideShowPassword.css',
            'js' => [
                'vendor/hideShowPassword/js/hideShowPassword.min.js',
                'js/HideShowPassword.min.js',
            ],
        ],
    ],

];
