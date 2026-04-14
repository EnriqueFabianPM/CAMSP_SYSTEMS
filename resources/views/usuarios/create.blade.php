@extends('layouts.dashboard')
@section('title', 'Nuevo Usuario')

@section('content')

<div class="max-w-5xl mx-auto form-card">

    {{-- HEADER --}}
    <div class="form-header">
        <h2>Registrar Usuario</h2>
        <p>Completa la información del nuevo integrante</p>
    </div>

    <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data"
        class="p-8 space-y-6">

        @csrf

        {{-- DATOS PERSONALES --}}
        <div class="form-section">
            <p class="form-section-title">Datos personales</p>

            <div class="grid md:grid-cols-2 gap-5">

                <div>
                    <label class="form-label">Identificador</label>
                    <input type="text" name="identificador" required class="form-input">
                </div>

                <div>
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input">
                </div>

                <div>
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" required class="form-input">
                </div>

                <div>
                    <label class="form-label">Apellidos</label>
                    <input type="text" name="apellidos" required class="form-input">
                </div>

                <div>
                    <label class="form-label">Teléfono</label>
                    <input type="text" name="telefono" class="form-input">
                </div>

                <div>
                    <label class="form-label">CURP</label>
                    <input type="text" name="curp" class="form-input">
                </div>

            </div>
        </div>

        {{-- SISTEMA --}}
        <div class="form-section">
            <p class="form-section-title">Sistema</p>

            <div class="grid md:grid-cols-2 gap-5">

                <div>
                    <label class="form-label">Rol</label>
                    <select name="rol" class="form-input">
                        <option value="estudiante">Estudiante</option>
                        <option value="docente">Docente</option>
                        <option value="padre">Padre</option>
                        <option value="visitante">Visitante</option>
                    </select>
                </div>

                <div>
                    <label class="form-label">Estatus</label>
                    <select name="estatus" class="form-input">
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                </div>

                <div>
                    <label class="form-label">Taller</label>
                    <input type="text" name="taller_asignado" class="form-input">
                </div>

                <div>
                    <label class="form-label">Condición</label>
                    <input type="text" name="condicion" class="form-input">
                </div>

            </div>
        </div>

        {{-- FOTO --}}
        <div class="form-section">
            <p class="form-section-title">Imagen</p>

            <div class="form-photo">
                <input type="file" name="foto">
            </div>
        </div>

        {{-- OBSERVACIONES --}}
        <div>
            <label class="form-label">Observaciones</label>
            <textarea name="observaciones" rows="3" class="form-input form-textarea"></textarea>
        </div>

        {{-- BOTONES --}}
        <div class="form-actions">
            <button type="reset" class="btn-cancel">
                Limpiar
            </button>

            <button type="submit" class="btn-save">
                Registrar usuario
            </button>
        </div>

    </form>
</div>

@endsection