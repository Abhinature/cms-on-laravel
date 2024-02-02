<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if( !empty($request->segment(1)) )
        {
            \App::setLocale($request->segment(1));
        }
        else {
            \App::setLocale('en');
        }
        return $next($request);
        
    }
}
