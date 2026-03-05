<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAMSP - Iniciar Sesión</title>
    <link rel="stylesheet" href="{{ asset('styles/authloginregister.css') }}">
</head>
<body>
<div class="auth-card">
    <div class="auth-header">
        <span class="text-3xl">🏫</span>
        <h2>Iniciar Sesión en CAMSP</h2>
    </div>

    @if (session('status'))
        <p class="text-danger">{{ session('status') }}</p>
    @endif

    {{-- Breeze usa route("login") --}}
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="input-group">
            <label for="email">Correo Electrónico</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="tu.correo@cam.edu.mx">
            @error('email') <p class="text-danger">{{ $message }}</p> @enderror
        </div>

        <div class="input-group">
            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
            @error('password') <p class="text-danger">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-between mb-3">
            <label>
                <input type="checkbox" name="remember"> Recordarme
            </label>

            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
            @endif
        </div>

        <button type="submit" class="btn-primary">Ingresar</button>
    </form>

    <p style="text-align: center; margin-top: 20px;">
        ¿No tienes cuenta?
        <a class="auth-link" href="{{ route('register') }}">Regístrate aquí</a>
    </p>
</div>
</body>
</html>