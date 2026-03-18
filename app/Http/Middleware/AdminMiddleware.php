<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        //Verificar si la sesión es activa
        if (!auth()->check()) {
            //Si no hay sesión activa, redirigir al login
            return redirect()->route('registro')
            ->with('error', 'Se debe registrar e iniciar sesión');
        }

        //Verificar si el usuario es administrador
        if (!auth::user()->is_admin) {
            //Si el usuario no es administrador, redirigir al home
            return redirect()->route('libros.index')
            ->with('error', 'No cuentas con permisos de administrador');
        }

        
        return $next($request);
    }
}
