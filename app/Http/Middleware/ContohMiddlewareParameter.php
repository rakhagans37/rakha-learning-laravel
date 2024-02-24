<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContohMiddlewareParameter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, String $key = null, String $status = null)
    {
        $apiKey = $request->header('X-API-KEY');
        if (($apiKey ?? "Rakhaware37") == $key) {
            return $next($request);
        } else {
            return response()->json("Access Denied", ($status ?? 401));
        }
    }
}
