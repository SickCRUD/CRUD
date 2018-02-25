<?php

namespace SickCRUD\CRUD\Tests\Unit\Actions;


class ActionNameTest extends BaseActionTest
{
    /**
     * Check if the extracted name is correct (from class name).
     */
    public function testGetActionName()
    {
        // should be TestAction ^Action
        $this->assertEquals($this->action->getName(), 'test', 'The action name extracted from the class name is wrong.');
    }

    /**
     * Try to set another name and then check if it's correct.
     */
    public function testGetModifiedActionName()
    {
        // choose a new action name
        $newActionName = 'ciao';

        // set the name variable
        $this->action->setName($newActionName);

        // should be equal to the new name set
        $this->assertEquals($this->action->getName(), $newActionName, 'There was an error with the custom action name.');
    }

    /**
     * Test if the routes are parsed correctly.
     */
    public function testActionRoutes()
    {
        // actual extracted array
        $actionRoutesExpected = [
            [
                'function' => 'actionGet',
                'method' => 'get',
                'name' => false
            ],
            [
                'function' => 'actionPatch',
                'method' => 'patch',
                'name' => false
            ],
            [
                'function' => 'actionPost',
                'method' => 'post',
                'name' => false
            ],
            [
                'function' => 'actionPut',
                'method' => 'put',
                'name' => false
            ],
        ];

        // array of extracted action routes
        $actionRoutes = $this->action->getRoutes();

        // check if the count is the same
        $this->assertCount(count($actionRoutesExpected), $actionRoutes, 'The action returned routes count is different compared to the expected one.');

        // cycle them for the assertion
        foreach ($actionRoutes as $key => $actionRoute) {

            $this->assertContains($actionRoute, $actionRoutesExpected, 'Array not matching on index ' . $key . '.');

        }

    }


}