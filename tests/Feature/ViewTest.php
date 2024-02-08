<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/belajar')->assertStatus(200)->assertSeeText('Hello, Rakha');
    }

    public function testNestedView()
    {
        $this->get('/adminProfile')->assertStatus(200)->assertSeeText('Hello admin, Admin Ganteng');
    }

    public function testViewWithoutRoute()
    {
        //Langsung panggil saja template nya
        $this->view('admin.profile', ["name" => "Admin Ganteng"])->assertSeeText('Hello admin, Admin Ganteng');
    }
}
