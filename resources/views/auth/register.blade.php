<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAMSP - Registro de Usuario</title>
    <link rel="stylesheet" href="{{ asset('styles/authloginregister.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="auth-page-bg">
    <div class="auth-card" style="max-width: 500px;">
        <div class="auth-header" style="text-align: center; margin-bottom: 2rem;">
            <div
                style="background: #ffffff; width: 120px; height: 120px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); overflow: hidden; border: 2px solid #e2e8f0;">
                <img src="{{ asset('Imagenes/CAM Logo.jpeg') }}" alt="Logo CAM"
                    style="width: 100%; height: 100%; object-fit: contain; padding: 10px;">
            </div>
            <h2 style="color: #1e4e8c; font-weight: 700; margin-bottom: 5px;">Registro de Usuario</h2>
            <p style="color: #64748b; font-size: 0.9rem;">Únete a nuestra comunidad educativa</p>
        </div>

        <form method="POST" action="{{ route('register') }}" id="formRegistro">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="input-group">
                    <label>Nombre(s)</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" required>
                </div>
                <div class="input-group">
                    <label>Apellidos</label>
                    <input type="text" name="apellidos" value="{{ old('apellidos') }}" required>
                </div>
            </div>

            <div class="input-group">
                <label for="rol">Tipo de Usuario</label>
                <select id="rol" name="rol" required onchange="aplicarProtocoloMedico()">
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="estudiante">🎓 Estudiante</option>
                    <option value="empleado">👨‍🏫 Empleado</option>
                    <option value="padre">👨‍👩‍👧 Padre/Tutor</option>
                    <option value="visitante">👤 Visitante</option>
                </select>
            </div>

            <div id="seccion-restringida"
                style="display: none; background: #f8fafc; border: 1px solid #e2e8f0; padding: 15px; border-radius: 8px; margin-top: 10px;">
                <p style="font-size: 0.8rem; color: #1e4e8c; font-weight: 600; margin-bottom: 10px;">
                    ℹ️ Información sujeta a validación administrativa
                </p>

                <div class="input-group">
                    <label id="label-id">Identificador Oficial</label>
                    <input type="text" id="input-id" name="identificador" placeholder="Pendiente de asignación">
                </div>

                <div id="campos-estudiante" style="display: none;">
                    <div class="input-group">
                        <label>Condición o Diagnóstico</label>
                        <input type="text" name="condicion" value="Pendiente de evaluación médica" readonly
                            style="background-color: #f1f5f9; color: #64748b; cursor: not-allowed; border: 1px dashed #cbd5e1;">
                    </div>

                    <div class="input-group">
                        <label>Taller Asignado</label>
                        <input type="text" value="Por asignar tras entrevista" readonly
                            style="background-color: #f1f5f9; color: #64748b; cursor: not-allowed;">
                    </div>
                </div>
            </div>

            <div class="input-group">
                <label>Correo Electrónico</label>
                <input type="email" name="email" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="input-group">
                    <label>Contraseña</label>
                    <input type="password" name="password" required>
                </div>
                <div class="input-group">
                    <label>Confirmar</label>
                    <input type="password" name="password_confirmation" required>
                </div>
            </div>

            <button type="submit" class="btn-auth">Finalizar Registro</button>
        </form>

        <script>
            function aplicarProtocoloMedico() {
                const rol = document.getElementById('rol').value;
                const secRestringida = document.getElementById('seccion-restringida');
                const camposEstudiante = document.getElementById('campos-estudiante');
                const labelId = document.getElementById('label-id');
                const inputId = document.getElementById('input-id');

                // Reset
                secRestringida.style.display = 'none';
                camposEstudiante.style.display = 'none';
                inputId.readOnly = false;

                if (rol === 'estudiante' || rol === 'empleado') {
                    secRestringida.style.display = 'block';
                    labelId.innerText = (rol === 'estudiante') ? 'Matrícula (Solo lectura)' : 'ID de Empleado (Solo lectura)';

                    // Simulación de sistema médico: El usuario ve el campo pero el Admin lo llena después
                    inputId.readOnly = true;
                    inputId.placeholder = "Asignado por Control Escolar";

                    if (rol === 'estudiante') {
                        camposEstudiante.style.display = 'block';
                    }
                }
            }
        </script>

        <div
            style="display: flex; justify-content: space-between; align-items: flex-end; margin-top: 25px; border-top: 1px solid #f1f5f9; padding-top: 20px;">

            {{-- Lado Izquierdo: Registro --}}
            <div style="text-align: left;">
                <span style="font-size: 0.9rem; color: #64748b;">¿Ya tienes cuenta?</span>
                <br>
                <a class="auth-link" href="{{ route('login') }}">Inicia sesión aquí</a>
            </div>

            {{-- Lado Derecho: Volver --}}
            <div style="text-align: right;">
                <a class="auth-link" href="{{ route('welcome') }}">
                    Volver a la página principal
                </a>
            </div>

        </div>
    </div>
</body>

</html>