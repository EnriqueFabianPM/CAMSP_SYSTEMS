@extends('layouts.app')

@section('title', 'CAM San Pedro')

@section('content')

    {{-- HERO --}}
    <section class="hero">

        <div class="hero-content">

            <h1 class="hero-title">
                Centro de Atención Múltiple <br> CAM San Pedro
            </h1>

            <p class="hero-subtitle">
                Formación para la vida y el trabajo en un ambiente inclusivo.
                Desarrollamos habilidades laborales y sociales para una vida independiente.
            </p>

            <div class="hero-ctas">

                @auth

                    <a href="{{ route('dashboard') }}" class="hero-btn hero-btn--primary">
                        Ir al panel
                    </a>

                @else

                    <a href="{{ route('register') }}" class="hero-btn hero-btn--primary">
                        Inscripción
                    </a>

                    <a href="#contacto" class="hero-btn hero-btn--outline">
                        Contacto
                    </a>

                @endauth

            </div>

        </div>

    </section>



    {{-- TALLERES --}}
    <section class="section">

        <h2 class="section-title">Nuestros Talleres</h2>

        <p class="section-description">
            En el CAM San Pedro ofrecemos talleres orientados al desarrollo
            de habilidades laborales y autonomía personal.
        </p>

        <div class="cards-grid">

            <div class="card">

                <h3>🍞 Cocina y Panadería</h3>

                <p>
                    Preparación de alimentos, higiene en cocina y elaboración
                    de productos que pueden venderse al público.
                </p>

            </div>

            <div class="card">

                <h3>🪵 Carpintería</h3>

                <p>
                    Uso de herramientas, creación de muebles y desarrollo
                    de habilidades manuales para el trabajo.
                </p>

            </div>

            <div class="card">

                <h3>🌱 Jardinería</h3>

                <p>
                    Cuidado de plantas, mantenimiento de áreas verdes
                    y conocimiento básico de horticultura.
                </p>

            </div>

            <div class="card">

                <h3>🎨 Manualidades</h3>

                <p>
                    Desarrollo creativo y elaboración de productos
                    artesanales que pueden comercializarse.
                </p>

            </div>

        </div>

    </section>



    {{-- PROCESO DE INSCRIPCIÓN --}}
    <section class="section bg-soft">

        <h2 class="section-title">Proceso de inscripción</h2>

        <div class="steps">

            <div class="step">
                <span class="step-number">1</span>
                <p>Presentar documentos básicos del estudiante.</p>
            </div>

            <div class="step">
                <span class="step-number">2</span>
                <p>Entrevista con el equipo psicopedagógico.</p>
            </div>

            <div class="step">
                <span class="step-number">3</span>
                <p>Asignación de taller según habilidades e intereses.</p>
            </div>

        </div>

    </section>



    {{-- ACERCA --}}
    <section class="section">

        <h2 class="section-title">Acerca del CAM</h2>

        <div class="about-grid">

            <div class="about-card">

                <h4>Misión</h4>

                <p>
                    Brindar educación inclusiva que permita a los estudiantes
                    desarrollar habilidades laborales y sociales.
                </p>

            </div>

            <div class="about-card">

                <h4>Visión</h4>

                <p>
                    Ser una institución referente en formación laboral
                    para personas con discapacidad.
                </p>

            </div>

            <div class="about-card">

                <h4>Valores</h4>

                <p>
                    Inclusión, respeto, compromiso, responsabilidad
                    y desarrollo personal.
                </p>

            </div>

        </div>

    </section>



    {{-- CONTACTO --}}
    <section id="contacto" class="section bg-soft">

        <h2 class="section-title">Contacto</h2>

        <div class="contact-grid">

            <div class="contact-card">

                <h4>📍 Dirección</h4>

                <p>
                    CAM Laboral San Pedro <br>
                    San Pedro Garza García, Nuevo León
                </p>

            </div>

            <div class="contact-card">

                <h4>📞 Teléfono</h4>

                <p>+52 81 1234 5678</p>

            </div>

            <div class="contact-card">

                <h4>🌐 Redes sociales</h4>

                <p>
                    <a href="https://www.facebook.com/camlaboralsanpedro" target="_blank">
                        Facebook CAM San Pedro
                    </a>
                </p>

            </div>

        </div>

    </section>

@endsection