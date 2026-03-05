@extends('layouts.app')

@section('content')
    <h1>Lista de Usuarios</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('usuarios.create') }}">➕ Nuevo Usuario</a>

    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Identificador</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->identificador }}</td>
                    <td>{{ $usuario->nombre }} {{ $usuario->apellidos }}</td>
                    <td>{{ $usuario->email ?? 'N/A' }}</td>
                    <td>{{ ucfirst($usuario->rol) }}</td>
                    <td>
                        <a href="{{ route('usuarios.show', $usuario->identificador) }}">Ver</a> |
                        <a href="{{ route('usuarios.edit', $usuario->identificador) }}">Editar</a> |
                        <form action="{{ route('usuarios.destroy', $usuario->identificador) }}" method="POST"
                            style="display:inline">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Eliminar usuario?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay usuarios registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $usuarios->links() }}
@endsection