<?php

namespace SickCRUD\CRUD;

class CrudRouter
{

    protected $name = null;
    protected $controller = null;

    public function __construct($name, $controller)
    {
        $this->name = $name;
        $this->controller = $controller;

        // get the route group stack
        $routeGroupStack = \Route::getGroupStack();

        // get the last element of the stack
        $lastRouteGroupStack = end($routeGroupStack);

        // build the element namespace
        $controllerNamespaceName = ($lastRouteGroupStack['namespace'] . '\\' . $this->controller);

        // get the actions of the controller
        $controllerActions = $controllerNamespaceName::getControllerActions();

        foreach ($controllerActions as $controllerAction) {

            foreach ($controllerAction::getActionRoutes() as $route) {

                // optional id / route controller name / route action name
                $routePath = ($controllerAction::$actionRequireIdParam==true?'{id?}':'') . '/' . $this->name . '/' . $route['name'];

                // controller fqn
                $controllerFqn =  '\\' . ltrim($controllerNamespaceName, '\\');

                // controller method
                $controllerMethod ='\\' . ltrim($controllerAction, '\\') . '@' . $route['function'];

                // declare the route options
                $routeOptions = [
                    'uses' => $controllerFqn . '@' . $controllerMethod
                ];

                // declare the route name
                $routeName = 'SickCRUD.' . $this->name . '.' . $route['name'];

                // name them just once
                if(!\Route::has($routeName)) {
                    $routeOptions['as'] = $routeName;
                }

                // declare the route
                \Route::{$route['method']}($routePath, $routeOptions);

            }

        }

    }

}