<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/*
Laravel HTTP Response => digunakan untuk mengirimkan response ke client, dengan menggunakan class ini, kita dapat merubah response yang akan dikirimkan ke client
    1. response() -> untuk mengirimkan response
    2. response()->json() -> untuk mengirimkan response dalam bentuk json
    3. response()->file() -> untuk mengirimkan file
    4. response()->download() -> untuk mengunduh file
    5. response()->stream() -> untuk mengirimkan file dalam bentuk stream
    7. response()->view() -> untuk mengirimkan view
    8. response()->redirect() -> untuk mengalihkan halaman
    9. response()->error() -> untuk mengirimkan error
    10. response()->make() -> untuk membuat response
*/

/*
Untuk memodifikasi HTTP Response header kita bisa menggunakan method header() pada response
    1. kita dapat menggunakan function response pada parameter ketiga
    2. withHeaders() -> untuk menambahkan beberapa header
    3. header() -> untuk menambahkan satu header
*/

class ResponseController extends Controller
{
    public function helloResponse()
    {
        return response('Hello, Response!', 200);
    }

    public function responseHeader()
    {
        return response('Hello, Response!', 200)->withHeaders([
            'Content-Type' => 'application/json',
            'App' => 'Belajar Laravel',
            'X-Header-Two' => 'Header Value',
        ])->header('Author', 'Rakha Nasjaya');
    }

    public function responseView()
    {
        return response()->view('belajar', ['name' => 'Rakha'], 200, ['Content-Type' => 'application/json']);
    }

    public function responseJson(): JsonResponse
    {
        return response()->json(['name' => 'Rakha', 'age' => 20]);
    }

    public function responseFile(): BinaryFileResponse
    {
        return response()->file(storage_path('app/public/picture/avatar.png'));
    }

    public function responseDownload(): BinaryFileResponse
    {
        return response()->download(storage_path('app/public/picture/avatar.png'), 'avatar.png');
    }
}
