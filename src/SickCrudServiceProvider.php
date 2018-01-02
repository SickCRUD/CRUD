<?php

namespace SickCRUD\CRUD;

use Illuminate\Support\ServiceProvider;
use SickCRUD\CRUD\Core\Console\CrudPublishCommand;

class SickCrudServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Route files to include
     *
     * @var array
     */
    protected $routeFiles = [
        '/routes/SickCRUD/routes.php'
    ];

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {

        // LOAD PUBLISHES
        $this->loadPublishes();

        // LOAD LANG
        $this->loadLang();

        // LOAD VIEWS
        $this->loadViews();

        // LOAD CONFIG
        $this->loadConfig();

        // LOAD ROUTES
        $this->loadRoutes();

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // COMMANDS

        // if the app is in console
        if ($this->app->runningInConsole()) {
            $this->commands([
                CrudPublishCommand::class,
            ]);
        }

        // bind the CRUD instance
        $this->app->bind('SickCRUD', function ($app) {
            return new SickCRUD($app);
        });

    }

    /**
     * Assets publishing
     *
     * @return void
     */
    public function loadPublishes()
    {
        // PUBLISHES

        // config
        $this->publishes([dirname(__DIR__, 1).'/publishes/config' => config_path()], 'config');
        // views
        $this->publishes([dirname(__DIR__, 1).'/publishes/resources/views' => resource_path('views/vendor/SickCRUD')], 'views');
        // public
        $this->publishes([dirname(__DIR__, 1).'/publishes/public' => public_path()], 'public');
    }

    public function loadLang()
    {
        // LOADING LANG

        $this->loadTranslationsFrom(realpath(dirname(__DIR__, 1).'/publishes/resources/lang'), 'SickCRUD');
    }

    /**
     * Views loading
     *
     * @return void
     */
    public function loadViews()
    {
        // LOADING VIEWS

        // after the package published views
        $this->loadViewsFrom(resource_path('views/vendor/SickCRUD'), 'SickCRUD');
        // after the package un-published views
        $this->loadViewsFrom(realpath(dirname(__DIR__, 1) . '/publishes/resources/views'), 'SickCRUD');
    }

    /**
     * Config loading
     *
     * @return void
     */
    public function loadConfig()
    {
        // use the package config
        $this->mergeConfigFrom(
            dirname(__DIR__, 1).'/publishes/config/SickCRUD/crud.php',
            'SickCRUD.crud'
        );
        $this->mergeConfigFrom(
            dirname(__DIR__, 1).'/publishes/config/SickCRUD/layout.php',
            'SickCRUD.layout'
        );
    }

    /**
     * Routes loading
     *
     * @return void
     */
    public function loadRoutes()
    {
        foreach ($this->routeFiles as $routeFile) {
            $routeFileToInclude = __DIR__ . $routeFile;
            // if the files exists outside the package
            if(file_exists(base_path().$routeFile)) {
                $routeFileToInclude = base_path().$routeFile;
            }
            $this->loadRoutesFrom($routeFileToInclude);
        }
    }

}
