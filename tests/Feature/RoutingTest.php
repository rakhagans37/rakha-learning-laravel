<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/* Test Basic Routing */

class RoutingTest extends TestCase
{
    public function testBasicRouting()
    {
        $this->get('/contoh')->assertStatus(200)->assertSeeText('Contoh');
    }

    public function testRedirect()
    {
        $this->get('/home')->assertRedirect('/contoh');
    }

    public function testFallback()
    {
        $this->get('/notfound')->assertSeeText('Halaman tidak ditemukan');
    }
}
