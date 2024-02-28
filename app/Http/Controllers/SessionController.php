<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function putSession(Request $request)
    {
        Session::put('name', 'Rakha');
        // atau $request->put('name', 'Rakha');
        // atau session()->put('name', 'Rakha');
        echo "Data has been added to the session";
    }

    public function getSession()
    {
        if (Session::has('name')) {
            echo Session::get('name');
        } else {
            echo 'No data in the session';
        }
    }
}
