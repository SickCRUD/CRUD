<?php

namespace SickCRUD\CRUD\Core\Actions;

abstract class Action
{
    /**
     * Define the action name, if null then class name will be used.
     *
     * @var null|string
     */
    protected $actionName = null;

    /**
     * Define if the current actions need to take the id in the route.
     *
     * @var bool
     */
    public $actionRequireIdParam = false;

    /**
     * Define if the current action needs a prefix in it's route.
     *
     * @var bool
     */
    public $actionPrefixRoute = false;

    /**
     * Get the current action name.
     *
     * @return string
     */
    public function getActionName()
    {
        // get the class that is going to extend
        $actionParentClassBasename = basename(get_parent_class(static::class));
        // remove the class suffix if contained to get the action name
        return $this->actionName ? $this->actionName : strtolower(str_replace($actionParentClassBasename, '', class_basename(static::class)));
    }

    /**
     * Returns the routes related with the actions, used by the CrudRouter.
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
