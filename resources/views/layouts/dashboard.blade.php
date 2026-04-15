<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestión Escolar - CAMSP')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('styles/styles.css') }}">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .navbar-cam {
            background-color: #2b6cb0;
            border-bottom: 4px solid #2f855a;
        }

        .nav-item-dashboard {
            @apply flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200;
            color: #e2e8f0;
        }

        .nav-item-dashboard:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffd600;
        }

        .nav-item-active {
            background-color: #2f855a;
            color: white !important;
        }

        /* --- ESTILOS CRÍTICOS DEL FOOTER --- */
        .footer-final {
            background: linear-gradient(135deg, #1e4e8c 0%, #0c1222 100%) !important;
            border-top: 4px solid #2f855a !important;
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .footer-final h4 {
            color: white !important;
            font-weight: 700;
        }

        .link-footer {
            color: inherit;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .link-footer:hover {
            color: #ffd600 !important;
            padding-left: 5px;
        }

        .cam-border-blue {
            border-left: 4px solid #2b6cb0;
            padding-left: 12px;
        }

        .cam-border-yellow {
            border-left: 4px solid #ffd600;
            padding-left: 12px;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen bg-gray-100">

    @php
        $user = Auth::user();
        $isAuth = Auth::check();
        $isEmp = $isAuth && $user->esEmpleado();
        $role = $isAuth ? $user->rol : null;

        $isAdmin = $role === 'admin';
        $isServicios = $role === 'servicios_escolares';

        // ✅ MODO CONSULTA GLOBAL
        $isConsultaMode = request()->routeIs('*.consulta*');
        $modoTexto = $isConsultaMode ? 'Consulta de' : 'Gestión de';
    @endphp

    <nav class="navbar-universal sticky top-0 z-50 shadow-xl px-6 py-3 flex items-center justify-between">
        {{-- Lado Izquierdo: Logo e Identidad --}}
        <div class="flex items-center gap-3">
            <a href="{{ route('welcome') }}" class="flex items-center gap-3 no-underline">
                <div class="bg-white p-1 rounded-lg shadow-sm">
                    <img src="{{ asset('Imagenes/CAM Logo.jpeg') }}" class="w-10 h-10 object-contain" alt="Logo CAM">
                </div>
                <div class="text-white">
                    <p class="font-bold leading-none tracking-tight uppercase m-0">CAM San Pedro</p>
                    <p class="text-[10px] text-blue-200 uppercase tracking-widest m-0">
                        {{ Auth::check() ? 'Sistema de Gestión' : 'Educación Inclusiva' }}
                    </p>
                </div>
            </a>
        </div>

        {{-- Centro: Enlaces Dinámicos por Rol --}}
        <div class="hidden lg:flex items-center space-x-1">

            {{-- 🏠 INICIO --}}
            <a href="{{ route('welcome') }}" class="nav-item-cam {{ Route::is('welcome') ? 'active' : '' }}">
                <i class="fas fa-home mr-1"></i> Pagina de Inicio
            </a>

            {{-- 👁️ VISITANTES (NO LOGUEADOS) --}}
            @guest
                <a href="{{ route('talleres') }}" class="nav-item-cam">Talleres</a>
                <a href="{{ route('proceso') }}" class="nav-item-cam">Inscripción</a>
                <a href="{{ route('eventos.public') }}" class="nav-item-cam">Eventos</a>
            @endguest

            {{-- 🔐 USUARIOS LOGUEADOS --}}
            @auth

                {{-- 📊 PANEL --}}
                <a href="{{ route('dashboard') }}" class="nav-item-cam {{ Route::is('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-th-large mr-1"></i> Panel de Control
                </a>

                {{-- 🟢 EMPLEADOS (ADMIN / DOCENTE / SERVICIOS) --}}
                @if($isEmp)
                    <div class="h-6 w-[1px] bg-blue-400/30 mx-2"></div>

                    {{-- 🧾 LOGS (solo admin) --}}
                    @if($isAdmin)
                        <a href="{{ route('logs.index') }}" class="nav-item-cam {{ Route::is('logs.*') ? 'active' : '' }}">
                            <i class="fas fa-file-alt mr-1"></i> Gestion de Logs
                        </a>
                    @endif

                    {{-- 👥 USUARIOS --}}
                    @if($isAdmin)
                        <a href="{{ route('usuarios.index') }}" class="nav-item-cam {{ Route::is('usuarios.*') ? 'active' : '' }}">
                            <i class="fas fa-users mr-1"></i> Gestion de Usuarios
                        </a>
                    @endif

                    {{-- 🎓 ALUMNOS --}}
                    @if($isAdmin || $isServicios)
                        <a href="{{ route('estudiantes.index') }}"
                            class="nav-item-cam {{ Route::is('estudiantes.*') ? 'active' : '' }}">
                            <i class="fas fa-user-graduate mr-1"></i> Gestion de Alumnos
                        </a>
                    @endif

                    {{-- 👨‍🏫 EMPLEADOS --}}
                    @if($isAdmin || $isServicios)
                        <a href="{{ route('empleados.index') }}"
                            class="nav-item-cam {{ Route::is('empleados.*') ? 'active' : '' }}">
                            <i class="fas fa-user-tie mr-1"></i> Gestion de Empleados
                        </a>
                    @endif

                    {{-- 🟡 VISITANTES --}}
                    @if($isAdmin || $isServicios)
                        <a href="{{ route('visitantes.index') }}"
                            class="nav-item-cam {{ Route::is('visitantes.*') ? 'active' : '' }}">
                            <i class="fas fa-user-clock mr-1"></i> Gestion de Visitantes
                        </a>
                    @endif

                    {{-- 📅 Eventos --}}
                    @if($isAdmin || $isServicios)
                        <a href="{{ route('eventos.index') }}" class="nav-item-cam {{ Route::is('eventos.*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-check mr-1"></i> Gestion de Eventos
                        </a>
                    @endif
                @endif

                {{-- 🔵 ESTUDIANTES / PADRES --}}
                @if(!$isEmp)
                    <div class="h-6 w-[1px] bg-blue-400/30 mx-2"></div>

                    {{-- 👨‍🎓 CONSULTAR ALUMNOS --}}
                    <a href="{{ route('estudiantes.consulta') }}" class="nav-item-cam">
                        <i class="fas fa-user-graduate mr-1"></i> Consultar alumnos
                    </a>

                    {{-- 👨‍🎓 CONSULTAR EMPLEADOS --}}
                    <a href="{{ route('empleados.consulta') }}" class="nav-item-cam">
                        <i class="fas fa-user-graduate mr-1"></i> Consultar empleados
                    </a>

                    {{-- 👨‍🎓 CONSULTAR VISITANTES --}}
                    <a href="{{ route('visitantes.consulta') }}" class="nav-item-cam">
                        <i class="fas fa-user-graduate mr-1"></i> Consultar visitantes
                    </a>

                    {{-- 📅 CARTELERA --}}
                    <a href="{{ route('eventos.consulta') }}"
                        class="nav-item-cam {{ Route::is('eventos.public') ? 'active' : '' }}">
                        <i class="fas fa-calendar mr-1"></i> Consultar eventos
                    </a>
                @endif

            @endauth
        </div>

        {{-- Lado Derecho: Perfil y Salida --}}
        <div class="flex items-center gap-3">
            @auth
                <div class="text-right hidden sm:block pr-3 border-r border-blue-400/50">
                    <p class="text-white font-bold text-xs m-0 leading-none">{{ Auth::user()->nombre }}</p>
                    <p class="text-blue-200 text-[9px] uppercase font-black tracking-tighter m-0 mt-1">
                        {{ str_replace('_', ' ', Auth::user()->rol) }}
                    </p>
                </div>

                {{-- Link al Perfil --}}
                <a href="{{ route('usuarios.fichaPublica', Auth::user()->identificador) }}"
                    class="text-white hover:text-yellow-400 transition-transform hover:scale-110 p-2" title="Mi Perfil">
                    <i class="fa-solid fa-circle-user text-2xl"></i>
                </a>

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit"
                        class="bg-rose-600 hover:bg-rose-700 text-white w-9 h-9 rounded-xl flex items-center justify-center transition-all shadow-lg active:scale-95">
                        <i class="fas fa-power-off text-sm"></i>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-item-cam">Ingresar</a>
                <a href="{{ route('register') }}"
                    class="nav-item-cam bg-yellow-400 !text-slate-900 font-bold hover:bg-white shadow-lg shadow-yellow-500/20">Registro</a>
            @endauth
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <footer class="footer-final pt-12 pb-6 mt-auto">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-10">
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('Imagenes/CAM Logo.jpeg') }}"
                            class="w-12 h-12 rounded-lg bg-white p-1 shadow-lg" alt="Logo CAM">
                        <span class="text-white font-bold text-xl leading-tight">CAM Laboral <br> San Pedro</span>
                    </div>
                    <p class="text-sm opacity-80">
                        Formación integral para la vida y el trabajo de jóvenes con discapacidad intelectual.
                    </p>
                </div>

                <div>
                    <h4 class="cam-border-blue mb-6 uppercase text-sm tracking-widest">Mapa del Sitio</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('welcome') }}" class="link-footer"><i
                                    class="fas fa-chevron-right mr-2 text-xs"></i>Inicio</a></li>
                        <li><a href="{{ route('talleres') }}" class="link-footer"><i
                                    class="fas fa-chevron-right mr-2 text-xs"></i>Talleres</a></li>
                        <li><a href="{{ route('proceso') }}" class="link-footer"><i
                                    class="fas fa-chevron-right mr-2 text-xs"></i>Inscripción</a></li>
                        <li><a href="{{ route('eventos.public') }}" class="link-footer"><i
                                    class="fas fa-chevron-right mr-2 text-xs"></i>Eventos</a></li>
                        <li><a href="{{ route('dashboard') }}"
                                class="link-footer border-t border-slate-700 pt-2 mt-2 flex items-center gap-2"><i
                                    class="fas fa-columns"></i>Panel de Control</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="cam-border-yellow mb-6 uppercase text-sm tracking-widest">Contacto Directo</h4>
                    <div class="space-y-4 text-sm">
                        <div class="flex items-start gap-3">
                            <i class="fa-solid fa-location-dot text-red-500 mt-1"></i>
                            <p>Av Vascocelos y Lic. Verdad, Zona Los Sauces, 66238 San Pedro Garza García, N.L</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-phone text-green-500"></i>
                            <p>+52 81 1628 1634</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fab fa-facebook text-blue-400 text-lg"></i>
                            <a href="https://www.facebook.com/camlaboralsanpedro" target="_blank"
                                class="link-footer">/camlaboralsanpedro</a>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="pt-8 border-t border-slate-700 flex flex-col md:flex-row justify-between items-center gap-4 text-[10px] uppercase tracking-widest opacity-60">
                <p>© {{ date('Y') }} Centro de Atención Múltiple San Pedro</p>
                <p>Desarrollado por <span class="text-white font-bold uppercase">Enrique Fabian Pérez Medellin</span>
                </p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>