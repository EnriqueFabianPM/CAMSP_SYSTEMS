@extends('layouts.dashboard')
@section('content')
    <h1 class="text-2xl font-bold mb-4 text-slate-700">Compañeros y Profesores</h1>
    {{-- Filtro simple de nombre solamente --}}
    @include('partials.tablaUsuarios', ['usuarios' => $usuarios])
@endsection