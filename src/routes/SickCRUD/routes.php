<?php


Route::group(
    [
        'namespace' => 'SickCRUD\CRUD\App\Http\Controllers',
        'middleware' => 'web'
    ],
    function () {

        // if is strictly trues
        if(SickCRUD_config('crud', 'setup-auth-routes') == true) {
            Route::get('login', 'Auth\LoginController@show')->name('SickCRUD.auth.login');
            Route::post('login', 'Auth\LoginController@login');
            Route::get('logout', 'Auth\LoginController@logout')->name('SickCRUD.auth.logout');
            Route::post('logout', 'Auth\LoginController@logout');
        }

    }
);