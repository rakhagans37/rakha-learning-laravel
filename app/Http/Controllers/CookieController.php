<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/*
Cookie pada laravel akan selalu di enkripsi secara otomatis, dan ketika membaca cookie akan otomatis di decrypt

Cara membuata cookie:
    1. Menggunakan method helper cookie()

Cara mengambil cookie:
    1. Menggunakan method helper cookie() pada request

Cara menghapus cookie:
    1. Menggunakan method helper cookie()->forget()
    2. Dengan membuat cookie dengan nama sama, namun dengan waktu yang sudah lewat
    3. Dengan method response withCookie()
    
Ketika create Cookie -> maka akan mengembalikan response dengan cookie yang telah di buat
Ketika get Cookie -> maka request akan membuat request header untuk cookie dan di oper ke response 
ketika tersedia

NOTE : Gunakan "/" pada parameter ketiga agar cookie dapat di akses di segala halaman
*/

class CookieController extends Controller
{
    public function createCookie()
    {
        // Membuat cookie
        $cookie = cookie('name', 'Nasjaya', 60, "/");
        return response('Hello World')->cookie($cookie);
    }

    public function getCookie(Request $request): JsonResponse
    {
        // Mengambil cookie
        return response()->json(
            [
                $request->cookie('name', 'user'),
                $request->cookie('member', 'false')
            ]
        );
    }

    public function deleteCookie()
    {
        // Menghapus cookie
        return response('Clear Cookie')->cookie(cookie()->forget('name'));
    }
}
