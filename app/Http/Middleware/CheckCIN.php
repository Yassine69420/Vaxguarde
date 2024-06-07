<?php

namespace App\Http\Middleware;

use Closure;

class CheckCIN
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
        #voir si la page n'a pas une session CIN
        if (!$request->session()->has('CIN')) {
            #si oui retourner a la page de login
            return redirect('/Parentlogin');
        }

        #si non , passer 
        return $next($request);
    }
}