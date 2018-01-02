<?php

namespace SickCRUD\CRUD\Core\Actions;


class Action
{
    protected $actionName = '';
    protected $actionRequests = [];

    public function __construct()
    {
        foreach ($this->actionRequests as $actionRequest) {
            //
        }
    }

    public function getActionName()
    {
        // get the class that is going to extend
        $parentClassBasename = basename(get_parent_class($this));
        // remove the class suffix if contained to get the action name
        return $this->actionName ?$this->actionName : strtolower(preg_replace('/'. $parentClassBasename .'$/', '', class_basename($this)));
    }

}