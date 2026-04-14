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
    <nav class="navbar-universal sticky top-0 z-50 shadow-xl px-6 py-3 flex items-center justify-between">
        {{-- Lado Izquierdo: Logo e Identidad --}}
        <div class="flex items-center gap-3">
            <a href="{{ route('welcome') }}" class="flex items-center gap-3 no-underline">
                <div class="bg-white p-1 rounded-lg">
                    <img src="{{ asset('Imagenes/CAM Logo.jpeg') }}" class="w-10 h-10 object-contain" alt="Logo CAM">
                </div>
                <div class="text-white">
                    <p class="font-bold leading-none tracking-tight uppercase m-0">CAM San Pedro</p>
                    <p class="text-[10px] text-blue-200 uppercase tracking-widest m-0">
                        {{ Request::is('dashboard*') || Request::is('admin*') || Request::is('gestion*') ? 'Panel de Control' : 'Educación Inclusiva' }}
                    </p>
                </div>
            </a>
        </div>

        {{-- Centro: Enlaces Dinámicos --}}
        <div class="hidden lg:flex items-center space-x-2">
            <a href="{{ route('welcome') }}" class="nav-item-cam {{ Route::is('welcome') ? 'active' : '' }}">
                <i class="fas fa-home mr-1"></i> Inicio
            </a>

            {{-- Mostrar Talleres e Inscripción SOLO si NO estás en el Dashboard --}}
            @if(!Request::is('dashboard*') && !Request::is('admin*') && !Request::is('gestion*') && !Request::is('usuarios*'))
                <a href="{{ route('talleres') }}"
                    class="nav-item-cam {{ Route::is('talleres') ? 'active' : '' }}">Talleres</a>
                <a href="{{ route('proceso') }}"
                    class="nav-item-cam {{ Route::is('proceso') ? 'active' : '' }}">Inscripción</a>
                <a href="{{ route('proceso') }}"
                    class="nav-item-cam {{ Route::is('eventos') ? 'active' : '' }}">Eventos</a>
            @endif

            @auth
                <a href="{{ route('dashboard') }}" class="nav-item-cam {{ Route::is('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line mr-1"></i> Mi Panel
                </a>

                @if(Auth::user()->esEmpleado())
                    <a href="{{ route('usuarios.index') }}"
                        class="nav-item-cam {{ Route::is('usuarios.index') ? 'active' : '' }}">
                        <i class="fas fa-users-cog mr-1"></i> Usuarios
                    </a>
                @endif
            @endauth
        </div>

        {{-- Lado Derecho: Usuario / Login --}}
        <div class="flex items-center gap-4">
            @auth
                <a class="text-right hidden sm:block border-r border-blue-400 pr-4 no-underline group">
                    <p class="text-white font-bold text-sm leading-none m-0 group-hover:text-yellow-400 transition-colors">
                        {{ Auth::user()->nombre }}
                        <span class="text-yellow-400 text-[10px] font-black ml-1">(TÚ)</span>
                    </p>
                    <p class="text-blue-200 text-[10px] font-bold uppercase m-0 mt-1">
                        {{ str_replace('_', ' ', Auth::user()->rol) }}
                    </p>
                </a>

                {{-- Botón de Configuración (Breeze Profile) --}}
                <a href="{{ route('usuarios.fichaPublica', Auth::user()->identificador) }}"
                    class="text-white hover:text-yellow-400 transition-all hover:scale-110" title="Ver mi expediente">
                    <i class="fa-solid fa-user-gear text-xl"></i>
                </a>

                {{-- Botón Rojo de Salir --}}
                <form method="POST" action="{{ route('logout') }}" class="inline m-0">
                    @csrf
                    <button type="submit" title="Cerrar Sesión"
                        class="bg-rose-600 hover:bg-rose-700 text-white w-9 h-9 rounded-lg flex items-center justify-center transition-all shadow-lg hover:rotate-6">
                        <i class="fas fa-power-off"></i>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-item-cam">Iniciar Sesión</a>
                <a href="{{ route('register') }}"
                    class="nav-item-cam bg-yellow-400 !text-slate-900 font-bold hover:bg-yellow-500 shadow-lg shadow-yellow-900/20">Registrarse</a>
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
                        <li><a href="{{ route('eventos') }}" class="link-footer"><i
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