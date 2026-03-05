<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAMSP - Registro de Usuario</title>
    <link rel="stylesheet" href="{{ asset('styles/authloginregister.css') }}">
</head>

<body>
    <div class="auth-card">
        <div class="auth-header">
            <span class="text-3xl">📝</span>
            <h2>Registro de Usuario</h2>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-group">
                <label for="nombre">Nombre</label>
                <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}" required>
            </div>

            <div class="input-group">
                <label for="apellidos">Apellidos</label>
                <input id="apellidos" type="text" name="apellidos" value="{{ old('apellidos') }}">
            </div>

            <div class="input-group">
                <label for="email">Correo Electrónico</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
            </div>

            <div class="input-group">
                <label for="password">Contraseña</label>
                <input id="password" type="password" name="password" required autocomplete="new-password">
            </div>

            <div class="input-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    autocomplete="new-password">
            </div>

            {{-- Rol --}}
            <div class="input-group">
                <label for="rol">Rol</label>
                <select id="rol" name="rol" required>
                    <option value="">Seleccione un rol...</option>
                    <option value="estudiante">Estudiante</option>
                    <option value="docente">Docente</option>
                    <option value="padre">Padre</option>
                    <option value="visitante">Visitante</option>
                </select>
            </div>

            <button type="submit" class="btn-primary">Registrarse</button>
        </form>

        <p style="text-align: center; margin-top: 20px;">
            <a class="auth-link" href="{{ route('login') }}">¿Ya tienes cuenta? Inicia sesión aquí</a>
        </p>
    </div>
</body>

</html>