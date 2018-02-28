<?php

namespace SickCRUD\CRUD\Tests;

use Orchestra\Testbench\Dusk\TestCase;

use Anhskohbo\NoCaptcha\NoCaptchaServiceProvider;
use SickCRUD\CRUD\SickCrudServiceProvider;

abstract class BrowserTestCase extends TestCase
{
    /**
     * Current package public folder (to be published).
     *
     * @var string
     */
    public static $packagePublicFolder = __DIR__ . '/../publishes/public/';

    /**
     * Laravel dusk public folder where to publish.
     *
     * @var string
     */
    public static $laravelDuskPublicFolder = __DIR__ . '/../vendor/orchestra/testbench-dusk/laravel/public/';

    /**
     * It contains the route prefix.
     *
     * @var string
     */
    protected $routePrefix;

    /**
     * Setup the test environment.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->prepareSqLite();
        $this->withFactories(__DIR__ . '/app/factories');
        $this->loadLaravelMigrations(config('database.default'));

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
            NoCaptchaServiceProvider::class,
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
            'NoCaptcha' => \Anhskohbo\NoCaptcha\Facades\NoCaptcha::class,
            'SickCRUD' => SickCrudServiceProvider::class,
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
        // set default language
        $app['config']->set('app.locale', 'en');

        // set the route prefix
        $this->routePrefix = 'test';
        $app['config']->set('SickCRUD.crud.route-prefix', $this->routePrefix);

        // set default user model
        $app['config']->set('SickCRUD.crud.user-fqn', \SickCRUD\CRUD\Tests\App\Models\User::class);

        // disable the captcha since no app keys are set
        $testReCaptcha = false;
        $app['config']->set('SickCRUD.general.login-reCaptcha', $testReCaptcha);
        $app['config']->set('SickCRUD.general.register-reCaptcha', $testReCaptcha);

    }

    /**
     * Prepare SqLite.
     *
     * @return void
     */
    protected function prepareSqLite()
    {
        // choose the directory
        $directory = __DIR__ . '/../vendor/orchestra/testbench-dusk/laravel/database';

        if (! file_exists($directory . '/database.sqlite')) {
            $sqliteCreated = touch($directory .'/database.sqlite');

            // assert process succesful
            $this->assertSame(true, $sqliteCreated, 'Failed SqLite prepare.');

        }

    }

    /**
     * Before phpunit runs.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        static::recursiveCopy(static::$packagePublicFolder, static::$laravelDuskPublicFolder);
        parent::setUpBeforeClass();
    }

    /**
     * After phpunit runs.
     *
     * @return void
     */
    public static function tearDownAfterClass()
    {
        static::deleteDirectoryContent(static::$laravelDuskPublicFolder);
        parent::tearDownAfterClass();
    }

    /**
     * Recurse copy of a folder.
     *
     * @param string $source
     * @param string $destination
     */
    public static function recursiveCopy(string $source, string $destination)
    {
        $directory = opendir($source);
        @mkdir($destination);
        while (false !== ($file = readdir($directory))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($source . DIRECTORY_SEPARATOR . $file)) {
                    static::recursiveCopy($source . DIRECTORY_SEPARATOR . $file, $destination . DIRECTORY_SEPARATOR . $file);
                } else {
                    copy($source . DIRECTORY_SEPARATOR . $file, $destination . DIRECTORY_SEPARATOR . $file);
                }
            }
        }
        closedir($directory);
    }
    /**
     * Delete a specific directory content.
     *
     * @param string $directory
     * @param bool $delete
     */
    public static function deleteDirectoryContent(string $directory, bool $delete = false)
    {
        $contents = glob($directory . '*');
        foreach($contents as $item) {
            if (is_dir($item)) {
                static::deleteDirectoryContent($item . DIRECTORY_SEPARATOR, true);
            }else{
                unlink($item);
            }
        }
        if ($delete === true) {
            rmdir($directory);
        }
    }

    /**
     * Build the prefixe URL.
     *
     * @param string|null $url
     * @return string
     */
    protected function buildUrl(string $url = null)
    {
        return '/' . $this->routePrefix . '/' . ltrim($url, '/');
    }

}