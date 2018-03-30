<?php

namespace SickCRUD\CRUD;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use SickCRUD\CRUD\App\Http\Middleware\ForceHttps;
use SickCRUD\CRUD\Core\Console\CrudInstallCommand;
use SickCRUD\CRUD\Core\CrudPanel;

class SickCrudServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Route files to include.
     *
     * @var array
     */
    protected $routeFiles = [
        '/routes/SickCRUD/routes.php',
    ];

    /**
     * Perform post-registration booting of services.
     *
     * @param \Illuminate\Routing\Router $router
     * @return void
     */
    public function boot(Router $router)
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

        // LOAD MIDDLEWARES
        $this->loadMiddlewares($router);

        // Set the default schema string length if necessary
        if (SickCRUD_config('crud', 'change-schema-string-length') === true) {
            $this->setSchemaStringLength();
        }
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
                CrudInstallCommand::class,
            ]);
        }

        // bind the SickCRUD instance
        $this->app->bind('SickCRUD', function ($app) {
            return new SickCRUD($app);
        });

        // bind the CRUD instance
        $this->app->bind('CRUDPanel', function () {
            return new CRUDPanel();
        });
    }

    /**
     * Router function to build the routes.
     *
     * @return \SickCRUD\CRUD\CrudRouter;
     */
    public static function resource($name, $controller, array $options = [])
    {
        return new CrudRouter($name, $controller, $options);
    }

    /**
     * Set schema length.
     *
     * @return void
     */
    public function setSchemaStringLength()
    {
        \Schema::defaultStringLength(191);
    }

    /**
     * Assets publishing.
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

    /**
     * Languages loading.
     *
     * @return void
     */
    public function loadLang()
    {
        // LOADING LANG

        $this->loadTranslationsFrom(realpath(dirname(__DIR__, 1).'/publishes/resources/lang'), 'SickCRUD');
    }

    /**
     * Views loading.
     *
     * @return void
     */
    public function loadViews()
    {
        // LOADING VIEWS

        // after the package published views
        $this->loadViewsFrom(resource_path('views/vendor/SickCRUD'), 'SickCRUD');
        // after the package un-published views
        $this->loadViewsFrom(realpath(dirname(__DIR__, 1).'/publishes/resources/views'), 'SickCRUD');
    }

    /**
     * Config loading.
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
            dirname(__DIR__, 1).'/publishes/config/SickCRUD/general.php',
            'SickCRUD.general'
        );
        $this->mergeConfigFrom(
            dirname(__DIR__, 1).'/publishes/config/SickCRUD/layout.php',
            'SickCRUD.layout'
        );
    }

    /**
     * Routes loading.
     *
     * @return void
     */
    public function loadRoutes()
    {
        foreach ($this->routeFiles as $routeFile) {
            $routeFileToInclude = __DIR__.$routeFile;
            // if the files exists outside the package
            if (file_exists(base_path().$routeFile)) {
                $routeFileToInclude = base_path().$routeFile;
            }
            $this->loadRoutesFrom($routeFileToInclude);
        }
    }

    /**
     * Middleware loading.
     *
     * @param \Illuminate\Routing\Router $router
     * @return void
     */
    public function loadMiddlewares(Router $router)
    {
        $router->aliasMiddleware('ForceHttps', ForceHttps::class);
    }
}
