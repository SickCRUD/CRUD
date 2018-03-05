<?php

namespace SickCRUD\CRUD\Tests\Browser\Auth;

// Laravel
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Auth\User;
use SickCRUD\CRUD\Tests\BrowserTestCase;

class RegisterTest extends BrowserTestCase
{
    /**
     * Fake User to register.
     *
     * @var array
     */
    protected $userToRegister = [
        'name' => 'Register Testing User',
        'email' => 'register-testing-user@tests.it',
        'password' => 'secret',
    ];

    /**
     * Test register controller without config flag 'tos' enabled.
     */
    public function testRegistrationWithoutTos()
    {
        // run browser
        $this->browse(function (Browser $browser) {
            $browser->visit($this->buildUrl('register'))
                ->type('name', $this->userToRegister['name'])
                ->type('email', $this->userToRegister['email'])
                ->type('password', $this->userToRegister['password'])
                ->type('password_confirmation', $this->userToRegister['password'])
                ->press('REGISTER')
                ->assertPathIs($this->buildUrl('dashboard'));
        });

        // fetch the created user
        $user = User::where('email', $this->userToRegister['email'])->first();
        $this->assertNotNull($user);

        // delete the user
        $user->delete();
    }

    /**
     * Test register controller with config flag 'tos' enabled.
     */
    public function testRegistrationWithTos()
    {
        // set the config
        $this->tweakApplication(function ($app) {
            $app['config']->set('SickCRUD.general.register-require-tos', true);
        });

        // run browser and check if the user is not created without tos flag
        $this->browse(function (Browser $browser) {
            $browser->visit($this->buildUrl('register'))
                ->type('name', $this->userToRegister['name'])
                ->type('email', $this->userToRegister['email'])
                ->type('password', $this->userToRegister['password'])
                ->type('password_confirmation', $this->userToRegister['password'])
                ->press('REGISTER')
                ->assertPathIs($this->buildUrl('register'));
        });

        // try to fetch the created user and check if do not exist
        $user = User::where('email', $this->userToRegister['email'])->first();
        $this->assertNull($user);

        // run browser and check if the user is created with tos flag
        $this->browse(function (Browser $browser) {
            $browser->visit($this->buildUrl('register'))
                ->type('name', $this->userToRegister['name'])
                ->type('email', $this->userToRegister['email'])
                ->type('password', $this->userToRegister['password'])
                ->type('password_confirmation', $this->userToRegister['password'])
                ->check('tos')
                ->press('REGISTER')
                ->assertPathIs($this->buildUrl('dashboard'));
        });

        // fetch the created user
        $user = User::where('email', $this->userToRegister['email'])->first();
        $this->assertNotNull($user);

        // delete the user
        $user->delete();
    }
}
