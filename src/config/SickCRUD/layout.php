<?php

return [

    /*
     * --------------------------------------------------------------------------
     * SickCRUD\CRUD Layout preferences
     * --------------------------------------------------------------------------
     */

    'test-setting' => true,

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
