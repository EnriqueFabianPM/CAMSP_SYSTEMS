@extends('layouts.dashboard')
@section('title', 'Expediente Completo - ' . $usuario->nombre)

@section('content')
@php $auth = auth()->user(); @endphp

<div class="max-w-6xl mx-auto space-y-8 pb-10">
    {{-- BARRA DE ACCIONES --}}
    <div class="flex justify-between items-center bg-white p-4 rounded-2xl shadow-sm border border-slate-100">
        <button onclick="history.back()" class="px-4 py-2 bg-slate-100 text-slate-600 rounded-xl font-bold hover:bg-slate-200 transition-all flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Volver
        </button>
        <div class="flex gap-3">
            <a href="{{ route('usuarios.fichaPublica', $usuario->identificador) }}" class="px-5 py-2 bg-blue-600 text-white rounded-xl font-black text-xs uppercase tracking-widest hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all">
                <i class="fas fa-id-badge mr-2"></i> Vista QR
            </a>
            @if($auth->rol === 'admin' || ($auth->esEmpleado() && $usuario->rol !== 'admin'))
                <a href="{{ route('usuarios.edit', $usuario->identificador) }}" class="px-5 py-2 bg-amber-500 text-white rounded-xl font-black text-xs uppercase tracking-widest hover:bg-amber-600 shadow-lg shadow-amber-200 transition-all">
                    <i class="fas fa-pen mr-2"></i> Editar Expediente
                </a>
            @endif
        </div>
    </div>

    {{-- GRID PRINCIPAL --}}
    <div class="grid lg:grid-cols-12 gap-8">
        {{-- COLUMNA IZQUIERDA: RESUMEN --}}
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white rounded-[2rem] p-8 shadow-xl border border-slate-100 text-center relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-indigo-500"></div>
                <div class="mb-6">
                    @if($usuario->foto)
                        <img src="{{ asset('storage/' . $usuario->foto) }}" class="w-40 h-40 rounded-full mx-auto object-cover border-4 border-slate-50 shadow-2xl">
                    @else
                        <div class="w-40 h-40 rounded-full mx-auto bg-slate-100 flex items-center justify-center text-5xl font-black text-slate-300">
                            <i class="fas fa-user-circle"></i>
                        </div>
                    @endif
                </div>
                <h1 class="text-2xl font-black text-slate-800 leading-tight mb-1">{{ $usuario->nombre }}<br>{{ $usuario->apellidos }}</h1>
                <p class="text-blue-500 font-bold uppercase text-[10px] tracking-[0.2em] mb-4">{{ str_replace('_', ' ', $usuario->rol) }}</p>
                
                <div class="grid grid-cols-2 gap-4 border-t border-slate-100 pt-6">
                    <div class="text-center">
                        <p class="text-[9px] font-black text-slate-400 uppercase">Estatus</p>
                        <p class="text-xs font-bold {{ $usuario->estatus === 'activo' ? 'text-green-600' : 'text-red-600' }}">{{ strtoupper($usuario->estatus) }}</p>
                    </div>
                    <div class="text-center">
                        <p class="text-[9px] font-black text-slate-400 uppercase">CURP</p>
                        <p class="text-xs font-bold text-slate-700">{{ $usuario->curp ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            {{-- MINI TARJETA DE ÚLTIMO ACCESO --}}
            <div class="bg-slate-900 rounded-3xl p-6 text-white shadow-xl">
                <p class="text-[9px] font-black text-white/40 uppercase tracking-widest mb-2">Seguridad del Sistema</p>
                <div class="flex items-center gap-3">
                    <i class="fas fa-history text-blue-400 text-xl"></i>
                    <div>
                        <p class="text-[10px] opacity-70">Última actividad:</p>
                        <p class="text-xs font-bold">{{ $usuario->ultimo_acceso ?? 'Sin registro' }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- COLUMNA DERECHA: DETALLES --}}
        <div class="lg:col-span-8 space-y-6">
            {{-- DATOS PERSONALES Y LEGALES --}}
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
                <h3 class="text-sm font-black uppercase text-slate-800 border-b pb-4 mb-6 flex items-center gap-2">
                    <i class="fas fa-file-invoice text-blue-500"></i> Información Administrativa
                </h3>
                <div class="grid md:grid-cols-2 gap-8 text-sm">
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase block mb-1">Identificador Escolar</label>
                        <p class="font-mono font-bold text-blue-600">{{ $usuario->identificador }}</p>
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase block mb-1">Fecha de Nacimiento</label>
                        <p class="font-bold text-slate-700">{{ $usuario->fecha_nacimiento ?? 'No registrada' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase block mb-1">Dirección Registrada</label>
                        <p class="font-bold text-slate-700">{{ $usuario->direccion ?? 'Sin domicilio vinculado' }}</p>
                    </div>
                </div>
            </div>

            {{-- CONDICIÓN MÉDICA / TALLER --}}
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
                <h3 class="text-sm font-black uppercase text-slate-800 border-b pb-4 mb-6 flex items-center gap-2">
                    <i class="fas fa-notes-medical text-rose-500"></i> Información Específica
                </h3>
                <div class="grid md:grid-cols-2 gap-8 text-sm">
                    <div class="p-4 bg-rose-50 rounded-2xl border border-rose-100">
                        <label class="text-[10px] font-black text-rose-500 uppercase block mb-1">Condición / Diagnóstico</label>
                        <p class="font-bold text-slate-800 italic">{{ $usuario->condicion ?? 'Ninguna reportada' }}</p>
                    </div>
                    <div class="p-4 bg-indigo-50 rounded-2xl border border-indigo-100">
                        <label class="text-[10px] font-black text-indigo-500 uppercase block mb-1">Taller de Capacitación</label>
                        <p class="font-black text-slate-800 uppercase">{{ $usuario->taller_asignado ?? 'Pendiente de asignar' }}</p>
                    </div>
                </div>
            </div>

            {{-- OBSERVACIONES --}}
            <div class="bg-amber-50 rounded-3xl p-8 border border-amber-100">
                <h3 class="text-xs font-black uppercase text-amber-600 tracking-widest mb-4">Bitácora / Observaciones</h3>
                <p class="text-slate-700 leading-relaxed italic">
                    {{ $usuario->observaciones ?? 'No existen comentarios adicionales sobre este expediente.' }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection