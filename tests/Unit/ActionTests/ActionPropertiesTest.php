<?php

namespace SickCRUD\CRUD\Tests\Unit\ActionTests;

class ActionPropertiesTest extends BaseActionTestCase
{
    /**
     * Check if the prefix is needed (should match our TestAction class).
     */
    public function testIfPrefixIsNeeded()
    {
        $this->assertSame(true, $this->action->routePrefix);
    }

    /**
     * Check if the id param is needed (should match our TestAction class).
     */
    public function testIfIdParamIsRequired()
    {
        $this->assertSame(true, $this->action->requireIdParam);
    }
}
