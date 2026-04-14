@extends('layouts.app')

@section('title', 'CAM San Pedro')

@section('content')

    {{-- HERO --}}
    <section class="hero" id="Inicio">
        <div class="hero-overlay"></div>

        <div class="hero-content container">
            <span class="hero-badge">Educación Especial Pública</span>

            <h1 class="hero-title">
                Centro de Atención Múltiple <br> CAM San Pedro
            </h1>

            <p class="hero-subtitle">
                Formación integral para jóvenes con necesidades educativas especiales,
                desarrollando habilidades para la vida, el trabajo y la autonomía.
            </p>

            <div class="hero-ctas">
                <a href="{{ route('proceso') }}" class="btn-primary">Inscribirse</a>
                <a href="{{ route('talleres') }}" class="btn-secondary">Ver Talleres</a>
            </div>
        </div>
    </section>

    {{-- INTRO INSTITUCIONAL --}}
    <section class="section container intro" id="Definicion">

        <h2 class="section-title">¿Qué es el CAM San Pedro?</h2>

        <p class="intro-text">
            El CAM San Pedro es una institución pública de educación especial enfocada en brindar
            atención a jóvenes con necesidades educativas específicas, promoviendo su desarrollo
            personal, social y laboral mediante programas adaptados.
        </p>

        <p class="intro-text">
            A través de talleres de capacitación laboral y acompañamiento psicopedagógico,
            se busca que los estudiantes desarrollen habilidades que les permitan integrarse
            de manera activa en la sociedad y el entorno productivo.
        </p>

        <div class="split-img">
            <img src="/Imagenes/inclusion.jpg">
            <img src="/Imagenes/CAM QueEs.jpg" alt="Intro CAM"
                style="border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        </div>


    </section>

    {{-- POR QUÉ ELEGIR --}}
    <section id="Porque" class="section container">

        <h2 class="section-title">¿Por qué elegir el CAM San Pedro?</h2>

        <div class="split">

            {{-- Columna de Imágenes del Tríptico --}}
            <div class="split-img" style="display: flex; flex-direction: column; gap: 15px;">
                <img src="/Imagenes/CAM Info Triptico1.jpg" alt="Información CAM Parte 1"
                    style="border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <img src="/Imagenes/CAM Info Triptico2.jpg" alt="Información CAM Parte 2"
                    style="border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            </div>

            <div class="split-text">

                <h3>Formación integral para la vida independiente</h3>

                <p>
                    Nuestro centro se destaca por ser una institución equipada con talleres de capacitación laboral, donde
                    preparamos a jóvenes con discapacidad mediante el desarrollo de habilidades personales, sociales y
                    laborales.
                </p>

                <ul class="benefits">
                    <li>✔ <strong>Prácticas Laborales:</strong> Vinculación directa con pequeñas y medianas empresas.</li>
                    <li>✔ <strong>Competencias Técnicas:</strong> Formación basada en normas técnicas de competencia
                        laboral.</li>
                    <li>✔ <strong>Equipo Multidisciplinario:</strong> Contamos con psicólogos, trabajadores sociales y
                        maestros de apoyo.</li>
                    <li>✔ <strong>Enfoque en Autonomía:</strong> Programas diseñados para una integración social y laboral
                        exitosa.</li>
                </ul>

                {{-- Sección de Impacto integrada --}}
                <div class="impact-highlights"
                    style="display: grid; grid-template-columns: 1 white; gap: 10px; margin-top: 20px;">
                    <div style="background: #eef7ee; padding: 10px; border-radius: 5px; text-align: center;">
                        <span style="display: block; font-size: 1.5rem; font-weight: bold; color: #28a745;">+30 Años</span>
                        <small>Trayectoria educativa</small>
                    </div>
                    <div style="background: #eef2f7; padding: 10px; border-radius: 5px; text-align: center;">
                        <span style="display: block; font-size: 1.5rem; font-weight: bold; color: #007bff;">5
                            Talleres</span>
                        <small>Especialidades laborales</small>
                    </div>
                </div>

                <div class="entry-rules"
                    style="margin-top: 20px; padding: 15px; background: #f9f9f9; border-left: 4px solid #28a745;">
                    <h4 style="margin-bottom: 10px;">Normas de Ingreso:</h4>
                    <ul style="list-style: none; padding: 0; font-size: 0.9rem;">
                        <li><strong>Edad:</strong> 15 a 22 años.</li>
                        <li><strong>Turnos:</strong> Matutino, Vespertino y Discontinuo.</li>
                        <li><strong>Permanencia:</strong> 4 años.</li>
                    </ul>
                </div>

            </div>

        </div>

    </section>

    {{-- ACERCA DEL CAM --}}
    <section class="section container" id="Acerca">
        <h2 class="section-title">Acerca del CAM San Pedro</h2>

        <div class="about-vertical-content">

            {{-- 1. MODELO EDUCATIVO (Título arriba, contenido abajo) --}}
            <div class="modelo-vertical">
                <div class="modelo-items">
                    <div class="card-inline">
                        <h3>🎯 Desarrollo de Habilidades</h3>
                        <p>Enfoque en el crecimiento de habilidades duras y servicios de psicología para el apoyo integral
                            del alumno[cite: 95].</p>
                    </div>

                    <div class="card-inline">
                        <h3>🛠️ Talleres Laborales</h3>
                        <p>Capacitación práctica en mantenimiento, cocina, jardinería, manualidades y carpintería[cite: 95,
                            103].</p>
                    </div>

                    <div class="card-inline">
                        <h3>🤝 Atención Especializada</h3>
                        <p>Acompañamiento de maestras de apoyo y entrevistas psicopedagógicas personalizadas para brindar
                            soporte constante[cite: 96, 113].</p>
                    </div>
                </div>
            </div>

            {{-- 2. MISIÓN, VISIÓN Y VALORES (Efecto ZigZag) --}}
            <div class="about-zigzag">

                {{-- MISIÓN: Imagen Izquierda - Texto Derecha --}}
                <div class="about-row">
                    <div class="about-img">
                        <img src="/Imagenes/CAM Mision.jpg" alt="Misión">
                    </div>
                    <div class="about-block verde">
                        <h4>Misión</h4>
                        <p>Conectar ONG's y centros de apoyo con contribuyentes y voluntarios a través de un Marketplace de
                            Bienestar Social[cite: 105].</p>
                    </div>
                </div>

                {{-- VISIÓN: Texto Izquierda - Imagen Derecha --}}
                <div class="about-row">
                    <div class="about-img">
                        <img src="/Imagenes/CAM Vision.jpg" alt="Visión">
                    </div>
                    <div class="about-block azul">
                        <h4>Visión</h4>
                        <p>Brindar visibilidad a las actividades y proyectos mediante la promoción en distintos medios para
                            atraer participación y apoyo social[cite: 107].</p>
                    </div>
                </div>

                {{-- VALORES: Imagen Izquierda - Texto Derecha --}}
                <div class="about-row">
                    <div class="about-img">
                        <img src="/Imagenes/CAM Valores.jpg" alt="Valores">
                    </div>
                    <div class="about-block amarillo">
                        <h4>Valores</h4>
                        <p>Nuestra labor se rige por la Responsabilidad, Tolerancia, Compromiso, Altruismo, Diligencia y
                            Empatía[cite: 109].</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- SINOPSIS DE TALLERES --}}
    <section class="section container" id="Talleres-preview">
        <div class="split">
            <div class="split-text">
                <span class="hero-badge" style="background: #eef7ee; color: var(--verde);">Capacitación Laboral</span>
                <h2 class="section-title-left">Formación en Oficios</h2>
                <p>
                    Preparamos a los estudiantes en áreas productivas como <strong>Cocina, Carpintería, Jardinería,
                        Mantenimiento y Manualidades.</strong>
                </p>
                <p>
                    Nuestro enfoque es desarrollar habilidades duras que faciliten su integración al mundo del trabajo.
                </p>
                <a href="{{ route('talleres') }}" class="btn-primary" style="display: inline-block; margin-top: 20px;">Ver
                    todos los talleres</a>
            </div>
            <div class="split-img">
                <img src="/Imagenes/CAM Talleres.jpg" alt="Talleres CAM">
            </div>
        </div>
    </section>

    {{-- SINOPSIS DE EVENTOS --}}
    <section class="section container" id="Eventos-preview">
        <div class="split">
            {{-- Columna de Imágenes (Efecto Collage) --}}
            <div class="split-img" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                <img src="/Imagenes/CAM Evento3A.jpg" alt="Evento Social"
                    style="border-radius: 12px; height: 150px; object-cover: cover;">
                <img src="/Imagenes/CAM Evento4A.jpg" alt="Actividad Educativa"
                    style="border-radius: 12px; height: 150px; object-cover: cover; margin-top: 20px;">
                <img src="/Imagenes/CAM Evento5A.jpg" alt="Taller Práctico"
                    style="border-radius: 12px; height: 150px; object-cover: cover; grid-column: span 2;">
            </div>

            <div class="split-text">
                <span class="hero-badge" style="background: #fdf2f2; color: #dc3545;">Vida Estudiantil</span>
                <h2 class="section-title-left">Momentos que Inspiran</h2>

                <p>
                    Más allá de los talleres, en el <strong>CAM San Pedro</strong> creamos espacios de convivencia donde la
                    inclusión se vive en cada detalle. Desde festivales culturales hasta jornadas de vinculación
                    comunitaria.
                </p>

                <div class="event-features" style="margin: 20px 0;">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                        <i class="fas fa-camera-retro" style="color: var(--azul);"></i>
                        <span class="text-sm">Galería actualizada de actividades y logros.</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                        <i class="fas fa-external-link-alt" style="color: var(--verde);"></i>
                        <span class="text-sm">Conexión directa con nuestros álbumes de Facebook.</span>
                    </div>
                </div>

                <p class="text-slate-600" style="font-size: 0.9rem; font-style: italic;">
                    "Cada fotografía cuenta una historia de superación y alegría de nuestros alumnos."
                </p>

                <a href="{{ route('eventos') }}" class="btn-primary"
                    style="display: inline-block; margin-top: 25px; background: var(--azul-oscuro);">
                    Explorar Eventos
                </a>
            </div>
        </div>
    </section>

    {{-- SINOPSIS DEL PROCESO --}}
    <section class="section bg-soft" id="Proceso">
        <div class="container" style="text-align: center;">
            <h2 class="section-title">Inscripción en 3 pasos</h2>
            <div class="split-img">
                <img src="/Imagenes/CAM Registro.jpg" alt="Registro CAM">
            </div>
            <div class="steps-compact" style="display: flex; justify-content: center; gap: 40px; margin-bottom: 30px;">
                <div class="step-mini">
                    <strong style="color: var(--verde); font-size: 1.5rem;">01</strong>
                    <p>Entrega de Documentos</p>
                </div>
                <div class="step-mini">
                    <strong style="color: var(--verde); font-size: 1.5rem;">02</strong>
                    <p>Evaluación Psicopedagógica</p>
                </div>
                <div class="step-mini">
                    <strong style="color: var(--verde); font-size: 1.5rem;">03</strong>
                    <p>Asignación de Taller</p>
                </div>
            </div>
            <a href="{{ route('proceso') }}" class="btn-secondary"
                style="color: var(--azul-oscuro); border-color: var(--azul-oscuro);">Ver requisitos y detalles</a>
        </div>
    </section>

@endsection