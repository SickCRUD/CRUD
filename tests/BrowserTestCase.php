<?php

namespace SickCRUD\CRUD\Tests;

use Orchestra\Testbench\Dusk\TestCase;

abstract class BrowserTestCase extends TestCase
{

    /**
     * Setup the test environment.
     */
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // use sqlitedb
        $app['config']->set('database.default', 'sqlite');
    }

}