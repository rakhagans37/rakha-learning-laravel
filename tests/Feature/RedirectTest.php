<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RedirectTest extends TestCase
{
    public function testRedirectUser()
    {
        $this->get('/redirect/user')
            ->assertStatus(302)
            ->assertRedirect("/user/Rakha");
    }

    public function testRedirectAction()
    {
        $this->get('/redirect/action')
            ->assertRedirect("redirect/hello/Rakha")
            ->assertStatus(302);
    }

    public function testRedirectToExternal()
    {
        $this->get('/redirect/external')
            ->assertStatus(302)
            ->assertRedirect("https://www.traveloka.com");
    }
}
