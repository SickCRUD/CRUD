<?php

namespace SickCRUD\CRUD\Core\Actions;

use Illuminate\Http\Request;
use SickCRUD\CRUD\Core\Traits\ViewData;
use Illuminate\Support\Facades\View;

class ListAction extends Action
{
    use ViewData;

    /**
     * The action name to reference for permissions.
     *
     * @var string
     */
    protected $name = 'list';

    /**
     * This function will handle the bulk action.
     *
     * @param $id
     */
    public function handleList($id)
    {
    }

    public function actionGetList(Request $request, $controller)
    {
        return View::make('SickCRUD::layout.layout', $controller->getViewData());
    }

    public function postList()
    {
    }
}
