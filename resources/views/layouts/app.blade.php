<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'CAM San Pedro')</title>

    <meta name="description"
        content="Centro de Atención Múltiple Laboral San Pedro — educación inclusiva y talleres de formación.">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('styles/styles.css') }}">

    <script src="https://cdn.tailwindcss.com">
        window.addEventListener("scroll", function () {
            document.getElementById("navbar").classList.toggle("scrolled", window.scrollY > 20);
        });
    </script>
</head>

<body class="flex flex-col min-h-screen bg-gray-100 @auth panel @else publico @endauth">

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
                <a href="{{ route('eventos') }}"
                    class="nav-item-cam {{ Route::is('proceso') ? 'active' : '' }}">Eventos</a>
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
                {{-- Enlace a la ficha propia envolviendo el nombre y el rol --}}
                <a href="{{ route('usuarios.show', Auth::user()->identificador) }}"
                    class="text-right hidden sm:block border-r border-blue-400 pr-4 no-underline group">
                    <p class="text-white font-bold text-sm leading-none m-0 group-hover:text-yellow-400 transition-colors">
                        {{ Auth::user()->nombre }}
                        <span class="text-yellow-400 text-[10px] font-black ml-1">(TÚ)</span>
                    </p>
                    <p class="text-blue-200 text-[10px] font-bold uppercase m-0 mt-1">
                        {{ str_replace('_', ' ', Auth::user()->rol) }}
                    </p>
                </a>

                {{-- Botón de Configuración (Breeze Profile) --}}
                <a href="{{ route('profile.edit') }}" class="text-white hover:text-yellow-400 transition-colors"
                    title="Configuración de Perfil">
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

    <main class="content flex-grow container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <footer class="footer-final pt-12 pb-6 mt-auto">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-10">

                {{-- Columna 1: Info --}}
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('Imagenes/CAM Logo.jpeg') }}" class="w-12 h-12 rounded-lg bg-white p-1"
                            alt="Logo CAM">
                        <span class="text-white font-bold text-xl leading-tight">
                            CAM Laboral <br> San Pedro
                        </span>
                    </div>
                    <p class="text-sm opacity-80 leading-relaxed">
                        Formación integral para la vida y el trabajo de jóvenes con discapacidad intelectual.
                    </p>
                </div>

                {{-- Columna 2: Mapa del Sitio --}}
                <div>
                    <h4 class="cam-border-blue mb-6 uppercase text-sm tracking-widest">Mapa del Sitio</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('welcome') }}" class="link-footer transition-all"><i
                                    class="fas fa-chevron-right mr-2 text-xs"></i>Inicio</a></li>
                        <li><a href="{{ route('talleres') }}" class="link-footer transition-all"><i
                                    class="fas fa-chevron-right mr-2 text-xs"></i>Talleres</a></li>
                        <li><a href="{{ route('proceso') }}" class="link-footer transition-all"><i
                                    class="fas fa-chevron-right mr-2 text-xs"></i>Inscripción</a></li>
                        <li><a href="{{ route('eventos') }}" class="link-footer transition-all"><i
                                    class="fas fa-chevron-right mr-2 text-xs"></i>Eventos</a></li>
                        @auth
                            <li><a href="{{ route('dashboard') }}"
                                    class="link-footer transition-all border-t border-slate-700 pt-2 mt-2 flex items-center gap-2"><i
                                        class="fas fa-columns"></i>Panel de Control</a></li>
                        @endauth
                    </ul>
                </div>

                {{-- Columna 3: Contacto --}}
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
                        <div class="flex items-center gap-3 group">
                            <i class="fab fa-facebook text-blue-400 text-lg"></i>
                            <a href="https://www.facebook.com/camlaboralsanpedro" target="_blank"
                                class="link-footer">/camlaboralsanpedro</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Créditos --}}
            <div
                class="pt-8 border-t border-slate-700 flex flex-col md:flex-row justify-between items-center gap-4 text-[10px] uppercase tracking-widest opacity-60">
                <p>© {{ date('Y') }} Centro de Atención Múltiple San Pedro</p>
                <p>Desarrollado por <span class="text-white font-bold">Enrique Fabian Pérez Medellin</span></p>
            </div>
        </div>
    </footer>
</body>

</html>