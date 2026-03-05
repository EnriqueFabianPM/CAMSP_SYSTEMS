@extends('layouts.app')

@section('content')
    <h1>Detalles de {{ $usuario->nombre }} {{ $usuario->apellidos }}</h1>
    <p><strong>Rol:</strong> {{ ucfirst($usuario->rol) }}</p>
    <hr>

    <table border="1" cellpadding="5">
        @foreach($campos as $campo)
            <tr>
                <td><strong>{{ ucfirst(str_replace('_', ' ', $campo)) }}</strong></td>
                <td>{{ $usuario->$campo ?? 'N/A' }}</td>
            </tr>
        @endforeach
    </table>

    <a href="{{ route('usuarios.index') }}">← Volver</a>
@endsection