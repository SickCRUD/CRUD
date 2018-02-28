<?php

namespace SickCRUD\CRUD\Tests\Browser\Auth;

// Laravel
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Auth\User;

use SickCRUD\CRUD\Tests\BrowserTestCase;

class LoginTest extends BrowserTestCase
{
    /**
     * Test login controller.
     */
    public function testLogin()
    {
        // make the user
        $user = factory(User::class)->create([
            'email' => 'test-user@testing.it',
        ]);

        // sample assertion
        // $response = $this->get('/');
        // $response->assertStatus(404);

        // run browser
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/' . $this->routePrefix . '/login')
                ->type('email', $user->email)
                ->type('password', 'secret')
                ->press('LOGIN')
                ->assertPathIs('/' . $this->routePrefix . '/dashboard');
        });

    }

}