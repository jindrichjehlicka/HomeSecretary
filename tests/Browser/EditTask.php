<?php

namespace Tests\Browser;

use HomeSecretary\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EditTask extends DuskTestCase
{
    public function testExample()
    {

        $user = factory(User::class)->create([
            'password' => bcrypt('123456'),
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/')
                ->clickLink('Tasks')
                ->assertSee('Tasks')
                ->clickLink('Show Task')
                ->assertSee('Edit Task')
                ->clickLink('Edit Task')
                ->value('#name', 'Renamed name')
                ->value('#description', 'Renamed description')
                ->value('#assigned', (string)$user->id)
                ->click('button[type="submit"]')
                ->assertPathIs('/tasks');
        });
    }
}
