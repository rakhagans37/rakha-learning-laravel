<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/*
Dalam Php biasa, kita menggunakan GET/POST untuk meraih data,
namun di laravel itu disatukan disatu tempat yaitu Request.

$request->input() -> untuk mengambil semua input yang ada baik itu GET/POST ataupun body dan query parameter
$request->query() -> untuk mengambil input khusus query parameter
$request->post() -> untuk mengambil input khusus body parameter
*/

/* 
Nested Input => Jika kita ingin mengambil input yang ada di dalam array, kita bisa menggunakan tanda titik (.) untuk mengakses input yang ada di dalam array.
    1. $request->input('user.name') -> untuk mengambil input user yang ada di dalam array
    2. $request->input() -> jika input digunakan tanpa parameter, maka akan mengembalikan semua input yang ada
    3. $request->input('product.*.name') -> untuk mengambil semua input nama product yang ada di dalam array
*/

/*
Melakukan konversi tipe data pada input
    1. $request->date('date') -> untuk mengambil input date dan mengubahnya menjadi tipe data date
    2. $request->boolean('boolean') -> untuk mengambil input boolean dan mengubahnya menjadi tipe data boolean
    3. $request->json() -> untuk mengambil input dan mengubahnya menjadi tipe data json
*/

class InputController extends Controller
{
    public function hello(Request $request): string
    {
        $name = $request->input('name');
        return "Hello, $name!";
    }

    public function helloArray(Request $request): string
    {
        $name = $request->input('name.first');
        return "Hello, $name!";
    }

    public function getAllInput(Request $request)
    {
        return json_encode($request->input());
    }

    public function getAllName(Request $request)
    {
        return json_encode($request->input('product.*.name'));
    }

    public function getDataType(Request $request)
    {
        $date = $request->date('birth_date', 'd-m-Y');
        $boolean = $request->boolean('married');

        return json_encode([
            'birth_date' => $date->format('d-m-Y'),
            'married' => $boolean
        ]);
    }
}
