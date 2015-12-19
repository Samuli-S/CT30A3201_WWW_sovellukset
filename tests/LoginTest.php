<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->visit('auth/login')->type('samuli.siitonen@testi.fi', 'email')
                                    ->type('7Arm5y1v', 'password')->seePageIs('user-home');
        
    }
}
