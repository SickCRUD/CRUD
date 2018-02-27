<?php

namespace SickCRUD\CRUD\Tests;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Orchestra\Testbench\Dusk\TestCase;

use SickCRUD\CRUD\SickCrudServiceProvider;

abstract class BrowserTestCase extends TestCase
{

    /**
     * Setup the test environment.
     */
    protected function setUp()
    {
        $this->prepareSqLite();
        parent::setUp();
    }

    /**
     * Add the package providers used.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            SickCrudServiceProvider::class
        ];
    }

    /**
     * Added test aliases.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'SickCRUD' => SickCrudServiceProvider::class
        ];
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

        // set default language
        $app['config']->set('app.locale', 'en');

    }

    /**
     * Prepare SqLite.
     *
     * @return void
     */
    protected function prepareSqLite()
    {

        $directory = 'vendor/orchestra/testbench-dusk/laravel/database';

        if (! file_exists($directory . '/database.sqlite')) {
            $sqliteCreated = touch($directory .'/database.sqlite');

            // assert process succesful
            $this->assertSame(true, $sqliteCreated, 'Failed SqLite prepare.');

        }

    }

}