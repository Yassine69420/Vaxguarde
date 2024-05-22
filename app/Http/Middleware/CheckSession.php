<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        #voir si la page a une session INP
        if (!$request->session()->has('INP')) {
            #si non retourner a la page de login
            return redirect('/adminlogin');
        }

        #si oui , passer 
        return $next($request);
    }
}