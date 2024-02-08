<?php

/*
Dependency Injection -> sebuah object yang membutuhkan object lain untuk bekerja

contohnya adalah class Bar dibawah ini, yang membutuhkan object dari class Foo. 
Artinya class Bar depends-on class Foo
*/

namespace App\Data;

class Bar
{
    private Foo $foo;

    public function __construct(Foo $foo)
    {
        $this->foo = $foo;
    }

    public function bar()
    {
        return $this->foo->foo() . ' and bar';
    }

    /**
     * Get the value of foo
     */
    public function getFoo()
    {
        return $this->foo;
    }
}
