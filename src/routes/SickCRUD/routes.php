<?php


Route::group(
    [
        'middleware' => [
            'web',
            'ForceHttps'
        ],
        'namespace' => 'SickCRUD\CRUD\App\Http\Controllers',
        'prefix' => SickCRUD_config('crud', 'route-prefix')
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
            Route::post('register', 'Auth\RegisterController@register');
        }

    }
);
