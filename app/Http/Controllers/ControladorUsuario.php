<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Mail\UsuarioQR;

class ControladorUsuario extends Controller
{
    public function dashboard(): View
    {
        return view('dashboard');
    }

    public function index(Request $request): View
    {
        $query = User::query();
        $userLogueado = Auth::user();

        if ($userLogueado->rol === 'admin') {
            // Acceso Total
        } elseif ($userLogueado->esEmpleado()) {
            $query->where('rol', '!=', 'admin');
        } elseif ($userLogueado->rol === 'estudiante') {
            $query->whereIn('rol', ['estudiante', 'docente', 'director']);
        } elseif ($userLogueado->rol === 'padre') {
            $query->where('responsable_id', $userLogueado->id);
        } else {
            $query->where('id', $userLogueado->id);
        }

        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        if ($request->filled('rol')) {
            $query->where('rol', $request->rol);
        }

        if ($request->filled('taller')) {
            $query->where('taller_asignado', 'like', '%' . $request->taller . '%');
        }

        $usuarios = $query->orderBy('nombre', 'asc')
            ->paginate(15)
            ->withQueryString();

        return match ($userLogueado->rol) {
            'admin' => view('admin.index', compact('usuarios')),
            'docente', 'director', 'guardia', 'servicios_escolares' => view('docente.index', compact('usuarios')),
            'estudiante' => view('estudiante.index', compact('usuarios')),
            'padre', 'visitante' => view('padre.index', compact('usuarios')),
            default => view('dashboard'),
        };
    }

    public function show($identificador): View
    {
        $usuario = User::where('identificador', $identificador)->firstOrFail();
        $userLogueado = auth()->user();

        if ($userLogueado->rol !== 'admin') {
            if ($usuario->rol === 'admin')
                abort(403);
            if ($userLogueado->rol === 'padre' && $usuario->responsable_id !== $userLogueado->id)
                abort(403);
        }

        return view('usuarios.show', compact('usuario'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            // 🔑 IDENTIDAD
            'identificador' => 'required|string|max:50|unique:users,identificador',
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',

            // 📧 CONTACTO
            'email' => 'nullable|email|unique:users,email',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',

            // 🧾 PERSONALES
            'curp' => 'nullable|string|max:18',
            'fecha_nacimiento' => 'nullable|date',

            // 🎓 INFO ESCOLAR / LABORAL
            'condicion' => 'nullable|string|max:255',
            'taller_asignado' => 'nullable|string|max:255',
            'responsable_id' => 'nullable|exists:users,id',

            // 📝 EXTRA
            'observaciones' => 'nullable|string',

            // 🔐 CONTROL
            'rol' => 'required|in:admin,docente,estudiante,padre,visitante,director,guardia,servicios_escolares',
            'estatus' => 'required|in:activo,inactivo',

            // 🖼️ FOTO
            'foto' => 'nullable|image|max:2048',

            // 🔑 PASSWORD OPCIONAL
            'password' => 'nullable|string|min:6',
        ]);

        // 🧠 LÓGICA INTELIGENTE SEGÚN ROL

        // Si es estudiante → puede tener responsable
        if ($validated['rol'] !== 'estudiante') {
            $validated['responsable_id'] = null;
        }

        // Si NO es estudiante o empleado → quitar datos académicos
        if (!in_array($validated['rol'], ['estudiante', 'docente', 'director', 'guardia', 'servicios_escolares'])) {
            $validated['taller_asignado'] = null;
            $validated['condicion'] = null;
        }

        // 🖼️ FOTO
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('perfiles', 'public');
        }

        // 🔐 PASSWORD (auto si no viene)
        $validated['password'] = Hash::make(
            $request->password ?? $validated['identificador']
        );

        // ⚡ CREAR USUARIO
        $usuario = User::create($validated);

        return redirect()
            ->route('usuarios.show', $usuario->identificador)
            ->with('success', 'Usuario registrado correctamente.');
    }

    public function edit($identificador): View
    {
        $usuario = User::where('identificador', $identificador)->firstOrFail();
        $userLogueado = auth()->user();

        // El Admin edita todo. Empleados editan a todos menos Admins.
        if ($userLogueado->rol !== 'admin' && !$userLogueado->esEmpleado()) {
            if ($userLogueado->id !== $usuario->id)
                abort(403);
        }

        if ($usuario->rol === 'admin' && $userLogueado->rol !== 'admin')
            abort(403);

        $padres = User::where('rol', 'padre')->get();
        return view('usuarios.edit', compact('usuario', 'padres'));
    }

    public function update(Request $request, $identificador): RedirectResponse
    {
        $usuario = User::where('identificador', $identificador)->firstOrFail();

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $usuario->id,
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'curp' => 'nullable|string|max:18',
            'fecha_nacimiento' => 'nullable|date',
            'condicion' => 'nullable|string|max:255',
            'taller_asignado' => 'nullable|string|max:255',
            'responsable_id' => 'nullable|exists:users,id',
            'observaciones' => 'nullable|string',
            'rol' => 'required',
            'estatus' => 'required',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($usuario->foto)
                Storage::disk('public')->delete($usuario->foto);
            $validated['foto'] = $request->file('foto')->store('perfiles', 'public');
        }

        $usuario->update($validated);

        return redirect()->route('usuarios.show', $usuario->identificador)->with('success', 'Actualizado.');
    }

    // --- MÉTODOS AJAX ---

    public function updateQRCode(Request $request, $identificador)
    {
        $usuario = User::where('identificador', $identificador)->firstOrFail();

        if ($request->filled('qrCodeData')) {
            $qrPath = 'qrs/' . $usuario->identificador . '_qr.png';
            $this->saveQR($request->qrCodeData, $qrPath);
            $usuario->update(['fotoqr' => $qrPath]);

            return response()->json(['success' => true, 'filePath' => asset('storage/' . $qrPath)]);
        }

        return response()->json(['success' => false], 400);
    }

    private function saveQR($base64Data, $path)
    {
        // Limpiar el prefijo de data:image/png;base64,
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Data));
        Storage::disk('public')->put($path, $imageData);
    }

    public function enviarCorreoQR($identificador)
    {
        $usuario = User::where('identificador', $identificador)->firstOrFail();
        if (!$usuario->email || !$usuario->fotoqr)
            return back()->with('error', 'Datos incompletos.');

        try {
            Mail::to($usuario->email)->send(new UsuarioQR($usuario));
            return back()->with('success', 'QR enviado por correo.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al enviar mail.');
        }
    }

    public function destroy(string $identificador): RedirectResponse
    {
        $usuario = User::where('identificador', $identificador)->firstOrFail();
        if ($usuario->rol === 'admin')
            abort(403);

        if ($usuario->foto)
            Storage::disk('public')->delete($usuario->foto);
        if ($usuario->fotoqr)
            Storage::disk('public')->delete($usuario->fotoqr);

        $usuario->delete();
        return back()->with('success', 'Usuario eliminado.');
    }

    // --- MÉTODOS ESPECIALES ---

    public function export()
    {
        return Excel::download(new UsersExport, 'Reporte_CAMSP.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required|mimes:xlsx,xls'
        ]);

        try {
            Excel::import(new UsersImport, $request->file('import_file'));

            return back()->with('success', 'Usuarios importados correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al importar: ' . $e->getMessage());
        }
    }

    public function cambiarRol(Request $request, $id)
    {
        if (auth()->user()->rol !== 'admin')
            abort(403);
        User::findOrFail($id)->update(['rol' => $request->nuevo_rol]);
        return redirect()->back()->with('success', 'Rol modificado.');
    }

    public function fichaPublica($identificador): View
    {
        $usuario = User::where('identificador', $identificador)->firstOrFail();

        // Restricciones básicas
        $userLogueado = auth()->user();

        if ($userLogueado->rol === 'visitante' && $usuario->rol !== 'visitante') {
            abort(403);
        }

        return view('usuarios.fichaPublica', compact('usuario'));
    }

    public function empleados()
    {
        $user = auth()->user();

        $query = User::whereIn('rol', ['docente', 'servicios_escolares', 'director']);

        if ($user->rol !== 'admin') {
            $query->where('rol', '!=', 'admin');
        }

        $usuarios = $query->paginate(15);

        return view('empleados.index', compact('usuarios'));
    }

    public function estudiantes()
    {
        $user = auth()->user();

        $query = User::where('rol', 'estudiante');

        if ($user->rol === 'padre') {
            $query->where('responsable_id', $user->id);
        }

        $usuarios = $query->paginate(15);

        return view('estudiantes.index', compact('usuarios'));
    }

    public function visitantes()
    {
        $user = auth()->user();

        $query = User::where('rol', 'visitante');

        // 🔒 visitante solo ve visitantes
        if ($user->rol === 'visitante') {
            $query->where('id', $user->id);
        }

        $usuarios = $query->paginate(15);

        return view('visitantes.index', compact('usuarios'));
    }

    public function consultaEstudiantes(Request $request)
    {
        $query = User::where('rol', 'estudiante');

        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        $usuarios = $query->paginate(15);

        return view('estudiantes.consulta', compact('usuarios'));
    }

    public function consultaEmpleados(Request $request)
    {
        $query = User::whereIn('rol', ['docente', 'director', 'servicios_escolares']);

        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        $usuarios = $query->paginate(15);

        return view('empleados.consulta', compact('usuarios'));
    }

    public function consultaVisitantes(Request $request)
    {
        $query = User::where('rol', 'visitante');

        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        $usuarios = $query->paginate(15);

        return view('visitantes.consulta', compact('usuarios'));
    }
}