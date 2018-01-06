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
            Route::get('login', 'Auth\LoginController@show')->name('SickCRUD.auth.login');
            Route::post('login', 'Auth\LoginController@login');
            Route::get('logout', 'Auth\LoginController@logout')->name('SickCRUD.auth.logout');
            Route::post('logout', 'Auth\LoginController@logout');

            // registration
            if(SickCRUD_config('crud', 'setup-register-routes') == true) {
                Route::get('register', 'Auth\RegisterController@show')->name('SickCRUD.auth.register');
                Route::post('register', 'Auth\RegisterController@login');
            }

        }

    }
);