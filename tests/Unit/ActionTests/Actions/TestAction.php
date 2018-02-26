<?php

namespace SickCRUD\CRUD\Tests\Unit\ActionTests\Actions;

use SickCRUD\CRUD\Core\Actions\Action;

/**
 * Class TestAction extending the package action.
 */
class TestAction extends Action
{
    // override default values
    public $actionRequireIdParam = true;
    public $actionRoutePrefix = true;

    /**
     * For testing purposes we should be able to change the $actionName protected variable.
     *
     * @return void
     */
    public function setName(string $name)
    {
        $this->actionName = $name;
    }

    /**
     * Non-named route GET.
     */
    public function actionGet()
    {
        return '// some kind of response';
    }

    /**
     * Non-named route PATCH.
     */
    public function actionPatch()
    {
        return '// some kind of response';
    }

    /**
     * Non-named route POST.
     */
    public function actionPost()
    {
        return '// some kind of response';
    }

    /**
     * Non-named route PUT.
     */
    public function actionPut()
    {
        return '// some kind of response';
    }

    /**
     * Test named route GET.
     */
    public function actionGetTest()
    {
        return '// some kind of response';
    }

    /**
     * Test named route PATCH.
     */
    public function actionPatchTest()
    {
        return '// some kind of response';
    }

    /**
     * Test named route POST.
     */
    public function actionPostTest()
    {
        return '// some kind of response';
    }

    /**
     * Test named route PUT.
     */
    public function actionPutTest()
    {
        return '// some kind of response';
    }
}
