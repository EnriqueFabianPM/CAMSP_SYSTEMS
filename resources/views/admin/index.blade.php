@extends('layouts.dashboard')

@section('content')
    <div class="max-w-7xl mx-auto">

        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Gestión de Usuarios ADMIN CAMSP</h2>
            <a href="{{ route('dashboard') }}"
                class="px-4 py-2 bg-slate-800 text-white rounded-xl text-xs font-bold hover:bg-black transition-all">
                <i class="fas fa-arrow-left mr-2"></i> VOLVER AL PANEL
            </a>
        </div>

        {{-- BLOQUE DE IMPORTACIÓN --}}
        @if(auth()->user()->rol === 'admin')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-emerald-50 border border-emerald-100 p-6 rounded-3xl flex flex-col justify-between shadow-sm">
                    <div>
                        <h4 class="text-emerald-800 font-black text-sm uppercase mb-1">Importación desde Excel</h4>
                        <p class="text-emerald-600 text-xs mb-4">Sincroniza el registro escolar con tus documentos de Excel con
                            Macros.</p>
                    </div>
                    <form action="{{ route('usuarios.import') }}" method="POST" enctype="multipart/form-data"
                        class="flex gap-2">
                        @csrf
                        <input type="file" name="import_file" accept=".xlsx" required
                            class="flex-grow text-xs bg-white p-2 rounded-xl border border-emerald-200">
                        <button type="submit"
                            class="bg-emerald-600 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-emerald-700 shadow-lg shadow-emerald-200 transition-all">
                            SUBIR
                        </button>
                    </form>
                </div>

                <div class="bg-blue-50 border border-blue-100 p-6 rounded-3xl flex flex-col justify-between shadow-sm">
                    <div>
                        <h4 class="text-blue-800 font-black text-sm uppercase mb-1">Registro Manual</h4>
                        <p class="text-blue-600 text-xs mb-4">Añadir un nuevo estudiante, docente o visitante al sistema de
                            forma individual.</p>
                    </div>
                    <a href="{{ route('usuarios.create') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-blue-700 text-center shadow-lg shadow-blue-200 transition-all">
                        + NUEVO REGISTRO
                    </a>
                    <a href="{{ route('usuarios.export') }}"
                        class="bg-red-600 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-red-700 shadow-lg shadow-red-200 transition-all">
                        <i class="fas fa-file-excel mr-2"></i> EXPORTAR EXCEL
                    </a>
                </div>
            </div>
        @endif

        {{-- TABLA DE USUARIOS --}}
        @include('partials.tablaUsuarios', ['usuarios' => $usuarios])

        <div class="mt-6">
            {{ $usuarios->links() }}
        </div>
    </div>
@endsection