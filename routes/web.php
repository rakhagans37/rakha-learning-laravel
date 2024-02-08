<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Routing -> adalah proses mengatur aplikasi web kita agar bisa diakses oleh user.

Routing terdiri dari 2 jenis :
    1. Basic Routing
    2. Route Parameter

Note : Cara melihat routing -> php artisan route:list
*/


/*
Optimizing view => Blade template sendiri akan di compile menjadi PHP ketika ada request masuk, sehingga ini akan memakan waktu 
dan resource. 

Untuk mengoptimalkan hal ini, kita bisa menggunakan perintah php artisan view:cache
untuk mengcompile semua view menjadi file PHP. Jika ingin menghapus cache view, kita bisa menggunakan
perintah php artisan view:clear

Cache views akan disimpan => storage/framework/views

*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return "Home";
});

Route::get('/contoh', function () {
    return "Contoh";
});

Route::get('/belajar', function () {
    return view('belajar', ['name' => 'Rakha']);
});

//Nested Routing => Jika biasanya kita menggunakan / untuk nested routing, namun di laravel kita menggunakan . untuk nested routing
Route::get('/adminProfile', function () {
    return view('admin.profile', ['name' => 'Admin Ganteng']);
});

Route::redirect('/home', '/contoh'); // Jika mengakses /, maka akan di redirect ke /contoh

Route::fallback(function () {
    return "Halaman tidak ditemukan";
}); // Jika mengakses halaman yang tidak ada, maka akan di redirect ke halaman ini
