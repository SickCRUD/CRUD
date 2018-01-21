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
    public static $actionRequireIdParam = false;

    /**
     * Get the current action name.
     *
     * @return string
     */
    public static function getActionName()
    {
        // get the class that is going to extend
        $sickActionParentClassBasename = basename(get_parent_class(static::class));
        // remove the class suffix if contained to get the action name
        return static::$actionName ?static::$actionName : strtolower(preg_replace('/'. $sickActionParentClassBasename .'$/', '', class_basename(static::class)));
    }

    /**
     * Returns the routes related with the actions.
     *
     * @return array
     */
    public static function getActionRoutes()
    {
        // regex to match for the functions
        $actionFunctionRegexPattern = '/^action(Get|Patch|Post|Put)(.*)/';

        // return an array with the filtered functions
        $actionFunctions = array_values(preg_grep($actionFunctionRegexPattern, get_class_methods(new static())));

        // action routes array
        $actionRoutes = [];

        foreach ($actionFunctions as $actionFunction) {

            // regex to get the values
            preg_match_all($actionFunctionRegexPattern, $actionFunction, $actionRouteMatches);

            // discover the HTTP verb
            $actionRouteMethod = strtolower(reset($actionRouteMatches[1]));

            // get the route name
            $actionRouteName = strtolower(reset($actionRouteMatches[2]));

            // store the routes
            $actionRoutes[] = [
                'function' => $actionFunction,
                'name' => $actionRouteName,
                'method' => $actionRouteMethod,
            ];

        }

        return $actionRoutes;

    }

}