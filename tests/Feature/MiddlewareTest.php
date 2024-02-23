<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MiddlewareTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMiddleware()
    {
        $this->withHeader("X-API-KEY", "Rakhaware37")->get('/middleware')
            ->assertStatus(200);
    }

    public function testMiddlewareGroup()
    {
        $this->withHeader("X-API-KEY", "Rakhaware37")->get('/middleware/group')
            ->assertStatus(200);
    }

    public function testMiddlewareWithParameter()
    {
        $this->withHeader("X-API-KEY", "Rakhaware37")->get('/middleware/parameter')
            ->assertStatus(200);
    }
}
