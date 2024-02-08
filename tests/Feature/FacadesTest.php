<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;


/*
Facades => adalah sebuah class yang menyediakan akses ke object yang ada di dalam service container

Note :
1. Facades mirip dengan helper function, tetapi lebih baik karena lebih mudah untuk di test.
2. Gunakan Facades jika diperlukan saja, karena jika menggunakan facades terlalu banyak akan membuat kode menjadi sulit untuk di test.
*/

/*
Cara Facades bekerja :
1. Ketika kita menggunakan Facades, maka Facades class yang sudah di extends dengan Facades.
2. Lalu Facades class tersebut akan memanggil static method resolve() yang ada di dalam service container sehingga
    kita bisa mengakses object yang ada di dalam service container.
*/

/*
Salah satu kekurangan menggunakan static function adalah sulit untuk di mock.
Namun di laravel disediakan function untuk mocking di facades, sehingga akan mudah untuk implementasi unit test.

Laravel menggunakan library => Mockery
*/

class FacadesTest extends TestCase
{
    public function testConfig()
    {
        $configWithHelper = config('app.timezone'); // menggunakan helper function (menggunakan function global)
        $configWithFacades = Config::get('app.timezone'); // menggunakan Facades (menggunakan Class)

        self::assertEquals($configWithHelper, $configWithFacades);

        // var_dump(Config::all()); // Melihat semua config
    }

    public function testConfigDependency()
    {
        $config = $this->app->get("config"); // Mengambil object config dari service container dengan mengakses dari property app
        $databaseWithApp = $config->get("database.connections.mysql.database");

        $databaseWithFacades = Config::get("database.connections.mysql.database"); // Mengambil object config dari service container dengan menggunakan Facades

        echo $databaseWithFacades;
        self::assertEquals($databaseWithApp, $databaseWithFacades); // Hasilnya sama
    }

    public function testFacadesMock()
    {
        // Maka akan return "Rakhagans37" ketika memanggil Config::get("contoh.author")
        Config::shouldReceive("get")->with("contoh.author")->andReturn("Rakha Ganteng");

        $author = Config::get("contoh.author");
        self::assertEquals("Rakha Ganteng", $author);
    }
}
