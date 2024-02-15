<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

/*
Storage Link => untuk membuat link storage, yang mana file file yang disimpan didalam storage dapat diakses melalui web sesuai link yang diberikan
Storage link sendiri terdapat pada config filesystems.php, sehingga konfigurasi link nya akan diakses dari sana
    1. php artisan storage:link -> untuk membuat link storage
    2. php artisan storage:link -> untuk menghapus link storage

*/

/*
File Upload => method yang digunakan untuk mengupload file
    1. File Upload -> untuk mengupload file
    2. File Validation -> untuk validasi file
    3. File Storage -> untuk menyimpan file
    4. File Download -> untuk mendownload file
    5. File Delete -> untuk menghapus file
*/

class StorageController extends Controller
{
    public function getStorage()
    {
        $filesystem = Storage::disk('local');
        $filesystem->put('file.txt', 'Hello World');

        return $filesystem->get('file.txt');
    }

    public function testPublic()
    {
        $filesystem = Storage::disk('public');
        $filesystem->put('file.txt', 'Hello World');

        return $filesystem->get('file.txt');
    }

    public function fileUpload(Request $request)
    {
        $allFiles = $request->allFiles();
        $picture = $request->file('image');

        $picture->storePubliclyAs('picture', $picture->getClientOriginalName(), 'public');
        return "File uploaded " . $picture->getClientOriginalName();
    }
}
