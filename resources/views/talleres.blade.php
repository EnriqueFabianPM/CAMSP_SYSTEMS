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
            <img src="/images/carpinteria.jpg">
            <div class="taller-box madera">
                <h3>🪵 Carpintería</h3>
                <p>
                    Desarrollo de habilidades manuales mediante la elaboración de muebles
                    y objetos de madera. Los estudiantes aprenden el uso de herramientas,
                    medidas de seguridad y procesos de producción.
                </p>
                <ul>
                    <li>✔ Uso de herramientas básicas</li>
                    <li>✔ Trabajo en equipo</li>
                    <li>✔ Producción de objetos útiles</li>
                </ul>
            </div>
        </div>

        {{-- JARDINERÍA --}}
        <div class="taller-row reverse">
            <img src="/images/jardineria.jpg">
            <div class="taller-box verde">
                <h3>🌱 Jardinería</h3>
                <p>
                    Enfocado en el cuidado del medio ambiente, este taller desarrolla habilidades
                    relacionadas con el mantenimiento de áreas verdes, siembra y cuidado de plantas.
                </p>
                <ul>
                    <li>✔ Cuidado de plantas</li>
                    <li>✔ Trabajo al aire libre</li>
                    <li>✔ Responsabilidad ambiental</li>
                </ul>
            </div>
        </div>

        {{-- MANTENIMIENTO --}}
        <div class="taller-row">
            <img src="/images/mantenimiento.jpg">
            <div class="taller-box azul">
                <h3>🔧 Mantenimiento</h3>
                <p>
                    Los estudiantes aprenden tareas básicas de reparación, mantenimiento
                    y uso de herramientas para resolver problemas cotidianos.
                </p>
                <ul>
                    <li>✔ Electricidad básica</li>
                    <li>✔ Reparaciones sencillas</li>
                    <li>✔ Solución de problemas</li>
                </ul>
            </div>
        </div>

        {{-- COCINA --}}
        <div class="taller-row reverse">
            <img src="/images/cocina.jpg">
            <div class="taller-box rojo">
                <h3>🍞 Cocina</h3>
                <p>
                    Desarrollo de habilidades culinarias enfocadas en la preparación de alimentos,
                    higiene y posibles actividades productivas.
                </p>
                <ul>
                    <li>✔ Preparación de alimentos</li>
                    <li>✔ Higiene y seguridad</li>
                    <li>✔ Producción para venta</li>
                </ul>
            </div>
        </div>

        {{-- MANUALIDADES --}}
        <div class="taller-row">
            <img src="/images/manualidades.jpg">
            <div class="taller-box violeta">
                <h3>🎨 Manualidades</h3>
                <p>
                    Fomenta la creatividad mediante la elaboración de productos artesanales,
                    desarrollando habilidades motrices finas y expresión artística.
                </p>
                <ul>
                    <li>✔ Creatividad</li>
                    <li>✔ Motricidad fina</li>
                    <li>✔ Elaboración de productos</li>
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