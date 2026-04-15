@extends('layouts.dashboard')

@section('title', 'Editar Evento')

@section('content')

    <div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow">

        <h2 class="text-xl font-black mb-6">Editar Evento</h2>

        <form method="POST" action="{{ route('eventos.update', $evento->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="text" name="titulo" value="{{ $evento->titulo }}" class="w-full mb-4 p-3 border rounded-xl">

            <input type="date" name="fecha" value="{{ $evento->fecha?->format('Y-m-d') }}"
                class="w-full mb-4 p-3 border rounded-xl">

            <input type="url" name="link" value="{{ $evento->link }}" class="w-full mb-4 p-3 border rounded-xl">

            <textarea name="descripcion" class="w-full mb-4 p-3 border rounded-xl">{{ $evento->descripcion }}</textarea>

            {{-- IMÁGENES ACTUALES --}}
            @if($evento->imagenes)
                <div class="grid grid-cols-4 gap-3 mb-4">
                    @foreach($evento->imagenes as $img)
                        <img src="{{ asset($img) }}" class="h-20 w-full object-cover rounded-lg">
                    @endforeach
                </div>
            @endif

            {{-- NUEVAS --}}
            <input type="file" name="imagenes[]" multiple accept="image/*">

            <p class="text-xs text-slate-400 mb-4">
                Máximo 4 imágenes (si subes nuevas, reemplazan las anteriores)
            </p>

            <button class="bg-amber-500 text-white px-6 py-2 rounded-xl font-bold">
                Guardar cambios
            </button>

        </form>

    </div>

@endsection