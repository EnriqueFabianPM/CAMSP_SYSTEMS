@extends('layouts.dashboard')

@section('content')
    <div class="max-w-5xl mx-auto">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">
                Detalle del Log
            </h2>

            <a href="{{ route('logs.index') }}"
                class="px-4 py-2 bg-slate-800 text-white rounded-xl text-xs font-bold hover:bg-black">
                <i class="fas fa-arrow-left mr-2"></i> VOLVER
            </a>
        </div>

        {{-- CARD --}}
        <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 p-8 space-y-6">

            {{-- USUARIO --}}
            <div>
                <h4 class="text-xs font-black text-slate-500 uppercase mb-1">Usuario</h4>

                @if($log->causer)
                    <p class="text-lg font-bold text-slate-800">
                        {{ $log->causer->nombre }}
                    </p>
                    <span class="text-xs text-blue-600 font-mono">
                        ID: {{ $log->causer->id }}
                    </span>
                @else
                    <span class="text-slate-400">Sistema</span>
                @endif
            </div>

            {{-- ACCIÓN --}}
            <div>
                <h4 class="text-xs font-black text-slate-500 uppercase mb-1">Acción</h4>
                <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-xs font-bold uppercase">
                    {{ $log->description }}
                </span>
            </div>

            {{-- MÓDULO --}}
            <div>
                <h4 class="text-xs font-black text-slate-500 uppercase mb-1">Módulo</h4>
                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-bold">
                    {{ $log->log_name ?? 'general' }}
                </span>
            </div>

            {{-- REGISTRO AFECTADO --}}
            <div>
                <h4 class="text-xs font-black text-slate-500 uppercase mb-1">Registro afectado</h4>
                <p class="text-sm text-slate-700">
                    <strong>Tabla:</strong> {{ class_basename($log->subject_type) ?? 'N/A' }} <br>
                    <strong>ID:</strong> {{ $log->subject_id ?? 'N/A' }}
                </p>
            </div>

            {{-- FECHA --}}
            <div>
                <h4 class="text-xs font-black text-slate-500 uppercase mb-1">Fecha</h4>
                <p class="text-sm text-slate-700">
                    {{ $log->created_at->format('d/m/Y H:i:s') }}
                </p>
            </div>

            {{-- PROPIEDADES (JSON) --}}
            @if($log->properties && $log->properties->count())
                <div>
                    <h4 class="text-xs font-black text-slate-500 uppercase mb-2">Cambios / Datos</h4>

                    <div class="bg-slate-900 text-green-400 text-xs p-4 rounded-xl overflow-x-auto font-mono">
                        <pre>{{ json_encode($log->properties, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection