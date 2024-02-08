<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Services\HelloService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceProviderTest extends TestCase
{
    public function testServiceProvider()
    {
        $foo = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertSame($foo, $foo2);

        $bar = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($bar, $bar2);

        self::assertSame($foo, $bar->getFoo());
        self::assertSame($foo2, $bar2->getFoo());
    }

    public function testSingletonProperty()
    {
        $helloservice = $this->app->make(HelloService::class);
        $helloservice2 = $this->app->make(HelloService::class);

        self::assertSame($helloservice, $helloservice2);
        self::assertEquals('Halo, Muhammad Rakha Nasjaya', $helloservice->sayHello('Muhammad Rakha Nasjaya'));
    }
}
