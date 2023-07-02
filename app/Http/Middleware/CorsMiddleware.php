<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Url a la que se le dará acceso en las peticiones
        $response->headers->set("Access-Control-Allow-Origin", "*");
        // Métodos a los que se da acceso
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, DELETE, OPTIONS');
        // Headers de la petición
        $response->headers->set("Access-Control-Allow-Headers", "X-Requested-With, Content-Type, X-Token-Auth, Authorization, Application"); 
        // Permitir credenciales
        $response->headers->set('Access-Control-Allow-Credentials', 'true');

        return $response;
    }
}
