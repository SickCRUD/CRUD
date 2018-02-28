<?php

namespace SickCRUD\CRUD\App\Http\Controllers;

// Laravel
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\App;
// Core imports.
use SickCRUD\CRUD\Core\CrudPanel;
// SickCRUD specific imports.
use SickCRUD\CRUD\Core\Traits\ViewData;

class CrudController extends BaseController
{
    use ValidatesRequests;
    use ViewData;

    /**
     * Declare all the actions of the controllers (array of classes).
     *
     * @var array
     */
    protected $actions = [];

    /**
     * It contains the crud panel object.
     *
     * @var \SickCRUD\CRUD\Core\CrudPanel
     */
    public $crud;

    /**
     * It contains the current request of the CrudController.
     *
     * @var \Illuminate\Http\Request
     */
    public $request;

    /**
     * CrudController constructor.
     */
    public function __construct()
    {
        if (! $this->crud) {
            $this->crud = App::make(CrudPanel::class);
            $this->middleware(function ($request, $next) {
                // set the request where it should be
                $this->setRequest($request);
                // run the setup function
                $this->crudStartup();

                return $next($request);
            });
        }
    }

    /**
     * Magic method to call the action functions.
     *
     * @param string $method
     * @param array  $arguments
     *
     * @return mixed
     *
     * @throws \Exception if the method on the action does not exists or if the the passed class does not extend the action.
     */
    public function __call($method, $arguments)
    {
        // declare the SickCall match pattern
        $action = explode('@', $method, 2);

        // get the calling class
        $actionClass = reset($action);

        // get the calling method
        $actionMethod = end($action);

        // return the actual function of the instantiated action
        $actionInstance =App::make($actionClass);

        // check if there's the ability to call this specific action
        $this->crud->hasAccessToActionOrFail($actionInstance->getName());

        // if the called action does not extend the Action class then throw an exception
        if (! is_subclass_of($actionInstance, \SickCRUD\CRUD\Core\Actions\Action::class)) {
            throw new \Exception('The class ['.$actionClass.'] must extend '.\SickCRUD\CRUD\Core\Actions\Action::class);
        }

        // if the method does not exists then throw an exception
        if (! method_exists($actionInstance, $actionMethod)) {
            throw new \Exception('The action method ['.$actionMethod.'] on the class ['.$actionClass.'] was not found.');
        }

        // build the parameters, passing an instance of the controller
        $parameters = array_merge([$this], $arguments);

        // call the function and pass as parameters an array of arguments, first the controller instance itself
        return call_user_func_array([$actionInstance, $actionMethod], $parameters);
    }

    /**
     * This function allows to setup all the fields ecc...
     *
     * @return void
     */
    public function crudStartup()
    {
    }

    /**
     * Function to get all the actions in the controller.
     *
     * @return array
     */
    public function getActions()
    {
        return (array) $this->actions;
    }

    /**
     * Get the action related routes.
     *
     * @return array
     */
    public function getControllerActionsRoutes()
    {
        $routes = [];

        foreach ($this->actions as $action) {
            // instantiate the current action
            $actionInstance = App::make($action);

            // push the routes
            $routes = array_merge($routes, $actionInstance->getRoutes());

            // unset the instatiated class
            unset($actionInstance);
        }

        return $routes;
    }

    /**
     * Set the request where it should be.
     *
     * @param $request
     *
     * @return void
     */
    public function setRequest($request)
    {
        // if the CRUD exists
        if ($this->crud) {
            $this->crud->request = $request;
        }
    }
}
