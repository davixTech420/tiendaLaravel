<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateCliente
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Lógica de autenticación para clientes
        if (!auth('cliente')->check()) {
            // Redirige al login del cliente si no está autenticado
            return redirect()->route('logi');
        }

        return $next($request);
    }
}
