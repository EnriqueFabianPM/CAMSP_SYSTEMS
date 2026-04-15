@extends('layouts.dashboard')

@section('content')

    <div class="max-w-6xl mx-auto space-y-6">

        {{-- 🔷 HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <h1 class="text-2xl font-black text-slate-800 tracking-tight">
                Consulta de Alumnos
            </h1>

            {{-- BUSCADOR --}}
            <form method="GET" action="{{ route('estudiantes.consulta') }}" class="w-full md:w-auto">
                <div class="relative">
                    <input type="text" name="nombre" placeholder="Buscar alumno..." value="{{ request('nombre') }}"
                        class="w-full md:w-72 pl-10 pr-4 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-400 outline-none shadow-sm">

                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                </div>
            </form>

        </div>

        {{-- 🔲 GRID --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">

            @forelse($usuarios as $usuario)

                <a href="{{ route('usuarios.fichaPublica', $usuario->identificador) }}"
                    class="group bg-white rounded-2xl p-5 shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">

                    {{-- CONTENIDO --}}
                    <div class="flex items-center gap-4">

                        {{-- FOTO --}}
                        <div class="relative">
                            @if($usuario->foto)
                                <img src="{{ asset('storage/' . $usuario->foto) }}"
                                    class="w-16 h-16 rounded-xl object-cover border-2 border-white shadow">
                            @else
                                <div
                                    class="w-16 h-16 rounded-xl bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center font-black text-slate-600 text-lg shadow">
                                    {{ strtoupper(substr($usuario->nombre, 0, 1)) }}
                                </div>
                            @endif

                            {{-- DOT STATUS --}}
                            <span
                                class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full border-2 border-white 
                                                                                    {{ $usuario->estatus === 'activo' ? 'bg-green-400' : 'bg-red-400' }}">
                            </span>
                        </div>

                        {{-- INFO --}}
                        <div class="flex-1">
                            <p class="font-black text-slate-800 group-hover:text-blue-600 transition">
                                {{ $usuario->nombre }} {{ $usuario->apellidos }}
                            </p>

                            <p class="text-xs text-slate-400 font-mono">
                                #{{ $usuario->identificador }}
                            </p>

                            <span
                                class="inline-block mt-1 text-[10px] px-2 py-1 rounded-full bg-slate-100 text-slate-600 uppercase font-bold">
                                {{ $usuario->rol }}
                            </span>
                        </div>

                        {{-- ICONO --}}
                        <i class="fas fa-chevron-right text-slate-300 group-hover:text-blue-500 transition"></i>

                    </div>

                </a>

            @empty

                <div class="col-span-full text-center py-16 text-slate-400">
                    <i class="fas fa-users text-4xl mb-3"></i>
                    <p class="font-bold">No se encontraron alumnos</p>
                </div>

            @endforelse

        </div>

        {{-- PAGINACIÓN --}}
        <div class="pt-4">
            {{ $usuarios->links() }}
        </div>

    </div>

@endsection