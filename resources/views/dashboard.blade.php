@extends('layouts.dashboard')
@section('title', 'Panel de Control - CAMSP')

@section('content')
    @php
        $user = Auth::user();
        $role = $user->rol;
        $isEmp = $user->esEmpleado();
        $isAdmin = $role === 'admin';
        $isServicios = $role === 'servicios_escolares';
    @endphp

    <div class="flex flex-col items-center justify-center py-6 px-4">

        <div class="text-center mb-10">
            <h1 class="text-4xl font-extrabold text-gray-800 tracking-tight text-shadow">
                Centro de Mando CAMSP
            </h1>
            <p
                class="text-gray-500 text-lg mt-2 uppercase tracking-widest font-semibold border-b-2 border-blue-500 inline-block px-4">
                Portal {{ str_replace('_', ' ', $role) }}
            </p>
        </div>

        <div class="dashboard-grid">

            {{-- 1. ADMIN --}}
            @if($role === 'admin')
                <div class="dashboard-card bg-admin span-2">
                    <h3 class="text-xl font-bold text-red-700 mb-4 border-b pb-2">
                        <i class="fas fa-tools mr-2"></i> MÓDULO ADMINISTRATIVO
                    </h3>

                    <div class="space-y-3">
                        <a href="{{ route('usuarios.index') }}" class="btn-big bg-red-600 text-white shadow-md">
                            Gestión de Usuarios
                        </a>
                        <a href="{{ route('logs.index') }}" class="btn-big bg-red-400 text-white shadow-md">
                            Ver logs del sistema
                        </a>
                    </div>
                </div>
            @endif

            {{-- 2. PERSONAL --}}
            @php
                $personalSpan = $isAdmin ? 'span-2' : 'span-3';
            @endphp
            <div class="dashboard-card bg-docente {{ $personalSpan }}">
                <h3 class="text-xl font-bold text-green-700 mb-4 border-b pb-2">
                    <i class="fas fa-chart-line mr-2"></i> MÓDULO DE PERSONAL
                </h3>

                <div class="space-y-3">
                    @if($isEmp)
                        <a href="{{ route('empleados.index') }}" class="btn-big bg-green-600 text-white shadow-md">
                            Gestión de Personal
                        </a>
                    @endif

                    <a href="{{ route('empleados.consulta') }}" class="btn-big bg-green-400 text-white shadow-md">
                        Consultar personal
                    </a>
                </div>
            </div>

            {{-- 3. ESTUDIANTES --}}
            @php
                $estSpan = 'span-6';
                if ($isAdmin) {
                    $estSpan = 'span-2';
                } elseif ($role === 'docente' || $role === 'servicios_escolares' || $role === 'estudiante') {
                    $estSpan = 'span-3';
                }
            @endphp
            <div class="dashboard-card bg-estudiante {{ $estSpan }}">
                <h3 class="text-xl font-bold text-blue-700 mb-4 border-b pb-2">
                    <i class="fas fa-book-reader mr-2"></i> MÓDULO DE ESTUDIANTES
                </h3>

                <div class="space-y-3">
                    @if($isEmp)
                        <a href="{{ route('estudiantes.index') }}" class="btn-big bg-blue-600 text-white shadow-md">
                            Gestión de Alumnos
                        </a>
                    @endif

                    <a href="{{ route('estudiantes.consulta') }}" class="btn-big bg-blue-400 text-white shadow-md">
                        Consultar alumnos
                    </a>
                </div>
            </div>

            {{-- 4. VISITANTES --}}
            @php
                $visSpan = 'span-6';
                if ($isAdmin || $isServicios) {
                    $visSpan = 'span-3';
                }
            @endphp
            <div class="dashboard-card bg-visitante {{ $visSpan }}">
                <h3 class="text-xl font-bold text-yellow-700 mb-4 border-b pb-2">
                    <i class="fas fa-user-clock mr-2"></i> MÓDULO DE VISITANTES
                </h3>

                <div class="space-y-3">
                    @if($isEmp)
                        <a href="{{ route('visitantes.index') }}" class="btn-big bg-yellow-600 text-white shadow-md">
                            Gestión de Visitantes
                        </a>
                    @endif

                    <a href="{{ route('visitantes.consulta') }}" class="btn-big bg-yellow-400 text-white shadow-md">
                        Consultar visitantes
                    </a>
                </div>
            </div>

            {{-- 5. EVENTOS --}}
            @php
                $eveSpan = 'span-6';
                if ($isAdmin || $isServicios) {
                    $eveSpan = 'span-3';
                }
            @endphp
            <div class="dashboard-card bg-evento {{ $eveSpan }}">
                <h3 class="text-xl font-bold text-purple-700 mb-4 border-b pb-2">
                    <i class="fas fa-calendar-alt mr-2"></i> MÓDULO DE EVENTOS
                </h3>

                <div class="space-y-3">
                    @if($isEmp)
                        <a href="{{ route('eventos.index') }}" class="btn-big bg-purple-600 text-white shadow-md">
                            Gestión de Eventos
                        </a>
                    @endif

                    <a href="{{ route('eventos.consulta') }}" class="btn-big bg-purple-400 text-white shadow-md">
                        Consultar eventos
                    </a>
                </div>
            </div>

        </div>
    </div>
    <style>
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            /* Base de 6 para dividir entre 3 y 2 */
            gap: 2rem;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Lógica de anchos */
        .span-2 {
            grid-column: span 2;
        }

        /* 3 por fila */
        .span-3 {
            grid-column: span 3;
        }

        /* 2 por fila */
        .span-6 {
            grid-column: span 6;
            max-width: 500px;
            justify-self: center;
            width: 100%;
        }

        /* 1 centrado */
        /* CARD */
        .dashboard-card {
            min-height: 280px;
            padding: 2.5rem;
            border-radius: 2rem;
            background: white;
            border-left: 10px solid transparent;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .dashboard-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.12);
        }

        /* BOTONES */
        .btn-big {
            display: block;
            width: 100%;
            padding: 0.9rem;
            border-radius: 1.2rem;
            text-align: center;
            font-weight: 800;
            font-size: 0.95rem;
            transition: 0.3s;
        }

        .btn-big:hover {
            filter: brightness(1.1);
            transform: scale(1.02);
        }

        /* COLORES CORREGIDOS */
        .bg-admin {
            border-left-color: #ef4444;
        }

        .bg-docente {
            border-left-color: #22c55e;
        }

        .bg-estudiante {
            border-left-color: #3b82f6;
        }

        .bg-visitante {
            border-left-color: #eab308;
        }

        /* Amarillo */
        .bg-evento {
            border-left-color: #a855f7;
        }

        /* Morado */
        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .dashboard-grid {
                grid-template-columns: repeat(4, 1fr);
            }

            .span-2,
            .span-3,
            .span-6 {
                grid-column: span 2;
                max-width: 100%;
            }
        }

        @media (max-width: 640px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .span-2,
            .span-3,
            .span-6 {
                grid-column: span 1;
            }
        }
</style> @endsection