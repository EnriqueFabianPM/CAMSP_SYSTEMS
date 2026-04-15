<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ControladorEvento extends Controller
{
    public function public()
    {
        $eventos = Evento::latest()->get(); // o paginate si quieres

        return view('eventos', compact('eventos'));
    }

    public function fichaPublica($id): View
    {
        $evento = Evento::findOrFail($id);

        return view('eventos.fichaPublica', compact('evento'));
    }

    // 🔹 LISTADO
    public function index(Request $request): View
    {
        $query = Evento::query();
        $user = Auth::user();

        // ⚠️ Evitar error si NO hay usuario logueado
        if ($user) {
            if ($user->rol === 'admin' || $user->rol === 'servicios_escolares') {
                // acceso total
            }
        }

        // 🔍 FILTROS
        if ($request->filled('titulo')) {
            $query->where('titulo', 'like', '%' . $request->titulo . '%');
        }

        // 📆 FILTRO POR MES
        if ($request->filled('mes')) {
            $query->whereMonth('fecha', $request->mes);
        }

        // 📅 FILTRO POR AÑO
        if ($request->filled('anio')) {
            $query->whereYear('fecha', $request->anio);
        }

        $eventos = $query->orderBy('fecha', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('eventos.index', compact('eventos'));
    }

    // 🔹 CREAR
    public function create(): View
    {
        return view('eventos.create');
    }

    // 🔹 GUARDAR
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'fecha' => 'nullable|date',
            'descripcion' => 'nullable|string',
            'link' => 'nullable|url',
            'imagenes.*' => 'nullable|image|max:2048',
        ]);

        $imagenesSubidas = [];

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $img) {
                // Generamos un nombre único para evitar sobreescribir
                $nombreArchivo = time() . '_' . $img->getClientOriginalName();

                // Movemos el archivo directamente a public/Imagenes/
                $img->move(public_path('Imagenes'), $nombreArchivo);

                // Guardamos la ruta relativa que asset() entiende
                $imagenesSubidas[] = 'Imagenes/' . $nombreArchivo;
            }
        }

        $validated['imagenes'] = $imagenesSubidas;

        Evento::create($validated);

        return redirect()->route('eventos.index')
            ->with('success', 'Evento creado correctamente.');
    }

    // 🔹 SHOW
    public function show($id): View
    {
        $evento = Evento::findOrFail($id);
        return view('eventos.show', compact('evento'));
    }

    // 🔹 EDIT
    public function edit($id): View
    {
        $evento = Evento::findOrFail($id);
        return view('eventos.edit', compact('evento'));
    }

    // 🔹 UPDATE
    public function update(Request $request, $id): RedirectResponse
    {
        $evento = Evento::findOrFail($id);

        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'fecha' => 'nullable|date',
            'descripcion' => 'nullable|string',
            'link' => 'nullable|url',
            'imagenes.*' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagenes')) {
            // Borrar imágenes físicas anteriores de public/Imagenes
            if ($evento->imagenes) {
                foreach ($evento->imagenes as $img) {
                    $rutaFisica = public_path($img);
                    if (file_exists($rutaFisica)) {
                        unlink($rutaFisica);
                    }
                }
            }

            $imagenesNuevas = [];
            foreach ($request->file('imagenes') as $img) {
                $nombreArchivo = time() . '_' . $img->getClientOriginalName();
                $img->move(public_path('Imagenes'), $nombreArchivo);
                $imagenesNuevas[] = 'Imagenes/' . $nombreArchivo;
            }

            $validated['imagenes'] = $imagenesNuevas;
        } else {
            unset($validated['imagenes']);
        }

        $evento->update($validated);

        return redirect()->route('eventos.show', $evento->id)
            ->with('success', 'Evento actualizado.');
    }

    // 🔹 DELETE
    public function destroy($id): RedirectResponse
    {
        $evento = Evento::findOrFail($id);

        if ($evento->imagenes) {
            foreach ($evento->imagenes as $img) {
                Storage::disk('public')->delete($img);
            }
        }

        $evento->delete();

        return back()->with('success', 'Evento eliminado.');
    }

    public function consulta(Request $request): View
    {
        $query = Evento::query();

        if ($request->filled('titulo')) {
            $query->where('titulo', 'like', '%' . $request->titulo . '%');
        }

        $eventos = $query->orderBy('fecha', 'desc')
            ->paginate(12)
            ->withQueryString();

        return view('eventos.consulta', compact('eventos'));
    }
}