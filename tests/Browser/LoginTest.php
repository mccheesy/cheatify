<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations, WithFaker;

    public function tearDown()
    {
        session()->flush();
        parent::tearDown();
    }

    /** @test **/
    public function guests_can_register()
    {
        $this->browse(function ($browser) {
            $browser->visit('/register')
                ->assertPathIs('/register')
                ->type('name', 'Joe Cool')
                ->type('email', 'joe.cool@email.com')
                ->type('password', 'secret')
                ->type('password_confirmation', 'secret')
                ->press('Register')
                ->assertSee('Joe Cool')
                ->assertPathIs('/cheats');
        });
    }

    /** @test **/
    public function users_can_login()
    {
        $user = User::create([
            'name' => 'Joe Cool',
            'email' => 'joe.cool@email.com',
            'password' => 'secret'
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/cheats')
                ->assertPathIs('/cheats')
                ->assertSee('Joe Cool')
                ->clickLink('Joe Cool')
                ->assertSee('Logout');
        });
    }

    /** @test **/
    public function users_can_logout()
    {
        $user = User::create([
            'name' => 'Joe Cool',
            'email' => 'joe.cool@email.com',
            'password' => 'secret'
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/logout')
                ->assertSee('Login')
                ->assertPathIs('/');
        });
    }
}
