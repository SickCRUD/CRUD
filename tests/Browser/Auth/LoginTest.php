<?php

// Laravel
use Laravel\Dusk\Browser;

use SickCRUD\CRUD\Tests\BrowserTestCase;

class LoginTest extends BrowserTestCase
{
    /**
     * Test login controller.
     */
    public function testLogin()
    {
        // sample assertion
        // $response = $this->get('/');
        // $response->assertStatus(404);

        $this->browse(function (Browser $browser) {
            $browser->visit('sick-crud/login')
                ->assertSee('Login');
        });

    }

}