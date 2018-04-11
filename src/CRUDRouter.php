<?php

namespace SickCRUD\CRUD;

// Laravel
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

class CrudRouter
{
    /**
     * Route name parameter.
     * @var null|string
     */
    protected $name = null;
    /**
     * Controller name parameter.
     * @var null|string
     */
    protected $controller = null;
    /**
     * Extra routes array.
     * @var array
     */
    protected $extraRoutes = [];

    /**
     * CrudRouter constructor, it declares all the route inside the controller actions.
     *
     * @param string $name
     * @param string $controller
     */
    public function __construct($name, $controller)
    {
        $this->name = $name;
        $this->controller = $controller;

        // get the last element of the stack
        $lastRouteOfStack = $this->getLastRouteOfStack();

        // build the element namespace
        $controllerFqn = $this->buildFqn($lastRouteOfStack['namespace'], $this->controller);

        // get the actions of the controller
        $controllerActions = $this->getControllerActions($controllerFqn);

        // cycle the routes of the action
        foreach ($controllerActions as $controllerAction) {

            // build action instance
            $controllerActionInstance = App::make($controllerAction);

            foreach ($controllerActionInstance->getRoutes() as $route) {

                // optional id / route controller name / route action name
                $routePath = ($controllerActionInstance->requireIdParam == true ? '{id?}' : '').'/'.$this->name.($controllerActionInstance->routePrefix == true ? '/'.$controllerActionInstance->getName() : '').'/'.$route['name'];

                // controller method
                $controllerMethod = '\\'.ltrim($controllerAction, '\\').'@'.$route['function'];

                // declare the route options
                $routeOptions = [
                    'uses' => $controllerFqn.'@'.$controllerMethod,
                ];

                // declare the route name
                $routeName = 'SickCRUD.'.$this->name.($controllerActionInstance->routePrefix == true ? '.'.$controllerActionInstance->getName() : '').($route['name'] ? '.'.$route['name'] : null);

                // name them just once
                if (! Route::has($routeName)) {
                    $routeOptions['as'] = $routeName;
                }

                // declare the route
                Route::{$route['method']}($routePath, $routeOptions);
            }

            // destroy action instance
            unset($controllerActionInstance);
        }
    }

    /**
     * Get the controller actions.
     *
     * @param string $controllerFqn
     *
     * @return array
     */
    public function getControllerActions(string $controllerFqn)
    {
        // we build an instance of the controller
        $controllerInstance = App::make($controllerFqn);

        // store the actions
        $controllerActions = $controllerInstance->getActions();

        // frees the controller instance
        unset($controllerInstance);

        // controller actions
        return $controllerActions;
    }

    /**
     * Get the last route from router.
     *
     * @return mixed
     */
    public function getLastRouteOfStack()
    {
        // get the route group stack
        $routeGroupStack = Route::getGroupStack();

        // get the last element of the stack
        $lastRouteOfStack = end($routeGroupStack);

        return $lastRouteOfStack;
    }

    /**
     * Build the fully qualified class name.
     *
     * @param string $namespace
     * @param string $class
     * @return string
     */
    protected function buildFqn(string $namespace, string $class)
    {
        return '\\'.ltrim(($namespace.'\\'.$class), '\\');
    }

    /**
     * Call other methods in this class, that register extra routes.
     * From: @see https://github.com/Laravel-Backpack/CRUD/blob/master/src/CrudRouter.php#L84
     *
     * @param mixed $injectables
     *
     * @return mixed
     */
    public function with($injectables)
    {
        if (is_string($injectables)) {
            $this->extraRoutes[] = 'with'.ucwords($injectables);
        } elseif (is_array($injectables)) {
            foreach ($injectables as $injectable) {
                $this->extraRoutes[] = 'with'.ucwords($injectable);
            }
        } else {
            $reflection = new \ReflectionFunction($injectables);

            if ($reflection->isClosure()) {
                $this->extraRoutes[] = $injectables;
            }
        }

        return $this->registerExtraRoutes();
    }

    /**
     * Register the routes that were passed using the "with" syntax.
     * From: @see https://github.com/Laravel-Backpack/CRUD/blob/master/src/CrudRouter.php#L112
     *
     * @return void
     */
    private function registerExtraRoutes()
    {
        // group with a prefix
        Route::group(
            [
                'prefix' => $this->name,
            ],
            function () {

                // cycle and call all the functions
                foreach ($this->extraRoutes as $route) {
                    if (is_string($route)) {
                        $this->{$route}();
                    } else {
                        $route();
                    }
                }
            }
        );
    }

    /**
     * Call eventual CrudRouter methods.
     * From: @see https://github.com/Laravel-Backpack/CRUD/blob/master/src/CrudRouter.php#L123
     *
     * @return void
     */
    public function __call($method, $parameters = null)
    {
        if (method_exists($this, $method)) {
            $this->{$method}($parameters);
        }
    }
}
