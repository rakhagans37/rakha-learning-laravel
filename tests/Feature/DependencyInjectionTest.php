<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DependecyInjectionTest extends TestCase
{
    public function testDependecyInjection()
    {
        $foo = new Foo();
        $bar = new Bar($foo);

        $this->assertEquals('foo and bar', $bar->bar());
    }
}
