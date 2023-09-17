<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class level2
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->isSuperUser == 1 || $request->user()->isSuperUser == 2) {
            return $next($request);
        } else {
            return redirect('login');
        }
    }
    
   
}
