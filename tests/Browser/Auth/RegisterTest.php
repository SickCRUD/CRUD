<?php

namespace SickCRUD\CRUD\Tests\Browser\Auth;

// Laravel
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Auth\User;

use SickCRUD\CRUD\Tests\BrowserTestCase;

class RegisterTest extends BrowserTestCase
{
    /**
     * Test login controller.
     */
    public function testRegistration()
    {
        // declare registrationn user
        $user = [
            'name' => 'Register Testing User',
            'email' => 'register-testing-user@tests.it',
            'password' => 'secret'
        ];

        // run browser
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit($this->buildUrl('register'))
                ->type('name', $user['name'])
                ->type('email', $user['email'])
                ->type('password', $user['password'])
                ->type('password_confirmation', $user['password'])
                ->press('REGISTER')
                ->assertPathIs($this->buildUrl('dashboard'));
        });

        // fetch the created user
        $user = User::where('email', $user['email'])->first();
        $this->assertNotNull($user);

    }

}