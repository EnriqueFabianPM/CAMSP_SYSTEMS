@extends('layouts.app')

@section('title', 'Proceso de Inscripción')

@section('content')

    {{-- PASOS --}}
    <section class="section bg-soft">

        <h2 class="section-title">Proceso de inscripción</h2>

        <p class="intro-text">
            El proceso de ingreso al CAM San Pedro está diseñado para conocer las necesidades
            de cada estudiante y brindarle la mejor atención educativa posible.
        </p>

        <div class="container">

            <div class="steps">

                <div class="step">
                    <span class="step-number">1</span>
                    <h4>Solicitud e información</h4>
                    <p>
                        Los padres o tutores solicitan información sobre el ingreso
                        y presentan los documentos básicos del estudiante.
                    </p>
                </div>

                <div class="step">
                    <span class="step-number">2</span>
                    <h4>Evaluación</h4>
                    <p>
                        Se realiza una evaluación psicopedagógica para conocer
                        habilidades, necesidades y áreas de oportunidad.
                    </p>
                </div>

                <div class="step">
                    <span class="step-number">3</span>
                    <h4>Asignación</h4>
                    <p>
                        Se asigna al estudiante el taller o programa más adecuado
                        según su perfil.
                    </p>
                </div>

                <div class="step">
                    <span class="step-number">4</span>
                    <h4>Integración</h4>
                    <p>
                        El estudiante se integra a las actividades educativas
                        y comienza su formación en el CAM.
                    </p>
                </div>

            </div>

        </div>

    </section>

    {{-- REQUISITOS --}}
    <section class="section bg-soft">

        <h2 class="section-title">Requisitos generales</h2>

        <p class="intro-text">
            Para el proceso de inscripción en el CAM San Pedro, es necesario presentar la siguiente documentación
            básica. Estos documentos permiten realizar el registro adecuado del estudiante y brindarle la atención
            necesaria acorde a sus necesidades.
        </p>

        <ul class="requisitos">
            <li>✔ Acta de nacimiento (original y copia)</li>
            <li>✔ CURP del estudiante</li>
            <li>✔ Comprobante de domicilio reciente</li>
            <li>✔ Documentación médica o diagnóstica (en caso de contar con alguna condición)</li>
            <li>✔ Identificación oficial del tutor o padre de familia</li>
        </ul>

        <p class="intro-text">
            El proceso de inscripción y asignación de talleres puede variar dependiendo de las necesidades
            del estudiante, la disponibilidad de cupo y la evaluación realizada por el equipo del CAM.
            Se recomienda acudir directamente al plantel para recibir orientación personalizada y resolver
            cualquier duda.

            En algunos casos, también se podrá solicitar información adicional como historial académico,
            entrevistas iniciales o evaluaciones por parte del personal especializado del centro.
        </p>

        {{-- UBICACIÓN + MAPA --}}
        <div class="ubicacion-box">

            <h3 class="section-title">📍 Ubicación del CAM San Pedro</h3>

            <p class="intro-text">
                Puedes acudir directamente en horario escolar para solicitar informes, conocer las instalaciones
                y recibir atención por parte del personal administrativo.
            </p>

            {{-- MAPA EMBEBIDO --}}
            <div class="flex justify-center"> {{-- Este div centra el bloque completo --}}
                <div class="mapa-container shadow-xl rounded-3xl overflow-hidden border-4 border-white" style="width: 75%;">
                    <iframe
                        src="https://www.google.com/maps?q=Av+Vasconcelos+y+Lic+Verdad,+San+Pedro+Garza+García&output=embed"
                        width="100%" height="450" style="border:0; display: block;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>

    </section>

@endsection