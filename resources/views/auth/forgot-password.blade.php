<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAMSP - Recuperar Contraseña</title>
    {{-- Reutilizamos el CSS que ya tenemos para Login y Register --}}
    <link rel="stylesheet" href="{{ asset('styles/authloginregister.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="auth-page-bg">
    <div class="auth-card">
        {{-- Logotipo centrado en círculo blanco --}}
        <div class="auth-header" style="text-align: center; margin-bottom: 1.5rem;">
            <div
                style="background: #ffffff; width: 120px; height: 120px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); overflow: hidden; border: 2px solid #e2e8f0;">
                <img src="{{ asset('Imagenes/CAM Logo.jpeg') }}" alt="Logo CAM"
                    style="width: 100%; height: 100%; object-fit: contain; padding: 10px;">
            </div>
            <h2 style="color: #1e4e8c; font-weight: 700; margin-bottom: 5px;">¿Olvidaste tu clave?</h2>
            <p style="color: #64748b; font-size: 0.9rem; line-height: 1.4; padding: 0 10px;">
                No hay problema. Proporciona tu correo y te enviaremos un enlace para restablecerla.
            </p>
        </div>

        {{-- Estado de la sesión (Mensaje de éxito) --}}
        @if (session('status'))
            <div
                style="background: #eef7ee; color: #2f855a; padding: 12px; border-radius: 10px; margin-bottom: 20px; font-size: 0.9rem; text-align: center; border: 1px solid #c6f6d5;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            {{-- Dirección de Correo --}}
            <div class="input-group">
                <label for="email">Correo Electrónico</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    placeholder="tu.correo@ejemplo.com">
                @error('email')
                    <p class="text-danger" style="margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-top: 25px;">
                <button type="submit" class="btn-auth">
                    Enviar enlace al correo
                </button>
            </div>
        </form>

        <div style="text-align: center; margin-top: 25px; border-top: 1px solid #f1f5f9; padding-top: 20px;">
            <a class="auth-link" href="{{ route('login') }}">
                <i class="fa-solid fa-arrow-left"></i> Volver al inicio de sesión
            </a>
        </div>
    </div>
</body>

</html>