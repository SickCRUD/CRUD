<?php

namespace SickCRUD\CRUD\Tests\Unit\Actions;

use SickCRUD\CRUD\Core\Actions\Action;
use SickCRUD\CRUD\Tests\BaseTest;

/**
 * Class BaseActionTest.
 * @package SickCRUD\CRUD\Tests\Unit\Actions
 */
abstract class BaseActionTest extends BaseTest
{
    /**
     * @var Action
     */
    protected $action;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();
        $this->action = new TestAction();
    }
}

/**
 * Class TestAction extending the package action.
 * @package SickCRUD\CRUD\Tests\Unit\Actions
 */
class TestAction extends Action
{
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

}