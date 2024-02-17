<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

/*
Laravel memiliki abstraction untuk melakukan encryption. sehingga kita bisa melakukan enkripsi menggunakan function yang telah tersedia

Syarat melakukan encryption:

1. Laravel membutuhkan key ⇒ config/app.php
2. Key dari app.php sendiri mengambil dari file .env ⇒ APP_KEY

Cara membuat encryption key:

1. php artisan key:generate ⇒ secara otomatis akan mengisi key di APP_KEY

Melakukan encrypt & decrypt ⇒ menggunakan facades Crypt:

1. 

NOTE: disarankan APP_KEY dirubah secara rutin, agar aman (disrankan rentang waktu 1 bulan)
*/

class EncryptionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testEncrypt()
    {
        // Menggunakan function
        $tes = encrypt('Hello World');
        $tesDecrypt = decrypt($tes);

        // Menggunakan Facade Crypt
        $encrypt = Crypt::encrypt('Hello World');
        $decrypt = Crypt::decrypt($encrypt);

        $this->assertEquals('Hello World', $decrypt);
        $this->assertEquals('Hello World', $tesDecrypt);
    }
}
