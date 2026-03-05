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

</head>

<body class="@auth panel @else publico @endauth">

    <header class="navbar">

        <div class="navbar-container">

            <a href="{{ route('welcome') }}" class="navbar-brand">

                <img src="{{ asset('images/cam-logo-sm.png') }}" class="logo-sm">

                <span>CAM San Pedro</span>

            </a>

            <nav class="navbar-links">

                @auth

                    <a href="{{ route('dashboard') }}" class="nav-item">
                        <i class="fa-solid fa-gauge"></i> Panel
                    </a>

                    <a href="{{ route('profile.edit') }}" class="nav-item">
                        <i class="fa-solid fa-user"></i> Perfil
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="nav-item logout">
                            <i class="fa-solid fa-right-from-bracket"></i> Salir
                        </button>
                    </form>

                @else

                    <a href="{{ route('welcome') }}" class="nav-item">Inicio</a>

                    <a href="{{ route('login') }}" class="nav-item">
                        <i class="fa-solid fa-right-to-bracket"></i> Entrar
                    </a>

                    <a href="{{ route('register') }}" class="nav-item registro">
                        Registrarse
                    </a>

                @endauth

            </nav>

        </div>

    </header>


    <main class="content">

        @yield('content')

    </main>


    <footer class="footer">

        <div class="footer-grid">

            <div>

                <strong>CAM Laboral San Pedro</strong>

                <p>Formación para la vida y el trabajo con inclusión.</p>

            </div>

            <div>

                <p><i class="fa-solid fa-location-dot"></i> San Pedro Garza García</p>

                <p><i class="fa-solid fa-phone"></i> +52 81 1234 5678</p>

            </div>

            <div>

                <a href="https://www.facebook.com/camlaboralsanpedro" target="_blank">
                    <i class="fab fa-facebook"></i> Facebook
                </a>

            </div>

        </div>

        <p class="copy">© {{ date('Y') }} CAM San Pedro</p>

    </footer>

</body>

</html>