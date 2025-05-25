<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Laravel\SerializableClosure\Attributes\AsMiddleware;



// #[AsMiddleware('admin')]
class AdminMiddleware
{
    /**
     * maria 
     * fanpino
     * 8 2 63
     * 
     * kllame semana pasda el lunes, ustedes mandar el albutarol rojo 
     * 8 
     * 
     * 
     * 
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    //    public function handle(Request $request, Closure $next)
    // {
    //     if (!Auth::check() || Auth::user()->role !== 'admin') {
    //         return response()->json(['error' => 'Acceso denegado'], 403);
    //     }

    //     return $next($request);
    // }


    // public function handle(Request $request, Closure $next)
    // {
    //     if (!Auth::check() || Auth::user()->role !== 'admin') {
    //         return redirect('/events')->with('error', 'Acceso denegado.');
    //     }

    //     return $next($request);
    // }

    public function handle($request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        abort(403, 'Acceso denegado');
    }
}
