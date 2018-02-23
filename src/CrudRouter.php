<?php

namespace SickCRUD\CRUD;

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
     *
     * @return void
     */
    public function __construct($name, $controller)
    {
        $this->name = $name;
        $this->controller = $controller;

        // get the route group stack
        $routeGroupStack = \Route::getGroupStack();

        // get the last element of the stack
        $lastRouteGroupStack = end($routeGroupStack);

        // build the element namespace
        $controllerNamespaceName = ($lastRouteGroupStack['namespace'].'\\'.$this->controller);

        // get the actions of the controller
        $controllerActions = $controllerNamespaceName::getControllerActions();

        // cycle the actions
        foreach ($controllerActions as $controllerAction) {

            // cycle the routes of the action
            foreach ($controllerAction::getActionRoutes() as $route) {

                // optional id / route controller name / route action name
                $routePath = ($controllerAction::$actionRequireIdParam == true ? '{id?}' : '').'/'.$this->name.($controllerAction::$actionPrefixRoute == true ? '/'.$controllerAction::getActionName() : '').'/'.$route['name'];

                // controller fqn
                $controllerFqn = '\\'.ltrim($controllerNamespaceName, '\\');

                // controller method
                $controllerMethod = '\\'.ltrim($controllerAction, '\\').'@'.$route['function'];

                // declare the route options
                $routeOptions = [
                    'uses' => $controllerFqn.'@'.$controllerMethod,
                ];

                // declare the route name
                $routeName = 'SickCRUD.'.$this->name.($controllerAction::$actionPrefixRoute == true ? '.'.$controllerAction::getActionName() : '').($route['name'] ? '.'.$route['name'] : null);

                // name them just once
                if (! \Route::has($routeName)) {
                    $routeOptions['as'] = $routeName;
                }

                // declare the route
                \Route::{$route['method']}($routePath, $routeOptions);
            }
        }
    }

    /**
     * Call other methods in this class, that register extra routes.
     * From: https://github.com/Laravel-Backpack/CRUD/blob/master/src/CrudRouter.php#L84.
     *
     * @param mixed $injectables
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
     * From: https://github.com/Laravel-Backpack/CRUD/blob/master/src/CrudRouter.php#L112.
     *
     * @return void
     */
    private function registerExtraRoutes()
    {
        foreach ($this->extraRoutes as $route) {
            if (is_string($route)) {
                $this->{$route}();
            } else {
                $route();
            }
        }
    }
}
