<?php

namespace Tests\Browser;

use HomeSecretary\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AccessTaskProgress extends DuskTestCase
{
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Tasks')
                ->assertSee('Progress');
        });
    }
}
