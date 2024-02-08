<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TestConfig extends TestCase
{
    public function TestAllConfig()
    {
        // Memanggil config dari file contoh.php
        $author = config('contoh.author');
        $email = config('contoh.email');
        $city = config('contoh.address.city');
        $country = config('contoh.address.country');

        self::assertEquals('Muhammad Rakha Nasjaya', $author);
        self::assertEquals('Bandung', $city);
        self::assertEquals('Indonesia', $country);
        self::assertEquals('muhammadrakha3704@gmail.com', $email);
    }
}
