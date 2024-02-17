<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHelloResponse()
    {
        $this->get('/response/helloResponse')->assertStatus(200)->assertSeeText("Hello, Response!");
    }

    public function testHeader()
    {
        $this->get('/response/responseHeader')->assertStatus(200)->assertSeeText('Hello, Response!')
            ->assertHeader('Content-Type', 'application/json')->assertHeader('App', 'Belajar Laravel')->assertHeader('X-Header-Two', 'Header Value')
            ->assertHeader('Author', 'Rakha Nasjaya');
    }

    public function testJson()
    {
        $this->get('/response/responseJson')->assertStatus(200)->assertJson(['name' => 'Rakha', 'age' => 20]);
    }

    public function testView()
    {
        $this->get('/response/responseView')->assertStatus(200)->assertSeeText('Rakha');
    }

    public function testFile()
    {
        $this->get('/response/responseFile')->assertStatus(200)->assertHeader('Content-Type', 'image/png');
    }

    public function testDownload()
    {
        $this->get('/response/responseDownload')->assertStatus(200)->assertDownload('avatar.png');
    }
}
