<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateCookie()
    {
        $this->get('/cookie/createCookie')
            ->assertStatus(200)
            ->assertCookie('name');
    }

    public function testGetCookie()
    {
        $this->withCookie("name", "Rakha")->get('/cookie/getCookie')
            ->assertStatus(200)
            ->assertJson([
                "Rakha",
                "false"
            ]);
    }
}
