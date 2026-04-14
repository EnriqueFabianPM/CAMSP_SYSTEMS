@extends('layouts.dashboard')
@section('title', 'Editar - ' . $usuario->nombre)

@section('content')
    <div class="max-w-5xl mx-auto form-card">

        {{-- HEADER --}}
        <div class="form-header">
            <h2>Editar Usuario</h2>
            <p>{{ $usuario->nombre }} {{ $usuario->apellidos }}</p>
        </div>

        <form method="POST" enctype="multipart/form-data" action="{{ route('usuarios.update', $usuario->identificador) }}"
            class="p-8 space-y-6">

            @csrf
            @method('PATCH')

            {{-- FOTO --}}
            <div class="form-photo flex items-center gap-6">
                @if($usuario->foto)
                    <img src="{{ asset('storage/' . $usuario->foto) }}" class="w-20 h-20 rounded-xl object-cover shadow">
                @endif

                <div>
                    <label class="form-label">Foto de perfil</label>
                    <input type="file" name="foto">
                </div>
            </div>

            {{-- DATOS PERSONALES --}}
            <div class="form-section">
                <p class="form-section-title">Datos personales</p>

                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" value="{{ $usuario->nombre }}" class="form-input">
                    </div>

                    <div>
                        <label class="form-label">Apellidos</label>
                        <input type="text" name="apellidos" value="{{ $usuario->apellidos }}" class="form-input">
                    </div>

                    <div>
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ $usuario->email }}" class="form-input">
                    </div>

                    <div>
                        <label class="form-label">Teléfono</label>
                        <input type="text" name="telefono" value="{{ $usuario->telefono }}" class="form-input">
                    </div>
                </div>
            </div>

            {{-- INFO EXTRA --}}
            <div class="form-section">
                <p class="form-section-title">Información adicional</p>

                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="form-label">CURP</label>
                        <input type="text" name="curp" value="{{ $usuario->curp }}" class="form-input">
                    </div>

                    <div>
                        <label class="form-label">Fecha nacimiento</label>
                        <input type="date" name="fecha_nacimiento"
                            value="{{ optional($usuario->fecha_nacimiento)->format('Y-m-d') }}" class="form-input">
                    </div>

                    <div>
                        <label class="form-label">Condición</label>
                        <input type="text" name="condicion" value="{{ $usuario->condicion }}" class="form-input">
                    </div>

                    <div>
                        <label class="form-label">Taller</label>
                        <input type="text" name="taller_asignado" value="{{ $usuario->taller_asignado }}"
                            class="form-input">
                    </div>
                </div>
            </div>

            {{-- SISTEMA --}}
            <div class="form-section">
                <p class="form-section-title">Sistema</p>

                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="form-label">Rol</label>
                        <select name="rol" class="form-input form-select">
                            @foreach(['admin', 'docente', 'estudiante', 'padre', 'visitante', 'director', 'guardia', 'servicios_escolares'] as $rol)
                                <option value="{{ $rol }}" {{ $usuario->rol == $rol ? 'selected' : '' }}>
                                    {{ ucfirst($rol) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="form-label">Estatus</label>
                        <select name="estatus" class="form-input">
                            <option value="activo" {{ $usuario->estatus == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ $usuario->estatus == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- OBSERVACIONES --}}
            <div>
                <label class="form-label">Observaciones</label>
                <textarea name="observaciones" rows="3" class="form-input form-textarea">
                    {{ $usuario->observaciones }}
                </textarea>
            </div>

            {{-- BOTONES --}}
            <div class="form-actions">
                <button type="button" onclick="history.back()" class="btn-cancel">
                    Cancelar
                </button>

                <button type="submit" class="btn-save">
                    Guardar cambios
                </button>
            </div>

        </form>
    </div>

    {{-- CLASES REUTILIZABLES --}}
    <style>
        .label {
            @apply block text-xs font-bold text-slate-500 uppercase mb-1;
        }

        .input {
            @apply w-full rounded-xl border-slate-200 text-sm;
        }
    </style>

@endsection