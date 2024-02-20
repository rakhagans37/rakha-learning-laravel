<?php

use App\Http\Controllers\CookieController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\StorageController;
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

//Route Parameter
Route::get('/blog/{blogId}', function ($blogId) {
    return view('blog', ['blogId' => $blogId]);
})->name('blog');

//Route Parameter with regular expression
Route::get('/categories/{categoryId}', function ($categoryId) {
    return "Category Id adalah : " . $categoryId;
})->where('categoryId', '[0-9]+'); // Hanya menerima parameter categoryId yang berupa angka

//Route Parameter with optional parameter => harus ditambahkan default value nya
Route::get('/user/{name?}', function ($name = "User") {
    return "Welcome to my traveloka, " . $name;
})->where('name', '[a-zA-Z]+')->name('user'); // Hanya menerima parameter name yang berupa huruf

//Conflict pada routing
Route::get('/user/Rakha', function () {
    return "Conflict Rakha";
})->where('name', '[a-zA-Z]+');
// Maka ini akan menjadi conflict, dimana yang dipanggila akan tetap yang diatas, yang mana hasilnya adalah "Welcome to my traveloka, Rakha"

//Named Routing => di laravel kita bisa memberikan nama pada routing
// Keuntungan menggunakan name adalah jika kita ingin mengganti routing, kita tidak perlu mengganti semua routing yang memanggil routing tersebut

Route::get('/redirectUser/{name}', function ($name = "User") {
    return redirect()->route('user', ['name' => $name]);
});

Route::get('/hello/{name}', [HelloController::class, 'hello']); // Registrasi controller kedalam route menggunakan method get() atau post() pada file web.php

Route::get('/getRequest/request', [HelloController::class, 'request']); // Registrasi controller kedalam route menggunakan method get() atau post() pada file web.php

Route::get('/input/hello', [InputController::class, 'hello']); // Registrasi controller kedalam route menggunakan method get() pada file web.php
Route::post('/input/hello', [InputController::class, 'hello']); // Registrasi controller kedalam route menggunakan method post() pada file web.php
Route::post('/input/helloArray', [InputController::class, 'helloArray']); // Registrasi controller kedalam route menggunakan method get() pada file web.php
Route::post('/input/getAllInput', [InputController::class, 'getAllInput']); // Registrasi controller kedalam route menggunakan method get() pada file web.php
Route::post('/input/getAllName', [InputController::class, 'getAllName']); // Registrasi controller kedalam route menggunakan method get() pada file web.php
Route::post('/input/getDataType', [InputController::class, 'getDataType']); // Registrasi controller kedalam route menggunakan method get() pada file web.php
Route::post('/input/getFilter', [InputController::class, 'getFilterInput']); // Registrasi controller kedalam route menggunakan method get() pada file web.php
Route::post('/input/getMerge', [InputController::class, 'getMergeInput']); // Registrasi controller kedalam route menggunakan method get() pada file web.php
Route::get('/file/getStorage', [StorageController::class, 'getStorage']); // Registrasi controller kedalam route menggunakan method get() pada file web.php
Route::post('/file/fileUpload', [StorageController::class, 'fileUpload']); // Registrasi controller kedalam route menggunakan method post() pada file web.php
Route::get('/response/helloResponse', [ResponseController::class, 'helloResponse']); // Registrasi controller kedalam route menggunakan method get() pada file web.php
Route::get('/response/responseHeader', [ResponseController::class, 'responseHeader']); // Registrasi controller kedalam route menggunakan method get() pada file web.php
Route::get('/response/responseView', [ResponseController::class, 'responseView']); // Registrasi controller kedalam route menggunakan method get() pada file web.php
Route::get('/response/responseJson', [ResponseController::class, 'responseJson']); // Registrasi controller kedalam route menggunakan method get() pada file web.php
Route::get('/response/responseFile', [ResponseController::class, 'responseFile']); // Registrasi controller kedalam route menggunakan method get() pada file web.php
Route::get('/response/responseDownload', [ResponseController::class, 'responseDownload']); // Registrasi controller kedalam route menggunakan method get() pada file web.php
Route::get('/cookie/createCookie', [CookieController::class, 'createCookie']);
Route::get('/cookie/getCookie', [CookieController::class, 'getCookie']);
Route::get('/cookie/deleteCookie', [CookieController::class, 'deleteCookie']);

Route::get('/phpinfo', function () {
    return phpinfo();
});
