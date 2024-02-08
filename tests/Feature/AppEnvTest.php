<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

/*
App environment adalah kondisi dimana aplikasi berjalan.

Ada beberapa environment yang bisa digunakan di laravel: 
    1. local 
    2. testing
    3. staging 
    4. production

Untuk memeriksa environment yang sedang berjalan, kita bisa menggunakan helper App::environment(value).
*/

class AppEnvTest extends TestCase
{
    public function testAppEnv()
    {
        if (App::environment(['testing', 'local'])) {
            self::assertTrue(true);
        } else {
            self::assertTrue(false);
        }
    }
}
