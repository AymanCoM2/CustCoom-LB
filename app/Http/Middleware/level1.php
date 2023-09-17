<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class level1
{

    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->isSuperUser == 1) {
            return $next($request);
        } else if ($request->user()->isSuperUser == 2 || $request->user()->isSuperUser == 3) {
            return redirect('login');
        }
    }
    
}
