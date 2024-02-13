<?php

namespace App\Http\Controllers;

use App\Services\HelloService;
use Illuminate\Http\Request;

//Controller digunakan untuk memisahkan logic aplikasi dari routing, sehingga logika routing tidak menumpuk di file routing.

/* 
Cara Registrasi controller kedalam route :
1. Registrasi controller kedalam route menggunakan method get() atau post() pada file web.php
2. Registrasi controller kedalam route menggunakan method resource() pada file web.php
3. Registrasi controller kedalam route menggunakan method apiResource() pada file api.php
*/

/*
Request adalah class yang digunakan untuk mengambil data dari request yang dikirim oleh user.
(Pengganti method $_GET, $_POST, $_FILES, $_COOKIE, $_SESSION, $_REQUEST, $_SERVER, $_ENV di PHP Native)

Request function yang berguna di request:

A.) Request Path
    1. $request->path() -> untuk mendapatkan path dari request
    2. $request->url() -> untuk mendapatkan url dari request
    3. $request->fullUrl() -> untuk mendapatkan full url dari request (termasuk query parameter nya)

B.) Request Method
    1. $request->method() -> untuk mendapatkan method dari request
    2. $request->isMethod('method') -> untuk mengecek apakah method request sama dengan parameter method yang diinputkan
    3  $request->header('key') -> untuk mendapatkan header dari request dengan key parameter
    4. $request->headers('key', 'default') -> untuk mendapatkan header dari request dengan key parameter, jika tidak ada akan mengembalikan default
    5. $request->bearerToken() -> untuk mendapatkan bearer token dari request
*/

class HelloController extends Controller
{
    private HelloService $helloService;

    public function __construct(HelloService $helloService)
    {
        $this->helloService = $helloService;
    }

    public function hello(Request $request, $name): string
    {
        return $this->helloService->sayHello($name);
    }

    public function request(Request $request): string
    {
        return $request->path() . PHP_EOL . $request->url() . PHP_EOL . $request->fullUrl() . PHP_EOL . $request->method() . PHP_EOL . $request->isMethod('GET')
            . PHP_EOL . $request->header('Accept');
    }
}
