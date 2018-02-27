<?php

namespace SickCRUD\CRUD\Tests;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
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

    /**
     * Prepare SqLite.
     *
     * @return void
     */
    public function prepareSqLite()
    {
        // instantiate process
        $process = new Process('php ../vendor/orchestra/testbench-core/create-sqlite-db');

        // run it
        $process->run(function ($type, $buffer) {

        });

        // assert process succesful
        $this->assertSame(true, $process->isSuccessful(), 'Failed SqLite prepare.');

    }

}