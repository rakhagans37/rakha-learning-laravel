<?php
/*
Konfigurasi digunakan untuk menyimpan data yang tidak berubah-ubah.
Konfigruasi sendiri dibuat dalam bentuk array.

Cara memanggil konfigurasi:
    1. Menggunakan helper config('nama_file.key').
    2. Menggunakan helper config('nama_file.key', 'default_value').


== Configuration Cache ==
Semakin banyak file config, maka laravel akan semakin lambat untuk mencari file config yang kita panggil.
maka dari itu kita dapat menggunakan configuration cache.

Configuration cache adalah proses dimana laravel akan mengkompres file config menjadi satu file.

Perintah configuration cache
    1. Cara untuk membuat configuration cache => php artisan config:cache
    2. Cara untuk menghapus configuration cache => php artisan config:clear

Configuration cache akan disimpan didalam folder bootstrap/cache/config.php
*/

return [
    "author" => "Muhammad Rakha Nasjaya",
    "email" => "muhammadrakha5000@gmail.com",
    "address" => [
        "city" => "Bandung",
        "country" => "Indonesia",
        "zip_code" => "40257"
    ]
];
