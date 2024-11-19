<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class alreadyAuth
{

    public function handle(Request $request, Closure $next): Response
    {
        
        if(session("auth") && sizeof(session("auth")) > 0)
        {
            return redirect()->route("admin.accueil");
        }

        return $next($request);
    
    }

}
