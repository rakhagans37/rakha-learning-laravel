<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputTest extends TestCase
{
    public function testInputName()
    {
        /**
         * 
         *
         * Mengammbil nested input
         */
        $arrayName = [
            'name' => [
                'first' => 'Rakha',
                'last' => 'Nasjaya'
            ]
        ];

        $this->get('/input/hello?name=Rakha')
            ->assertStatus(200)
            ->assertSeeText('Hello, Rakha!');

        $this->post('/input/hello', ['name' => 'Rakha'])
            ->assertStatus(200)
            ->assertSeeText('Hello, Rakha!');

        $this->post('/input/helloArray', $arrayName)
            ->assertStatus(200)
            ->assertSeeText('Hello, Rakha!');
    }

    public function testAllInput()
    {
        $this->post('/input/getAllInput', ['name' => 'Rakha', 'age' => 20])
            ->assertStatus(200)
            ->assertSeeText("name")->assertSeeText("Rakha")->assertSeeText("age")->assertSeeText("20");
    }

    public function testProductName()
    {
        $this->post('/input/getAllName', ['product' => [['name' => 'Jagung'], ['name' => 'Singkong']]])
            ->assertStatus(200)
            ->assertSeeText('Jagung')->assertSeeText('Singkong');
    }

    public function testDataType()
    {
        $this->post('/input/getDataType', ['birth_date' => '03-07-2004', 'married' => 'true'])
            ->assertStatus(200)
            ->assertSeeText('03-07-2004')->assertSeeText('true');
    }
}
