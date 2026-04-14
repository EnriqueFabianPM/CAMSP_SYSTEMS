<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAMSP - Iniciar Sesión</title>
    <link rel="stylesheet" href="{{ asset('styles/authloginregister.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="auth-page-bg">
    <div class="auth-card">
        <div class="auth-header" style="text-align: center; margin-bottom: 2rem;">
            <div
                style="background: #ffffff; width: 120px; height: 120px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); overflow: hidden; border: 2px solid #e2e8f0;">
                <img src="{{ asset('Imagenes/CAM Logo.jpeg') }}" alt="Logo CAM"
                    style="width: 100%; height: 100%; object-fit: contain; padding: 10px;">
            </div>
            <h2 style="color: #1e4e8c; font-weight: 700; margin-bottom: 5px;">Inicio de Sesión</h2>
            <p style="color: #64748b; font-size: 0.9rem;">Acceso al Sistema de Gestión Escolar</p>
        </div>

        {{-- Mensajes de error de estatus o baneo --}}
        @if (session('error'))
            <p
                style="color: #dc2626; background: #fee2e2; padding: 10px; border-radius: 8px; font-size: 0.85rem; text-align: center; margin-bottom: 15px; border: 1px solid #fecaca;">
                {{ session('error') }}
            </p>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group">
                <label for="email">Correo Institucional</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    placeholder="tu.correo@cam.edu.mx">
                @error('email') <p class="text-danger">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="password">Contraseña</label>
                <input id="password" type="password" name="password" required placeholder="••••••••">
                @error('password') <p class="text-danger">{{ $message }}</p> @enderror
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <label
                    style="font-size: 0.85rem; color: #374151; display: flex; align-items: center; gap: 5px; cursor: pointer;">
                    <input type="checkbox" name="remember"> Recordarme
                </label>
                <a class="auth-link" href="{{ route('password.request') }}">¿Olvidaste tu clave?</a>
            </div>

            <button type="submit" class="btn-auth">Ingresar al Plantel</button>
        </form>

        <div
            style="display: flex; justify-content: space-between; align-items: flex-end; margin-top: 25px; border-top: 1px solid #f1f5f9; padding-top: 20px;">
            <div style="text-align: left;">
                <span style="font-size: 0.9rem; color: #64748b;">¿No tienes cuenta?</span><br>
                <a class="auth-link" href="{{ route('register') }}">Regístrate aquí</a>
            </div>
            <div style="text-align: right;">
                <a class="auth-link" href="{{ route('welcome') }}">Volver al Inicio</a>
            </div>
        </div>
    </div>
</body>

</html>