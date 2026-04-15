@extends('layouts.app')

@section('title', 'Talleres')

@section('content')

    {{-- INTRO --}}
    <section class="section container">

        <h2 class="section-title">Talleres de Capacitación Laboral</h2>

        <p class="intro-text">
            En el CAM San Pedro, los talleres representan una parte fundamental del proceso educativo.
            Están diseñados para desarrollar habilidades prácticas que permitan a los estudiantes
            integrarse al entorno laboral y social de manera autónoma.
        </p>

        <p class="intro-text">
            Cada taller está adaptado a las capacidades y necesidades de los alumnos, fomentando
            el aprendizaje mediante la práctica, el trabajo en equipo y la responsabilidad.
        </p>

    </section>

    {{-- TALLERES --}}
    <section class="section container">

        {{-- CARPINTERÍA --}}
        <div class="taller-row">
            <img src="/Imagenes/CAM Carpinteria.jpg">
            <div class="taller-box madera">
                <h3>🪵 Carpintería y Ebanistería Básica</h3>
                <p>
                    Este taller potencia la precisión y el control motor. Los estudiantes transforman la materia prima en
                    piezas funcionales, desarrollando procesos lógicos que van desde el diseño y lijado hasta el ensamble
                    final de mobiliario.
                </p>
                <ul>
                    <li>✔ Manejo seguro de herramientas manuales y eléctricas</li>
                    <li>✔ Interpretación de medidas y trazos técnicos</li>
                    <li>✔ Acabados, barnizado y restauración de muebles</li>
                    <li>✔ Disciplina operativa y organización del taller</li>
                </ul>
            </div>
        </div>

        {{-- JARDINERÍA --}}
        <div class="taller-row reverse">
            <img src="/Imagenes/CAM Jardineria.jpg">
            <div class="taller-box verde">
                <h3>🌱 Jardinería y Cultivo Sustentable</h3>
                <p>
                    Un espacio terapéutico y productivo donde se enseña el ciclo de vida de las plantas. Los alumnos
                    aprenden sobre botánica aplicada, producción de hortalizas y mantenimiento estético de espacios verdes.
                </p>
                <ul>
                    <li>✔ Técnicas de siembra, riego y fertilización orgánica</li>
                    <li>✔ Creación de huertos escolares y composta</li>
                    <li>✔ Uso correcto de herramientas de labranza</li>
                    <li>✔ Conciencia ecológica y cuidado del medio ambiente</li>
                </ul>
            </div>
        </div>

        {{-- MANTENIMIENTO --}}
        <div class="taller-row">
            <img src="/Imagenes/CAM Mantenimiento.jpg">
            <div class="taller-box azul">
                <h3>🔧 Mantenimiento de Edificios</h3>
                <p>
                    Capacita a los estudiantes para identificar y resolver necesidades técnicas básicas. Se enfoca en la
                    resolución de problemas prácticos que fomentan la independencia en el hogar y en entornos laborales.
                </p>
                <ul>
                    <li>✔ Introducción a la electricidad y plomería básica</li>
                    <li>✔ Resane de muros y aplicación de pintura</li>
                    <li>✔ Reparación de desperfectos cotidianos</li>
                    <li>✔ Protocolos de seguridad industrial personal</li>
                </ul>
            </div>
        </div>

        {{-- COCINA --}}
        <div class="taller-row reverse">
            <img src="/Imagenes/CAM Cocina.jpg">
            <div class="taller-box rojo">
                <h3>🍞 Cocina y Repostería Funcional</h3>
                <p>
                    Formación enfocada en la autonomía alimentaria y el emprendimiento. Se trabajan estándares de calidad
                    comercial, permitiendo a los alumnos integrarse a servicios de alimentación o iniciar proyectos de venta
                    propios.
                </p>
                <ul>
                    <li>✔ Manejo higiénico de alimentos (Distintivo H)</li>
                    <li>✔ Preparación de recetas, panadería y repostería</li>
                    <li>✔ Control de inventarios y costeo básico de productos</li>
                    <li>✔ Servicio al cliente y etiqueta de mesa</li>
                </ul>
            </div>
        </div>

        {{-- MANUALIDADES --}}
        <div class="taller-row">
            <img src="/Imagenes/CAM Manualidades.jpg">
            <div class="taller-box violeta">
                <h3>🎨 Artes Visuales y Producción Artesanal</h3>
                <p>
                    Un taller diseñado para canalizar la expresión artística en productos comercializables. Se enfoca en la
                    motricidad fina y la atención al detalle, creando artículos únicos con valor estético y comercial.
                </p>
                <ul>
                    <li>✔ Técnicas de pintura, modelado y ensamble</li>
                    <li>✔ Reciclaje creativo y transformación de materiales</li>
                    <li>✔ Diseño de empaques y presentación de productos</li>
                    <li>✔ Desarrollo de la paciencia y concentración sostenida</li>
                </ul>
            </div>
        </div>

    </section>

    {{-- CIERRE --}}
    <section class="section bg-soft">

        <div class="container">

            <h2 class="section-title">Formación para la vida</h2>

            <p class="intro-text">
                Los talleres del CAM no solo enseñan un oficio, sino que están diseñados para desarrollar habilidades
                prácticas que permitan a los estudiantes desenvolverse de manera independiente en su vida diaria.
            </p>

            <p class="intro-text">
                A través de actividades como cocina, jardinería, mantenimiento, carpintería y manualidades, los alumnos
                fortalecen
                su coordinación, responsabilidad y trabajo en equipo, preparándose para futuras oportunidades
                laborales o sociales.
            </p>

            <p class="intro-text">
                Además, el acompañamiento de docentes y personal especializado fomenta la autoestima, la inclusión
                y el desarrollo integral de cada estudiante, respetando sus capacidades y ritmo de aprendizaje.
            </p>

            <p class="intro-text">
                El objetivo final es brindar herramientas reales para la vida, promoviendo la autonomía,
                la integración social y una mejor calidad de vida.
            </p>

        </div>

    </section>

@endsection