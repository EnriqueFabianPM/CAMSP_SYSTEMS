@extends('layouts.app')

@section('content')
    <h1>Registrar Nuevo Usuario</h1>

    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf

        <label>Identificador:</label>
        <input type="text" name="identificador" required><br>

        <label>Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label>Apellidos:</label>
        <input type="text" name="apellidos"><br>

        <label>Email:</label>
        <input type="email" name="email"><br>

        <label>Rol:</label>
        <select name="rol" required>
            <option value="">Seleccionar</option>
            <option value="admin">Admin</option>
            <option value="docente">Docente</option>
            <option value="estudiante">Estudiante</option>
            <option value="padre">Padre</option>
            <option value="visitante">Visitante</option>
        </select><br>

        <label>Contraseña:</label>
        <input type="password" name="password"><br>

        <button type="submit">Guardar</button>
    </form>

    <a href="{{ route('usuarios.index') }}">Volver</a>
@endsection