<?php

namespace SickCRUD\CRUD\Core\Actions;

use SickCRUD\CRUD\Core\Traits\ViewData;

class ListAction extends Action
{
    use ViewData;

    /**
     * The action name to reference for permissions.
     *
     * @var string
     */
    protected $actionName = null;

    /**
     * The HTTP requests supported (piped|piped).
     *
     * @var string|array
     */
    protected $actionRequests = [
        'post',
        'get',
    ];

    /**
     * This function will handle the bulk action.
     *
     * @param $id
     */
    public function handleList($id)
    {
    }

    public function getList()
    {
        return View::make('SickCRUD::layout.layout');
    }

    public function postList()
    {
    }
}
