@extends('layouts.dashboard')
@section('title', 'Perfil Público - ' . $usuario->nombre)

@section('content')
    @php $auth = auth()->user(); @endphp

    {{-- 🔒 BLOQUEAR VISTA DE ADMIN PARA NO ADMINS --}}
    @if($usuario->rol === 'admin' && $auth->rol !== 'admin')
        <div class="max-w-md mx-auto mt-20 text-center p-10 bg-white rounded-3xl shadow-2xl border border-red-100">
            <i class="fas fa-user-shield text-red-500 text-6xl mb-4"></i>
            <h2 class="text-xl font-black text-slate-800 uppercase">Perfil Restringido</h2>
            <p class="text-slate-500 text-sm mt-2">No tienes permisos para ver la ficha de un administrador.</p>
        </div>
        @php return @endphp
    @endif

    <div class="max-w-4xl mx-auto space-y-8">
        {{-- 🔵 HEADER CARD --}}
        <div
            class="bg-gradient-to-br from-indigo-700 via-blue-600 to-blue-500 rounded-[2rem] p-8 text-white shadow-2xl relative overflow-hidden">
            {{-- Decoración abstracta --}}
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-10 -mt-10 blur-2xl"></div>

            <div class="flex flex-col md:flex-row items-center gap-8 relative z-10">
                {{-- FOTO CON BORDER --}}
                <div class="flex-shrink-0">
                    @if($usuario->foto)
                        <img src="{{ asset('storage/' . $usuario->foto) }}"
                            class="w-36 h-36 rounded-2xl object-cover border-4 border-white/30 shadow-2xl">
                    @else
                        <div
                            class="w-36 h-36 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center text-5xl font-black border-2 border-white/20">
                            {{ strtoupper(substr($usuario->nombre, 0, 1)) }}
                        </div>
                    @endif
                </div>

                {{-- INFO PRINCIPAL --}}
                <div class="flex-1 text-center md:text-left">
                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-3 mb-2">
                        <span
                            class="px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-[10px] font-black uppercase tracking-widest border border-white/10">
                            {{ str_replace('_', ' ', $usuario->rol) }}
                        </span>
                        <span
                            class="px-3 py-1 {{ $usuario->estatus === 'activo' ? 'bg-green-400' : 'bg-red-400' }} rounded-full text-[10px] font-black uppercase tracking-widest shadow-lg">
                            {{ $usuario->estatus }}
                        </span>
                    </div>
                    <h1 class="text-4xl font-black tracking-tighter mb-1">{{ $usuario->nombre }} {{ $usuario->apellidos }}
                    </h1>
                    <p class="text-blue-100 font-mono text-sm opacity-80">ID de Registro: #{{ $usuario->identificador }}</p>
                </div>

                {{-- QR --}}
                @if($usuario->fotoqr)
                    <div class="bg-white p-3 rounded-2xl shadow-2xl transform hover:rotate-3 transition-transform">
                        <img src="{{ asset('storage/' . $usuario->fotoqr) }}" class="w-24 h-24 object-contain">
                        <p class="text-[8px] text-slate-400 text-center mt-1 font-bold">ACCESO VÁLIDO</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- 🧾 GRID DE INFORMACIÓN --}}
        <div class="grid md:grid-cols-2 gap-6">
            {{-- Contacto Básico --}}
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                <h3 class="text-xs font-black uppercase text-blue-500 tracking-widest mb-6 flex items-center gap-2">
                    <i class="fas fa-address-book text-base"></i> Contacto de Referencia
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Correo
                            Institucional</label>
                        <p class="font-bold text-slate-700">{{ $usuario->email ?? 'No disponible' }}</p>
                    </div>
                    <div>
                        <label
                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Teléfono</label>
                        <p class="font-bold text-slate-700">{{ $usuario->telefono ?? 'No disponible' }}</p>
                    </div>
                </div>
            </div>

            {{-- Datos Académicos --}}
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                <h3 class="text-xs font-black uppercase text-indigo-500 tracking-widest mb-6 flex items-center gap-2">
                    <i class="fas fa-graduation-cap text-base"></i> Área Académica
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Taller
                            Asignado</label>
                        <p class="font-black text-indigo-600 text-lg capitalize">
                            {{ $usuario->taller_asignado ?? 'Sin taller' }}
                        </p>
                    </div>
                    <div>
                        <label
                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Responsable
                            Familiar</label>
                        <p class="font-bold text-slate-700">
                            {{ $usuario->responsable->nombre ?? 'Ninguno / No Aplica' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection