@extends('layouts.dashboard')

@section('content')
    <div class="max-w-7xl mx-auto">

        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-black text-slate-800 uppercase">
                Gestión de Estudiantes
            </h2>

            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-slate-800 text-white rounded-xl text-xs font-bold">
                ← Volver
            </a>
        </div>

        @include('partials.tablaUsuarios', ['usuarios' => $usuarios])

        <div class="mt-6">
            {{ $usuarios->links() }}
        </div>
    </div>
@endsection