@extends('layouts.dashboard')

@section('content')
    <div class="max-w-7xl mx-auto">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

            <div>
                <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">
                    Logs del Sistema CAMSP
                </h2>
                <p class="text-xs text-slate-500 mt-1">
                    Registro de actividades realizadas por los usuarios dentro del sistema
                </p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('dashboard') }}"
                    class="px-4 py-2 bg-slate-800 text-white rounded-xl text-xs font-bold hover:bg-black transition">
                    <i class="fas fa-arrow-left mr-2"></i> VOLVER
                </a>

                <a href="{{ route('logs.export', request()->all()) }}"
                    class="px-4 py-2 bg-green-600 text-white rounded-xl text-xs font-bold hover:bg-green-700 shadow-lg shadow-green-200 transition">
                    <i class="fas fa-file-excel mr-2"></i> EXPORTAR
                </a>
            </div>
        </div>

        {{-- MENSAJES --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-6 shadow">
                {{ session('success') }}
            </div>
        @endif

        {{-- TABLA --}}
        @include('partials.tablaLogs', ['logs' => $logs])

        <div class="mt-6">
            {{ $logs->links() }}
        </div>

    </div>
@endsection