<?php

namespace SickCRUD\CRUD\Tests\Unit\ActionTests;

use SickCRUD\CRUD\Tests\BaseTestCase;
use SickCRUD\CRUD\Core\Actions\Action;
use SickCRUD\CRUD\Tests\Unit\ActionTests\Actions\TestAction;

/**
 * Class BaseActionTest.
 */
abstract class BaseActionTestCase extends BaseTestCase
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
