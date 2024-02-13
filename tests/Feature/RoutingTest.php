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

    public function testRouteParameter()
    {
        $this->get('/blog/1')->assertStatus(200)->assertSeeText('Ini adalah blog 1');
        $this->get('/categories/100')->assertStatus(200)->assertSeeText('Category Id adalah : 100');
        $this->get('/user/Rakha')->assertStatus(200)->assertSeeText('Welcome to my traveloka, Rakha');
        $this->get('/redirectUser/Rakha')->assertRedirect('/user/Rakha');
    }

    public function testRouterController()
    {
        $this->get('/hello/Rakha')->assertStatus(200)->assertSeeText('Halo, Rakha');
    }
}
