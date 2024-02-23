<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/*
Kita juga bisa menggunakan route dengan menggunakan nama dan menambahkan parameter ke dalam route
    1. Menggunakan method redirect()->route(nama_route, parameter)
*/
/*
Redirect to contoller action
    1. Menggunakan method redirect()->action(nama_controller@nama_method)
*/

class RedirectController extends Controller
{
    public function redirectTo()
    {
        return "Redirect to";
    }

    public function redirectFrom(): RedirectResponse
    {
        return redirect("/redirect/to");
    }

    public function redirectUser()
    {
        return redirect()->route("userDetails", ["name" => "Rakha"]);
    }

    public function redirectHello(string $name): string
    {
        return "Halo, " . $name;
    }

    public function redirectAction(): RedirectResponse
    {
        return redirect()->action([RedirectController::class, 'redirectHello'], ['name' => 'Rakha']);
    }

    public function redirectToExternal(): RedirectResponse
    {
        return redirect()->away('https://www.traveloka.com');
    }
}
