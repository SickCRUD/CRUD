<?php

namespace SickCRUD\CRUD\Core\Traits\CrudTraits;

trait ActionAccess
{
    /**
     * The permissions for each action
     *
     * @var array
     */
    protected $actionAccess = [];

    /**
     *  Allows a specific action to execute.
     *
     * @param $actionName
     *
     * @return array
     */
    public function allowAction($actionName)
    {
        return $this->actionAccess = array_merge(array_diff((array) $actionName, $this->actionAccess), $this->actionAccess);
    }

    /**
     * Return all the allowed actions.
     *
     * @return array
     */
    public function allowedAccesses()
    {
        return $this->actionAccess;
    }

    /**
     *  Denies a specific action to execute.
     *
     * @param $actionName
     *
     * @return array
     */
    public function denyAction($actionName)
    {
        return $this->actionAccess = array_diff($this->actionAccess, (array) $actionName);
    }

    /**
     *  Check if the action is allowed to execute.
     *
     * @param $actionName
     *
     * @return bool
     */
    public function hasAccessToAction($actionName)
    {
        if (! in_array($actionName, $this->actionAccess)) {
            return false;
        }
        return true;
    }

    /**
     * Check if tha action can be executed, if not than throw exception.
     *
     * @param string $actionName
     * @return bool
     *
     * @throws \Exception
     */
    public function hasAccessToActionOrFail($actionName)
    {
        if (! $this->hasAccessToAction($actionName)) {
            throw new \Exception(trans('backpack::crud.unauthorized_access'));
        }
        return true;
    }

}