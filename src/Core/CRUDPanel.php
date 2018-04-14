<?php
namespace SickCRUD\CRUD\Core;

use SickCRUD\CRUD\Core\Traits\CrudTraits\ActionAccess;
use SickCRUD\CRUD\Core\Traits\CrudTraits\Read;

class CRUDPanel
{
    use ActionAccess, Read;

    /**
     * It contains the allowed actions to execute.
     *
     * @var array
     */
    public $actionAccess = [];

    /**
     * It contains the current requested entry.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $entry;

    /**
     * Define the current CRUD model.
     *
     * @var mixed
     */
    public $model = '\App\UnexistingModel';

    /**
     * It contains the current query to be executed.
     *
     * @var mixed
     */
    public $query = false;

    /**
     * It stores the current request.
     *
     * @var \Illuminate\Http\Request
     */
    public $request;

    /**
     * Get the current used model from CrudPanel.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the current Model that will be used for the CRUD.
     *
     * @param string $modelNamespace
     *
     * @throws \Exception if the model doesn't exists.
     */
    public function setModel($modelNamespace)
    {
        if (!class_exists($modelNamespace)) {
            throw new \Exception('This model does not exist.', 404);
        }
        $this->model = new $modelNamespace();
    }

}