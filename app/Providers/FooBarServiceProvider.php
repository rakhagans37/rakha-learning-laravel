<?php

namespace App\Providers;

use App\Data\Bar;
use App\Data\Foo;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

/*
Register => Digunakan untuk mendaftarkan service/dependency ke dalam container

Registrasi Service Provider perlu diberitahu ke laravel dengan cara
=> Menambahkan service provider ke dalam array providers di dalam file config/app.php

Jika kasus-nya sederhana seperti dependency injection antar interface dan class
Maka kita bisa menggunakan property $bindings atau $singletons dari service provider
*/


/*
DeferrableProvider => Digunakan untuk memberitahu laravel bahwa service provider ini hanya akan digunakan jika dibutuhkan saja

=> Namun ini tidak langsung berjalan karena service provider memiliki sistem compile yang akan disimpan di cache sehingga kita harus cek lagi cache
Service Provider di bootstrap/cache/services.php. Jika service provider tersebut ada di dalam array eager maka kita harus restart caching, dengan cara 
        1. Menghapus cache services => php artisan | php artisan clear-compiled
        2. Cek lagi caching baru setelah dilakukan test apakah service provider tersebut sudah masuk ke dalam array deferred atau masih di eager
*/

class FooBarServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public $singletons = [
        HelloService::class => HelloServiceIndonesia::class
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //Registrasi FooBar
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $this->app->singleton(Bar::class, function ($app) {
            return new Bar($app->make(Foo::class));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    // Memberitahu class apa saja yang perlu di DeferrableProvider
    public function provides()
    {
        return [
            Foo::class,
            Bar::class,
            HelloService::class
        ];
    }
}
