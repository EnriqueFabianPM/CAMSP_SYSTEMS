@extends('layouts.dashboard')

@section('content')
    <div class="max-w-7xl mx-auto">

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">
                Gestión de Eventos CAMSP
            </h2>

            <a href="{{ route('dashboard') }}"
                class="px-4 py-2 bg-slate-800 text-white rounded-xl text-xs font-bold hover:bg-black">
                <i class="fas fa-arrow-left mr-2"></i> VOLVER
            </a>
        </div>

        {{-- CREAR --}}
        @if(auth()->user()->rol === 'admin' || auth()->user()->rol === 'servicios_escolares')
            <div class="mb-6">
                <a href="{{ route('eventos.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-xl text-xs font-bold">
                    + CREAR EVENTO
                </a>
            </div>
        @endif

        {{-- TABLA --}}
        @include('partials.tablaEventos', ['eventos' => $eventos])

        <div class="mt-6">
            {{ $eventos->links() }}
        </div>

    </div>
@endsection