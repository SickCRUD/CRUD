<?php

namespace SickCRUD\CRUD\App\Http\Controllers;

class CrudController extends BaseController
{
    /**
     * Declare all the actions of the controllers (array of classes).
     *
     * @var array
     */
    protected static $actions = [];

    /**
     * CrudController constructor.
     */
    public function __construct()
    {

    }

    /**
     * Magic method to call the action functions.
     *
     * @param string $method
     * @param array  $arguments
     *
     * @return mixed
     * @throws \Exception if the method on the action does not exists.
     */
    public function __call($method, $arguments) {

        // declare the SickCall match pattern
        $sickCallPattern = '/SickCall_(.*)@(.*)/';

        // extract the results
        preg_match_all($sickCallPattern, $method, $sickCallMatches);

        // get the calling class
        $sickCallActionClass = reset($sickCallMatches[1]);

        // get the calling method
        $sickCallActionMethod = reset($sickCallMatches[2]);

        // return the actual function of the instanciated action
        $sickCallActionInstance = (new $sickCallActionClass);

        if(!method_exists($sickCallActionInstance, $sickCallActionMethod)){

            throw new \Exception('The action method [' . $sickCallActionMethod . '] on the class [' . $sickCallActionClass . '] was not found.');

        }

        return $sickCallActionInstance->{$sickCallActionMethod}($this);

    }

    /**
     * Static function to get all the actions in the controller.
     *
     * @return array
     */
    public static function getControllerActions()
    {
        return (array)static::$actions;
    }

    /**
     * Get the action related routes.
     *
     * @return array
     */
    public static function getControllerActionsRoutes()
    {
        $routes = [];
        foreach (static::$actions as $action) {
            $routes = array_merge($routes, $action::getRoutes());
        }
        return $routes;
    }

}