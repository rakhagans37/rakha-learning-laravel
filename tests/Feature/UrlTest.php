<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testURLFull()
    {
        $this->get('/currentUrl')->assertStatus(200)->assertSeeText('/currentUrl');
    }
}
