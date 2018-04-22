<?php
namespace SickCRUD\CRUD\Core;

use SickCRUD\CRUD\Core\Traits\CrudTraits\ActionAccess;
use SickCRUD\CRUD\Core\Traits\CrudTraits\Read;
use SickCRUD\CRUD\Core\Traits\CrudTraits\ViewData;

class CRUDPanel
{
    use ActionAccess, Read, ViewData;

    /**
     * It contains the current requested entry.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $entry = null;

    /**
     * Define the current CRUD model.
     *
     * @var mixed
     */
    public $model = '\App\UnexistingModel';

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