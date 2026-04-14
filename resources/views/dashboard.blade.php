@extends('layouts.dashboard')
@section('title', 'Panel de Control - CAMSP')

@section('content')
    @php 
        $user = Auth::user();
        $role = $user->rol; 
        $isEmp = $user->esEmpleado();
        // Identificamos al padre si tiene el rol o tiene hijos asignados en la DB 
        $isPadre = ($role === 'padre' || $user->hijos()->count() > 0);
    @endphp

    <div class="flex flex-col items-center justify-center py-6">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-extrabold text-gray-800 tracking-tight text-shadow">Centro de Mando CAMSP</h1>
            <p class="text-gray-500 text-lg mt-2 uppercase tracking-widest font-semibold border-b-2 border-blue-500 inline-block px-4">
                Portal {{ str_replace('_', ' ', $role) }}
            </p>
        </div>

        <div class="flex flex-wrap justify-center gap-8 w-full max-w-7xl px-4">

            {{-- CUADRO 1: GESTIÓN OPERATIVA --}}
            @if($role === 'admin' || $role === 'servicios_escolares')
                <div class="dashboard-card bg-admin">
                    <h3 class="text-xl font-bold text-red-700 mb-4 border-b pb-2"><i class="fas fa-tools mr-2"></i> Gestión Operativa</h3>
                    <div class="space-y-3">
                        <a href="{{ route('usuarios.index') }}" class="btn-big bg-red-600 text-white shadow-md">CRUD de Usuarios</a>
                        <a href="#" class="btn-big bg-gray-800 text-white shadow-md">Gestión de Eventos</a>
                        <a href="{{ route('usuarios.export') }}" class="btn-big bg-red-50 text-red-700 border border-red-200">Exportar Datos Excel</a>
                    </div>
                </div>
            @endif

            {{-- CUADRO 2: CONTROL ACADÉMICO --}}
            @if($isEmp)
                <div class="dashboard-card bg-docente">
                    <h3 class="text-xl font-bold text-green-700 mb-4 border-b pb-2"><i class="fas fa-chart-line mr-2"></i> Control Académico</h3>
                    <div class="space-y-3">
                        <a href="#" class="btn-big bg-green-600 text-white shadow-md">Analizar Resultados (Gráficas)</a>
                        <a href="#" class="btn-big bg-green-500 text-white shadow-md">Configurar Evaluaciones</a>
                        <a href="{{ route('usuarios.index') }}" class="btn-big bg-green-50 text-green-700 border border-green-200">Consultar Personal</a>
                    </div>
                </div>
            @endif

            {{-- CUADRO 3: MÓDULO ESTUDIANTIL --}}
            @if($role === 'admin' || $role === 'docente' || $role === 'estudiante')
                <div class="dashboard-card bg-estudiante">
                    <h3 class="text-xl font-bold text-blue-700 mb-4 border-b pb-2"><i class="fas fa-book-reader mr-2"></i> Módulo Estudiantil</h3>
                    <div class="space-y-3">
                        <a href="#" class="btn-big bg-blue-600 text-white shadow-md">Evaluaciones Disponibles</a>
                        <a href="{{ route('usuarios.index') }}" class="btn-big bg-blue-500 text-white shadow-md">Consultar Compañeros</a>
                        <a href="#" class="btn-big bg-blue-50 text-blue-700 border border-blue-200">Ver Mis Respuestas</a>
                    </div>
                </div>
            @endif

            {{-- CUADRO 4: SERVICIOS Y CITAS (Abierto a Visitantes/SEP) --}}
            <div class="dashboard-card bg-visitante">
                <h3 class="text-xl font-bold text-yellow-700 mb-4 border-b pb-2"><i class="fas fa-calendar-alt mr-2"></i> Servicios y Citas</h3>
                <div class="space-y-3">
                    <a href="#" class="btn-big bg-yellow-400 text-gray-900 shadow-md font-bold">Generar Cita CAM</a>
                    <a href="#" class="btn-big bg-yellow-500 text-white shadow-md">Contestar Encuesta Servicio</a>
                    @if($role === 'admin')
                        <a href="#" class="btn-big bg-yellow-50 text-yellow-800 border border-yellow-200 text-xs">Historial de Gráficas</a>
                    @endif
                </div>
            </div>

            {{-- CUADRO 5: PORTAL FAMILIAR --}}
            @if($role === 'admin' || $isPadre)
                <div class="dashboard-card border-l-purple-600">
                    <h3 class="text-xl font-bold text-purple-700 mb-4 border-b pb-2"><i class="fas fa-user-friends mr-2"></i> Portal Familiar</h3>
                    <div class="space-y-3">
                        @if($isPadre && $role !== 'admin')
                            <a href="{{ route('usuarios.index') }}" class="btn-big bg-purple-600 text-white shadow-md">Ver Progreso de mi Hijo</a>
                        @endif
                        <a href="{{ route('usuarios.index') }}" class="btn-big bg-purple-500 text-white shadow-md">Consultar Personal</a>
                        <a href="#" class="btn-big bg-purple-50 text-purple-700 border border-purple-200">Encuestas de Tutor</a>
                    </div>
                </div>
            @endif

        </div>
    </div>

    <style>
        .dashboard-card { 
            flex: 1 1 320px; max-width: 360px; padding: 2.5rem; 
            border-radius: 1.5rem; background: white; 
            border-left: 8px solid transparent; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .dashboard-card:hover { transform: translateY(-8px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
        .btn-big { display: block; width: 100%; padding: 0.85rem; border-radius: 1rem; text-align: center; font-weight: 700; font-size: 0.95rem; }
        .bg-admin { border-left-color: #e53e3e; }
        .bg-docente { border-left-color: #38a169; }
        .bg-estudiante { border-left-color: #3182ce; }
        .bg-visitante { border-left-color: #ecc94b; }
        .border-l-purple-600 { border-left: 8px solid #805ad5; }
    </style>
@endsection