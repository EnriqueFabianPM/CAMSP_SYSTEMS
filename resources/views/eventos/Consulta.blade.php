@extends('layouts.dashboard')

@section('content')

    <div class="max-w-6xl mx-auto space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <h1 class="text-2xl font-black text-slate-800 tracking-tight">
                Consulta de Eventos
            </h1>

            {{-- BUSCADOR --}}
            <form method="GET" action="{{ route('eventos.consulta') }}" class="w-full md:w-auto">
                <div class="relative">
                    <input type="text" name="titulo" placeholder="Buscar evento..." value="{{ request('titulo') }}"
                        class="w-full md:w-72 pl-10 pr-4 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-400 outline-none shadow-sm">

                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                </div>
            </form>

        </div>

        {{-- GRID --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">

            @forelse($eventos as $evento)

                <a href="{{ route('eventos.fichaPublica', $evento->id) }}"
                    class="group bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">

                    {{-- IMAGEN --}}
                    <div class="h-40 bg-slate-100 overflow-hidden">
                        @if($evento->imagenes && count($evento->imagenes))
                            <img src="{{ asset($evento->imagenes[0]) }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-400">
                                <i class="fas fa-image text-2xl"></i>
                            </div>
                        @endif
                    </div>

                    {{-- CONTENIDO --}}
                    <div class="p-4 space-y-2">

                        <p class="font-black text-slate-800 group-hover:text-blue-600 transition">
                            {{ $evento->titulo }}
                        </p>

                        <p class="text-xs text-slate-400">
                            {{ $evento->fecha ? $evento->fecha->format('d/m/Y') : 'Sin fecha' }}
                        </p>

                        <p class="text-sm text-slate-500 line-clamp-2">
                            {{ $evento->descripcion ?? 'Sin descripción' }}
                        </p>

                        <div class="flex justify-between items-center pt-2">
                            <span class="text-[10px] px-2 py-1 rounded-full bg-blue-100 text-blue-600 font-bold uppercase">
                                Evento
                            </span>

                            <i class="fas fa-arrow-right text-slate-300 group-hover:text-blue-500 transition"></i>
                        </div>

                    </div>

                </a>

            @empty

                <div class="col-span-full text-center py-16 text-slate-400">
                    <i class="fas fa-calendar text-4xl mb-3"></i>
                    <p class="font-bold">No se encontraron eventos</p>
                </div>

            @endforelse

        </div>

        {{-- PAGINACIÓN --}}
        <div class="pt-4">
            {{ $eventos->links() }}
        </div>

    </div>

@endsection