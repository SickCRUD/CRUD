<?php


Route::group(
    [
        'namespace' => 'SickCRUD\CRUD\App\Http\Controllers',
        'middleware' => [
            'web',
            'ForceHttps'
        ]
    ],
    function () {

        // if is strictly trues
        if(SickCRUD_config('crud', 'setup-auth-routes') == true) {
            // authentication
            Route::get('login', [
                'as' => 'SickCRUD.auth.login',
                'uses' => 'Auth\LoginController@show'
            ]);
            Route::post('login', 'Auth\LoginController@login');
            Route::get('logout', [
                'as' => 'SickCRUD.auth.logout',
                'uses' => 'Auth\LoginController@logout'
            ]);
            Route::post('logout', 'Auth\LoginController@logout');

        }

        // registration
        if(SickCRUD_config('crud', 'setup-register-routes') == true) {
            Route::get('register', [
                'as' => 'SickCRUD.auth.register',
                'uses' => 'Auth\RegisterController@show'
            ]);
            Route::post('register', 'Auth\RegisterController@login');
        }

    }
);