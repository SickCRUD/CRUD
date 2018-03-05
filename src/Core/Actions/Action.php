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
     * Define if the current actions need to take the id in the route ({?id}).
     *
     * @var bool
     */
    public $actionRequireIdParam = false;

    /**
     * Define if the current action needs a prefix in it's route (it will be prefixed with the $actionName).
     *
     * @var bool
     */
    public $actionRoutePrefix = false;

    /**
     * Get the current action name.
     *
     * @return string
     */
    public function getName()
    {
        // get the class that is going to extend
        $actionParentClassBasename = substr(strrchr(get_parent_class(static::class), '\\'), 1);
        // remove the class suffix if contained to get the action name
        return $this->actionName ? $this->actionName : strtolower(str_replace($actionParentClassBasename, '', class_basename(static::class)));
    }

    /**
     * Returns the routes related with the action, used by the CrudRouter to make the routes.
     * TODO: Make this function static?
     *
     * @return array
     */
    public function getRoutes()
    {
        // regex to match for the functions
        $actionFunctionRegexPattern = '/^action(Get|Patch|Post|Put)(.*)/';

        // return an array with the filtered functions
        $actionFunctions = array_values(preg_grep($actionFunctionRegexPattern, get_class_methods(static::class)));

        // action routes array
        $actionRoutes = [];

        // cycle the routes
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
                'method' => $actionRouteMethod,
                'name' => $actionRouteName ? $actionRouteName : false,
            ];
        }

        return $actionRoutes;
    }
}
