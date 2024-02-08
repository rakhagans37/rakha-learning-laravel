<?php

namespace App\Services;

interface HelloService
{
    public function sayHello(string $name): string;
}
