<?php

namespace SickCRUD\CRUD;

use Illuminate\Support\ServiceProvider;
use SickCRUD\CRUD\Console\CrudPublishCommand;

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
                CrudPublishCommand::class
            ]);
        }


        // PUBLISHES

        // config
        $this->publishes([__DIR__. '/config' => config_path()], 'config');

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
        $this->app->register(\Collective\Html\HtmlServiceProvider::class);

        // register alias for each dependency
        $aliasLoader = \Illuminate\Foundation\AliasLoader::getInstance();
        $aliasLoader->alias('Form', \Collective\Html\FormFacade::class);
        $aliasLoader->alias('Html', \Collective\Html\HtmlFacade::class);

    }

}