<?php

namespace SickCRUD\CRUD\Tests\Unit\ActionTests;

class ActionRoutesTest extends BaseActionTest
{
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
                'name' => false,
            ],
            [
                'function' => 'actionPatch',
                'method' => 'patch',
                'name' => false,
            ],
            [
                'function' => 'actionPost',
                'method' => 'post',
                'name' => false,
            ],
            [
                'function' => 'actionPut',
                'method' => 'put',
                'name' => false,
            ],
            [
                'function' => 'actionGetTest',
                'method' => 'get',
                'name' => 'test',
            ],
            [
                'function' => 'actionPatchTest',
                'method' => 'patch',
                'name' => 'test',
            ],
            [
                'function' => 'actionPostTest',
                'method' => 'post',
                'name' => 'test',
            ],
            [
                'function' => 'actionPutTest',
                'method' => 'put',
                'name' => 'test',
            ],
        ];

        // array of extracted action routes
        $actionRoutes = $this->action->getRoutes();

        // check if the count is the same
        $this->assertCount(count($actionRoutesExpected), $actionRoutes, 'The action returned routes count is different compared to the expected one.');

        // cycle them for the assertion
        foreach ($actionRoutes as $key => $actionRoute) {
            $this->assertContains($actionRoute, $actionRoutesExpected, 'Array not matching on index '.$key.'.');
        }
    }
}
