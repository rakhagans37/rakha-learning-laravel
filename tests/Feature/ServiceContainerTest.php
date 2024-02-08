<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


/*
Ketika kita membuat Service object dari foo, maka object tersebut akan diinject ke dalam object bar.
Namun kita tidak harus menggunakan kata kunci new untuk membuat object dari class Foo, karena kita bisa menggunakan service container untuk membuat object dari class Foo.
Kita bisa menggunakan method make() dari service container untuk membuat object dari class Foo.
*/

class ServiceContainerTest extends TestCase
{
    public function testDependencyInjection()
    {
        $foo = $this->app->make(Foo::class); // Sama saja seperti new Foo()
        $foo2 = $this->app->make(Foo::class); // Sama saja seperti new Foo()
        $bar = new Bar($this->app->make(Foo::class));

        self::assertEquals('foo and bar', $bar->bar());
        self::assertEquals('foo', $foo->foo());
        // self::assertNotSame($foo, $foo2); // Tidak sama karena object $foo dan $foo2 adalah object yang berbeda
    }

    /*
    Namun jika halnya membuat object yang lebih kompleks, seperti memiliki constructor.
    Maka pembuatan class harus membuat method closure -> bind(key, closure) dari service container.
    */
    public function testBind()
    {
        $this->app->bind(Person::class, function ($app) {
            return new Person('Muhammad Rakha', 'Nasjaya');
        });

        //Artinya setiap pembuatan object dari class Person, maka akan merujuk pada method closure diatas
        $person = $this->app->make(Person::class); // Memanggil closure()
        $person2 = $this->app->make(Person::class); // Memanggil closure()

        self::assertEquals('Muhammad Rakha', $person->firstName);
        self::assertEquals('Nasjaya', $person2->lastName);
        self::assertNotSame($person, $person2);
    }

    /*
    Biasanya ketika kita menggunakan make(key), akan membuat object baru setiap kali kita memanggilnya.
    Namun jika kita ingin membuat 1 object yang sama setiap kali kita memanggilnya, kita bisa menggunakan
    method singleton(key, closure) dari service container.
    */

    public function testSingleton()
    {
        $this->app->singleton(Person::class, function ($app) {
            return new Person('Muhammad Rakha', 'Nasjaya');
        });

        $person = $this->app->make(Person::class); // Memanggil closure() dimana closure nya berasal dari singleton()
        $person2 = $this->app->make(Person::class); // Memanggil closure() dimana closure nya berasal dari singleton()

        self::assertSame($person, $person2); // Sama karena ketika pembuatan class, dia akan memanggil singleton atau closure yang telah di inisiasikan diawal
    }

    /*
    Instance keyword -> membuat singleton object dari object yang sudah ada
    */

    public function testInstance()
    {
        $person = new Person('Muhammad Rakha', 'Nasjaya');
        $this->app->instance(Person::class, $person);

        $person2 = $this->app->make(Person::class); // Setiap pembuatan object menggunakan keyword make, akan merujuk pada object $person diatas
        $person3 = $this->app->make(Person::class); // Setiap pembuatan object menggunakan keyword make, akan merujuk pada object $person diatas

        self::assertEquals('Muhammad Rakha', $person2->firstName);
        self::assertSame($person, $person2);
        self::assertSame($person2, $person3);
        self::assertSame($person, $person3);
    }

    public function testDependencyInjectionAfterTopics()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class); //Ini secara otomatis akan mengambil object dari service container

        self::assertEquals('foo and bar', $bar->bar());
        self::assertSame($foo, $bar->getFoo());
    }

    /*
    Dependency injection pada closure()

    => Dengan menggunakan parameter $app yang ada pada closure kita dapat memanggil object yang sudah ada pada service container, 
    ini dapat memudahkan kita saat kasus tertentu
    */
    public function testDependencyInjectionInClosure()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $this->app->singleton(Bar::class, function ($app) {
            //Disaat kita ingin membuat bar secara singleton, kita akan memanggil object foo yang sudah ada di service container
            return new Bar($app->make(Foo::class));
        });

        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($bar1, $bar2);
    }

    /*
    Binding interface ke class
    
        Ada 4 cara
        1. singleton(interface, class)
        2. singleton(interface, closure)
        3. bind(interface, class)
        4. bind(interface, closure)

    Gunakan closure jika class membutuhkan parameter
    */
    public function testInterfaceToClass()
    {
        // Inisiasi interface ke class, agar service container tau, ketika helloService dipanggil, maka akan merujuk ke class HelloServiceIndonesia
        $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);
        $helloservice = $this->app->make(HelloService::class);

        self::assertEquals('Halo, Muhammad Rakha', $helloservice->sayHello('Muhammad Rakha'));
    }
}
