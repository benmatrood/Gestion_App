<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// import Gate
use Illuminate\Support\Facades\Gate;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // si l'utilisateur est admin il a accès à toutes les pages
        if(Gate::allows('admin'))
        {
            return $next($request);
        }
        // sinon il est redirigé vers la page d'accueil
        return redirect('/');
    }
}
