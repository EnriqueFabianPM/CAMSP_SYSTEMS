<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Imports\UsersImport;

class ControladorUsuario extends Controller
{
    public function index(): View
    {
        $usuarios = User::orderBy('id', 'asc')->paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    public function create(): View
    {
        return view('usuarios.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'identificador' => 'required|string|max:255|unique:users',
            'nombre' => 'required|string|max:255',
            'apellidos' => 'nullable|string|max:255',
            'rol' => 'required|string|in:admin,docente,estudiante,visitante,padre',
            'email' => 'nullable|email|unique:users',
            'password' => 'nullable|string|min:6',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'curp' => 'nullable|string|max:18',
            'fecha_nacimiento' => 'nullable|date',
            'condicion' => 'nullable|string|max:255',
            'taller_asignado' => 'nullable|string|max:255',
            'responsable_id' => 'nullable|integer',
            'observaciones' => 'nullable|string',
            'estatus' => 'nullable|string|max:50',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        User::create($validated);

        return redirect()->route('usuarios.index')->with('success', 'Usuario registrado exitosamente.');
    }

    public function show(string $identificador): View
    {
        $usuario = User::where('identificador', $identificador)->firstOrFail();

        // Campos visibles según el rol
        $campos = match ($usuario->rol) {
            'estudiante' => ['identificador', 'nombre', 'apellidos', 'email', 'telefono', 'taller_asignado', 'condicion', 'responsable_id'],
            'docente' => ['identificador', 'nombre', 'apellidos', 'email', 'telefono', 'curp', 'fecha_nacimiento', 'taller_asignado'],
            'padre' => ['identificador', 'nombre', 'apellidos', 'email', 'telefono', 'responsable_id'],
            'visitante' => ['identificador', 'nombre', 'apellidos', 'email', 'telefono', 'observaciones', 'estatus'],
            default => array_keys($usuario->getAttributes()), // admin: todo
        };

        return view('usuarios.show', compact('usuario', 'campos'));
    }

    public function edit(string $identificador): View
    {
        $usuario = User::where('identificador', $identificador)->firstOrFail();
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, string $identificador): RedirectResponse
    {
        $usuario = User::where('identificador', $identificador)->firstOrFail();

        $validated = $request->validate([
            'identificador' => 'required|string|max:255|unique:users,identificador,' . $usuario->id,
            'nombre' => 'required|string|max:255',
            'apellidos' => 'nullable|string|max:255',
            'rol' => 'required|string|in:admin,docente,estudiante,visitante,padre',
            'email' => 'nullable|email|unique:users,email,' . $usuario->id,
            'password' => 'nullable|string|min:6',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'curp' => 'nullable|string|max:18',
            'fecha_nacimiento' => 'nullable|date',
            'condicion' => 'nullable|string|max:255',
            'taller_asignado' => 'nullable|string|max:255',
            'responsable_id' => 'nullable|integer',
            'observaciones' => 'nullable|string',
            'estatus' => 'nullable|string|max:50',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $usuario->update($validated);

        return redirect()->route('usuarios.index')->with('success', 'Datos actualizados exitosamente.');
    }

    public function destroy(string $identificador): RedirectResponse
    {
        $usuario = User::where('identificador', $identificador)->firstOrFail();
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }

    // Opcional: importar/exportar usuarios (ya implementado)
    public function importFromExcel(Request $request)
    {
        $request->validate(['import_file' => 'required|mimes:xlsx']);
        Excel::import(new UsersImport, $request->file('import_file'));
        return redirect()->route('usuarios.index')->with('success', 'Usuarios importados exitosamente.');
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'usuarios.xlsx');
    }
}