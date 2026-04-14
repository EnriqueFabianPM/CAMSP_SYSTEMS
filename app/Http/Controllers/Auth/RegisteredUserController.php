<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Muestra la vista de registro institucional.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Maneja la solicitud de registro con validación de "Centro Médico".
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validación rigurosa (Se excluye 'admin' por seguridad)
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'rol' => ['required', 'string', 'in:docente,estudiante,visitante,padre'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. Preparación de datos con lógica de protección
        $userData = [
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'rol' => $request->rol,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'identificador' => 'PENDIENTE', // Asignado posteriormente por Admin
            'estatus' => 'Inactivo',        // Requiere aprobación manual
        ];

        // Inicialización de campos sensibles para estudiantes
        if ($request->rol === 'estudiante') {
            $userData['condicion'] = 'Pendiente de evaluación médica';
            $userData['taller_asignado'] = 'Sin asignar';
        }

        $user = User::create($userData);

        event(new Registered($user));

        // 3. Redirección controlada
        // En lugar de iniciar sesión, informamos que su cuenta está en revisión.
        return redirect()->route('login')->with('status', 'Registro exitoso. Tu cuenta será validada por la administración del CAMSP antes de permitir el acceso.');
    }
}