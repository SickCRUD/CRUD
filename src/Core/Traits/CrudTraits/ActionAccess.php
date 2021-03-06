<?php

namespace SickCRUD\CRUD\Core\Traits\CrudTraits;

use SickCRUD\CRUD\Core\Exceptions\AccessDeniedException;

trait ActionAccess
{
    /**
     * It contains the allowed actions to execute.
     *
     * @var array
     */
    public $actionAccess = [];

    /**
     *  Allows one or more actions to execute.
     *
     * @param array|string $actionNames
     *
     * @return array
     */
    public function allowActionAccess($actionNames)
    {
        // string to array conversion
        $actionNames = (array)$actionNames;

        return $this->actionAccess = array_merge(array_diff((array) $actionNames, $this->actionAccess), $this->actionAccess);
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
     * @param string|array $actionNames
     *
     * @return array
     */
    public function denyActionAccess($actionNames)
    {
        // string to array conversion
        $actionNames = (array)$actionNames;

        return $this->actionAccess = array_diff($this->actionAccess, (array) $actionNames);
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
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function hasAccessToActionOrFail($actionName)
    {
        if (! $this->hasAccessToAction($actionName)) {
            throw new AccessDeniedException(trans('backpack::crud.unauthorized_access'));
        }

        return true;
    }
}
