<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Env;
use Tests\TestCase;


/*
Environtment dalam laravel adalah file yang berisi konfigurasi aplikasi. File ini berisi konfigurasi database, konfigurasi mail, konfigurasi cache, dan lain-lain. 
File ini berada di dalam folder config dan bernama .env. File ini berisi konfigurasi yang berbeda-beda antara satu environment dengan environment lainnya.

Untuk mengambil attribute dari file .env, kita bisa menggunakan helper env(nama_attribute).
atau bisa dengan menggunakan class env yaitu Env::get('nama_attribute').

Default Value =>
Jika attribute yang kita ambil tidak ada di file .env, maka kita bisa menambahkan default value di parameter kedua dari helper env(nama_attribute, default_value).
*/

class EnvTest extends TestCase
{
    public function testGetEnv()
    {
        $database = env('DB_DATABASE');

        self::assertEquals('db_medkolab', $database);
    }

    public function testUsernameDatabase()
    {
        $username = env('DB_USERNAME');

        self::assertEquals('root', $username);
    }

    public function testAuthor()
    {
        // Rakha adalah default value dan dengan class env
        $author = Env::get('AUTHORS', 'Muhammad Rakha Nasjaya');

        self::assertEquals('Muhammad Rakha Nasjaya', $author);
    }
}
