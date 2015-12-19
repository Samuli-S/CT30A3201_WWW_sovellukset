<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegistrationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->visit('/register')->type('Erkki', 'etunimi')
                                ->type('Esimerkki', 'sukunimi')
                                ->type('erkki.esimerkki@esim.com', 'emal')
                                ->type('erkki.esimerkki@esim.com', 'email_confirmation')
                                ->type('Erkki_123', 'username')
                                ->type('asdAd32D', 'password')
                                ->type('asdAd32D', 'password_confirmation')
                                ->press('Register Me');
    }
}
