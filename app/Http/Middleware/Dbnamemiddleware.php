<?php

namespace App\Http\Middleware;

use Closure;
// use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session as Session;
use Symfony\Component\HttpFoundation\Response;

class Dbnamemiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // if (Session::has('dbName')) {
        //     Config::set('database.connections.mysql.database', session()->get('dbName'));
        // }
        return $next($request);
    }
}
