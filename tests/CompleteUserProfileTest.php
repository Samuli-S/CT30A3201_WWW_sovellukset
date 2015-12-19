<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CompleteUserProfileTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->visit('user-home')->type('Finland', 'country')
                                ->type('Rovaniemi', 'city')
                                ->check('female', 'gender')
                                ->press('Save');
    }
}
