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
        $this->assertEquals($this->action->getActionName(), 'test');
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
        $this->assertEquals($this->action->getActionName(), $newActionName);
    }

}