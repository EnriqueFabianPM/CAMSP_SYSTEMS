<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Maneja la autenticación con validación de Estatus y Roles.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // 1. Validar credenciales (Email y Password)
        $request->authenticate();

        // 2. Obtener el usuario que intenta entrar
        $user = Auth::user();

        // 3. PROTOCOLO DE SEGURIDAD CAMSP:
        // Verificamos si la cuenta está activa. Si no, lo sacamos de inmediato.
        if ($user->estatus !== 'Activo') {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw ValidationException::withMessages([
                'email' => 'Tu cuenta aún no ha sido verificada por un administrador o está desactivada.',
            ]);
        }

        // 4. PROTOCOLO PARA ADMINS:
        // Si quieres que el admin sea verificado por otro admin (status especial),
        // podrías añadir otra condición aquí.
        if ($user->rol === 'admin' && $user->email_verified_at === null) {
            Auth::guard('web')->logout();
            throw ValidationException::withMessages([
                'email' => 'Las cuentas administrativas requieren validación de identidad por correo.',
            ]);
        }

        $request->session()->regenerate();

        // Redirigir al dashboard interno
        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}