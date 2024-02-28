<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPut()
    {
        $this->get('/session/putSession')
            ->assertStatus(200)
            ->assertSessionHas('name', 'Rakha');
    }

    public function testGet()
    {
        $this->withSession(['name' => 'Rakha'])
            ->get('/session/getSession')
            ->assertSeeText('Rakha');
    }
}
