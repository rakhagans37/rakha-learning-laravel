<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/*
Seluruh file storage di laravel akan disimpan di dalam folder storage
    1. app -> untuk menyimpan file yang dibuat oleh user
    2. framework -> untuk menyimpan file yang dibuat oleh laravel
    3. logs -> untuk menyimpan log aplikasi
    4. session -> untuk menyimpan file session
    5. testing -> untuk menyimpan file testing
    6. views -> untuk menyimpan file view

Untuk mendapatkan storage kita bisa menggunakan facades Storage
    1. Storage::disk('local') -> untuk mendapatkan storage local
    2. Storage::disk('public') -> untuk mendapatkan storage public
    3. Storage::disk('s3') -> untuk mendapatkan storage s3

Method yang bisa digunakan pada storage
    1. put() -> untuk membuat file
    2. get() -> untuk mengambil file
    3. delete() -> untuk menghapus file
    4. exists() -> untuk mengecek file
    5. size() -> untuk mendapatkan ukuran file
    6. url() -> untuk mendapatkan url file
    7. move() -> untuk memindahkan file
*/

class StorageTest extends TestCase
{
    public function testStorage()
    {
        $filesystem = Storage::disk('local');
        $filesystem->put('file.txt', 'Hello World');

        $content = $filesystem->get('file.txt');
        self::assertEquals('Hello World', $content);
    }

    public function testPublic()
    {
        $filesystem = Storage::disk('public');
        $filesystem->put('file.txt', 'Hello World');

        $content = $filesystem->get('file.txt');
        self::assertEquals('Hello World', $content);
    }

    public function testUpload()
    {
        $image = UploadedFile::fake()->image('Test.png');

        $this->post('/file/fileUpload', [
            'image' => $image
        ])->assertSeeText('File uploaded Test.png');
    }
}
