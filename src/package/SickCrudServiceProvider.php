<?php

namespace SickCRUD\CRUD\Package;

use Illuminate\Support\ServiceProvider;
use SickCRUD\CRUD\Package\Console\CrudPublishCommand;

class SickCrudServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // COMMANDS

        // if the app is in console
        if ($this->app->runningInConsole()) {
            $this->commands([
                CrudPublishCommand::class,
            ]);
        }

        // LOAD PUBLISHES
        $this->loadPublishes();

        // LOAD VIEWS
        $this->loadViews();

        // LOAD CONFIG
        $this->loadConfig();

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // bind the CRUD instance
        $this->app->bind('SickCRUD', function ($app) {
            return new SickCRUD($app);
        });

        // register dependencies
        // $this->app->register(\Collective\Html\HtmlServiceProvider::class);

        // register alias for each dependency
        // $aliasLoader = \Illuminate\Foundation\AliasLoader::getInstance();
        // $aliasLoader->alias('Form', \Collective\Html\FormFacade::class);
        // $aliasLoader->alias('Html', \Collective\Html\HtmlFacade::class);
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
        $this->publishes([__DIR__.'/../config' => config_path()], 'config');
        // views
        $this->publishes([__DIR__.'/../publishes/resources/views' => resource_path('views/vendor/SickCRUD')], 'views');
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
        $this->loadViewsFrom(realpath(__DIR__ . '/../publishes/resources/views'), 'SickCRUD');
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
            __DIR__.'/../publishes/config/SickCRUD/crud.php',
            'SickCRUD.crud'
        );
        $this->mergeConfigFrom(
            __DIR__.'/../publishes/config/SickCRUD/layout.php',
            'SickCRUD.layout'
        );
    }

}
