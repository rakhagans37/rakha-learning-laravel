<?php

use App\Http\Controllers\CookieController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\MiddlewareController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StorageController;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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
})->where('name', '[a-zA-Z]+')->name('userDetails'); // Hanya menerima parameter name yang berupa huruf

//Conflict pada routing
Route::get('/user/Rakha', function () {
    return "Conflict Rakha";
})->where('name', '[a-zA-Z]+');
// Maka ini akan menjadi conflict, dimana yang dipanggila akan tetap yang diatas, yang mana hasilnya adalah "Welcome to my traveloka, Rakha"

//Named Routing => di laravel kita bisa memberikan nama pada routing
// Keuntungan menggunakan name adalah jika kita ingin mengganti routing, kita tidak perlu mengganti semua routing yang memanggil routing tersebut

Route::get('/redirectUser/{name}', function ($name = "User") {
    return redirect()->route('userDetails', ['name' => $name]);
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
Route::get('/response/helloResponse', [ResponseController::class, 'helloResponse']); // Registrasi controller kedalam route menggunakan method get() pada file web.php
Route::get('/response/responseHeader', [ResponseController::class, 'responseHeader']); // Registrasi controller kedalam route menggunakan method get() pada file web.php
Route::get('/response/responseView', [ResponseController::class, 'responseView']); // Registrasi controller kedalam route menggunakan method get() pada file web.php
Route::get('/response/responseJson', [ResponseController::class, 'responseJson']); // Registrasi controller kedalam route menggunakan method get() pada file web.php
Route::get('/response/responseFile', [ResponseController::class, 'responseFile']); // Registrasi controller kedalam route menggunakan method get() pada file web.php
Route::get('/response/responseDownload', [ResponseController::class, 'responseDownload']); // Registrasi controller kedalam route menggunakan method get() pada file web.php
Route::get('/cookie/createCookie', [CookieController::class, 'createCookie']);
Route::get('/cookie/getCookie', [CookieController::class, 'getCookie']);
Route::get('/cookie/deleteCookie', [CookieController::class, 'deleteCookie']);

Route::get('/middleware', function () {
    return "Middleware";
})->middleware('contoh'); // Registrasi middleware di route

Route::get('/middleware/group', function () {
    return "Middleware";
})->middleware(['contohGroup']); // Registrasi middleware di route

Route::get('/middleware/parameter', function () {
    return "Middleware";
})->middleware('contohParameter:Rakhaware37,401'); // Registrasi middleware di route dengan parameter

Route::get('/form', [FormController::class, 'form']);
Route::post('/form', [FormController::class, 'submitForm']);

Route::post('/file/fileUpload', [StorageController::class, 'fileUpload'])->withoutMiddleware([VerifyCsrfToken::class]); //Exclude Middleware
Route::get('/phpinfo', function () {
    return phpinfo();
});

/*
Route Group

Route Prefix => digunakan untuk memberikan prefix (awalan) pada route, ini berguna ketika ingin membuat route dengan URL yang awalannya hampir sama

dibanding menulis route satu persatu, kita bisa menggunakan route group untuk mengelompokkan route yang memiliki prefix yang sama

Route::get('/redirect/to', [RedirectController::class, 'redirectTo']);
Route::get('/redirect/from', [RedirectController::class, 'redirectFrom']);
Route::get('/redirect/user', [RedirectController::class, 'redirectUser']);
Route::get('/redirect/action', [RedirectController::class, 'redirectAction']);
Route::get('/redirect/hello/{name}', [RedirectController::class, 'redirectHello']);
Route::get('/redirect/external', [RedirectController::class, 'redirectToExternal']);

menjadi seperti dbawah ini:


== Route MiddleWare ==
Digunakan untuk memberikan middleware pada route group didalam group middleware tsb.

== Route Controller ==
Digunakan untuk memberikan controller pada route group didalam group controller tsb.
*/

Route::prefix('/redirect')->group(function () {
    Route::get('/to', [RedirectController::class, 'redirectTo']);
    Route::get('/from', [RedirectController::class, 'redirectFrom']);
    Route::get('/user', [RedirectController::class, 'redirectUser']);
    Route::get('/action', [RedirectController::class, 'redirectAction']);
    Route::get('/hello/{name}', [RedirectController::class, 'redirectHello']);
    Route::get('/external', [RedirectController::class, 'redirectToExternal']);
});

Route::middleware(['contohParameter:Rakhaware37,401'])->group(function () {
    Route::get('/middleware/group1', function () {
        return "Tes";
    });
    Route::get('/middleware/group2', function () {
        return "Middleware";
    });
    Route::get('/middleware/group3', function () {
        return "Middleware";
    });
});

Route::controller(ResponseController::class)->group(
    function () {
        Route::get('/response/helloResponse', 'helloResponse');
        Route::get('/response/responseHeader', 'responseHeader');
        Route::get('/response/responseView', 'responseView');
        Route::get('/response/responseJson', 'responseJson');
        Route::get('/response/responseFile', 'responseFile');
        Route::get('/response/responseDownload', 'responseDownload');
    }
);

/*
Get current menggunakan facades URL = $url = url()->current() / url()->full;

Get Named Route menggunakan facades URL = $url = url()->route('routeName', ['parameter' => 'value']) / url()->route('routeName', ['parameter' => 'value'], false);

Get URL of Controller Action menggunakan facades URL = $url = url()->action('Controller@action', ['parameter' => 'value']) / url()->action('Controller@action', ['parameter' => 'value'], false);
*/
Route::get('/currentUrl', function () {
    return URL::full();
});

Route::get('/namedUrl', function () {
    return URL::route('blog', ['blogId' => 1]);
});

Route::get('/controllerAction', function () {
    return action([FormController::class, 'form']);
});

Route::get('/session/putSession', [SessionController::class, 'putSession']);
Route::get('/session/getSession', [SessionController::class, 'getSession']);
Route::get('/error/sample', function () {
    throw new Exception("Error Sample");
});
