<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class level3
{
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }
}
