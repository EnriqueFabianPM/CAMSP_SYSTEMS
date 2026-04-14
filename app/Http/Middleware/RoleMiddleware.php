<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Verifica que el usuario autenticado tenga al menos uno de los roles requeridos.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        $rolesPermitidos = explode('|', $role);

        // CAMBIO: Usamos 'rol' (en español) como está en tu base de datos y reporte
        if (!in_array($user->rol, $rolesPermitidos)) {
            // Si no tiene permiso, lo mandamos al dashboard con un error
            return redirect('/dashboard')->with('error', 'Acceso no autorizado a esta sección.');
        }

        return $next($request);
    }
}