<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TasksTest extends DuskTestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('/projects')
                ->assertSee('unde');
        });
    }
}
