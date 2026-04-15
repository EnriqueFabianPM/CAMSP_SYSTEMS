@extends('layouts.dashboard')

@section('title', 'Crear Evento')

@section('content')

    <div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow">

        <h2 class="text-xl font-black mb-6">Nuevo Evento</h2>

        <form method="POST" action="{{ route('eventos.store') }}" enctype="multipart/form-data">
            @csrf

            <input type="text" name="titulo" placeholder="Título" class="w-full mb-4 p-3 border rounded-xl" required>

            <input type="date" name="fecha" class="w-full mb-4 p-3 border rounded-xl">

            <input type="url" name="link" placeholder="Link" class="w-full mb-4 p-3 border rounded-xl">

            <textarea name="descripcion" placeholder="Descripción" class="w-full mb-4 p-3 border rounded-xl"></textarea>

            {{-- IMÁGENES --}}
            {{-- Agregamos explícitamente multiple="multiple" para asegurar compatibilidad --}}
            <input type="file" name="imagenes[]" id="imagenes" multiple class="w-full mb-2">

            <p class="text-xs text-slate-400 mb-4">
                Máximo 4 imágenes
            </p>

            <button class="bg-blue-600 text-white px-6 py-2 rounded-xl font-bold">
                Crear evento
            </button>
        </form>

    </div>

@endsection