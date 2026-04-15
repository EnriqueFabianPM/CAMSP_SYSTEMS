@extends('layouts.dashboard')

@section('title', $evento->titulo)

@section('content')

    <div class="max-w-5xl mx-auto bg-white p-10 rounded-2xl shadow space-y-6">

        {{-- HEADER --}}
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-black">{{ $evento->titulo }}</h1>
                <p class="text-slate-500 mt-1">
                    {{ $evento->fecha?->format('d/m/Y') ?? 'Sin fecha' }}
                </p>
            </div>
        </div>

        {{-- DESCRIPCIÓN --}}
        <p class="text-slate-700 leading-relaxed">
            {{ $evento->descripcion }}
        </p>

        {{-- GALERÍA --}}
        @if($evento->imagenes)
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($evento->imagenes as $img)
                    <img src="{{ asset($img) }}" class="h-40 w-full object-cover rounded-xl hover:scale-105 transition">
                @endforeach
            </div>
        @endif

        {{-- LINK --}}
        @if($evento->link)
            <a href="{{ $evento->link }}" target="_blank"
                class="inline-block bg-blue-600 text-white px-5 py-2 rounded-xl font-bold">
                Ver evento en Facebook
            </a>
        @endif

        {{-- EDIT --}}
        @if(auth()->user()->rol === 'admin' || auth()->user()->rol === 'servicios_escolares')
            <a href="{{ route('eventos.edit', $evento->id) }}"
                class="inline-block bg-amber-500 text-white px-5 py-2 rounded-xl font-bold ml-2">
                Editar evento
            </a>
        @endif

        <a href="{{ route('eventos.index') }}"
            class="inline-block bg-green-500 text-white px-5 py-2 rounded-xl font-bold ml-2">
            Volver
        </a>

    </div>

@endsection