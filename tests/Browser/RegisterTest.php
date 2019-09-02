<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{
    public function testRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Register')
                ->assertSee('Register')
                ->value('#name', 'Jay')
                ->value('#email', 'jay@example.com')
                ->value('#password', '12345678')
                ->value('#password-confirm', '12345678')
                ->click('button[type="submit"]')
                ->assertPathIs('/');
        });
    }
}

