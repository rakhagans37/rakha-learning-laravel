<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/*
Cara membuat middleware => php artisan make:middleware (NamaMiddleware)

Jika ingin meneruskan ke controller, maka kita dapat menggunakan Closure
*/

/*
Kita harus meregistrasi middleware kita di Kernel.php Supaya middleware kita bisa digunakan
    1. Middleware bisa di registrasi secara global, artinya middleware akan dijalankan di semua route => Daftarkan middleware di Kernel.php
    2. Middleware bisa di registrasi di route tertentu saja => Kita bisa langsung menggunakan class middleware atau pakai alias

Kita juga dapat membuat middleware group di Kernel.php => artinya kita bisa mengelompokkan middleware yang akan di jalankan di route tertentu
*/

/*
Kita juga bisa menambah parameter di middleware, Caranya adalah dengan menambahkan parameter di handle method, serta harus didaftarkan
parameter nya di kernel atau di web.php dengan menggunakan :parameter
*/

/*
Exclude Middleware => Jika kita ingin menghapus middleware di route tertentu
    1. Menggunakan method withoutMiddleware di route
*/

class ContohMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-API-KEY');
        if ($apiKey == 'Rakhaware37') {
            return $next($request);
        } else {
            return response()->json("Access Denied", 401);
        }
    }

    public function handleWithParameter(Request $request, Closure $next, string $key, string $status)
    {
        $apiKey = $request->header('X-API-KEY');
        if (($apiKey ?? "Rakhaware37") == $key) {
            return $next($request);
        } else {
            return response()->json("Access Denied", ($status ?? 401));
        }
    }
}
