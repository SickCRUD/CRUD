<?php

namespace SickCRUD\CRUD\Tests\Unit\ActionTests;

class ActionNameTest extends BaseActionTestCase
{
    /**
     * Check if the extracted name is correct (from class name).
     */
    public function testGetActionName()
    {
        // should be TestAction ^Action
        $this->assertEquals(str_replace('action', '', strtolower(class_basename($this->action))), $this->action->getName(), 'The action name extracted from the class name is wrong.');
    }

    /**
     * Try to set another name and then check if it's correct.
     * It could seem an useless test but it's not because some kinds modifiers can be applied while setting the variable.
     */
    public function testGetModifiedActionName()
    {
        // choose a new action name
        $newActionName = 'ciao';

        // set the name variable
        $this->action->setName($newActionName);

        // should be equal to the new name set
        $this->assertEquals($newActionName, $this->action->getName(), 'There was an error with the custom action name.');
    }
}
