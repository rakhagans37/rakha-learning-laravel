<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


/* ContohTest adalah nama class yang kita buat

Perintah membuat test di terminal = php artisan make:test nama_test
Perintah membuat unit test di terminal = php artisan make:test nama_test --unit
Perintah menjalankan test di terminal = php artisan test
*/

class ContohTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
