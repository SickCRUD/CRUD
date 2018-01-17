<?php

namespace SickCRUD\CRUD\Core\Actions;

class Action
{
    /**
     * Define the action name.
     *
     * @var string
     */
    protected static $actionName = '';

    /**
     * Define if the current actions need to take the id in the route.
     *
     * @var bool
     */
    public static $requireIdParam = false;

    /**
     * Get the current action name.
     *
     * @return string
     */
    public static function getActionName()
    {
        // get the class that is going to extend
        $parentClassBasename = basename(get_parent_class(static::class));
        // remove the class suffix if contained to get the action name
        return static::$actionName ?static::$actionName : strtolower(preg_replace('/'. $parentClassBasename .'$/', '', class_basename(static::class)));
    }

    /**
     * Returns the routes related with the actions.
     *
     * @return array
     */
    public static function getActionRoutes()
    {
        // regex to match for the functions
        $sickActionRoutePattern = '/^action(Get|Patch|Post|Put)(.*)/';

        // return an array with the filtered functions
        $sickActionRouteFunctions = array_values(preg_grep($sickActionRoutePattern, get_class_methods(new static())));

        // action routes array
        $sickActionRoutes = [];

        foreach ($sickActionRouteFunctions as $sickActionRouteFunction) {

            // regex to get the values
            preg_match_all($sickActionRoutePattern, $sickActionRouteFunction, $sickActionRouteMatch);

            // discover the HTTP verb
            $routeMethod = strtolower(reset($sickActionRouteMatch[1]));

            // get the route name
            $routeName = strtolower(reset($sickActionRouteMatch[2]));

            // store the routes
            $sickActionRoutes[] = [
                'function' => $sickActionRouteFunction,
                'name' => $routeName,
                'method' => $routeMethod,
            ];

        }

        return $sickActionRoutes;

    }

}