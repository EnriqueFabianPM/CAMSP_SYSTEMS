@extends('layouts.app')

@section('content')
    <h1>Editar Usuario {{ $usuario->nombre }}</h1>

    <form action="{{ route('usuarios.update', $usuario->identificador) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nombre:</label>
        <input type="text" name="nombre" value="{{ $usuario->nombre }}" required><br>

        <label>Apellidos:</label>
        <input type="text" name="apellidos" value="{{ $usuario->apellidos }}"><br>

        <label>Email:</label>
        <input type="email" name="email" value="{{ $usuario->email }}"><br>

        <label>Rol:</label>
        <select name="rol" required>
            @foreach(['admin', 'docente', 'estudiante', 'padre', 'visitante'] as $rol)
                <option value="{{ $rol }}" {{ $usuario->rol === $rol ? 'selected' : '' }}>
                    {{ ucfirst($rol) }}
                </option>
            @endforeach
        </select><br>

        <label>Contraseña (opcional):</label>
        <input type="password" name="password"><br>

        <button type="submit">Actualizar</button>
    </form>

    <a href="{{ route('usuarios.index') }}">Volver</a>
@endsection