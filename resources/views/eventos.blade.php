@extends('layouts.app')

@section('title', 'Eventos Escolares')

@section('content')

    {{-- INTRO --}}
    <section class="section container mb-12">
        <div class="text-center max-w-4xl mx-auto">
            <h2 class="section-title text-5xl font-black text-slate-800 uppercase tracking-tighter mb-4">
                Nuestras Memorias y Eventos
            </h2>
            <p class="intro-text text-slate-600 text-lg leading-relaxed">
                En el CAM San Pedro, cada evento es una oportunidad para derribar barreras.
                Nuestras actividades están diseñadas para potenciar la autonomía, celebrar la diversidad
                y crear lazos sólidos entre estudiantes, familias y la comunidad de Nuevo León.
            </p>
        </div>

        {{-- BLOQUES DE PROPÓSITO --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">
            <div class="info-card blue">
                <i class="fas fa-hands-helping"></i>
                <div>
                    <h4>Inclusión Real</h4>
                    <p>Participación sin etiquetas, respetando capacidades individuales.</p>
                </div>
            </div>
            <div class="info-card green">
                <i class="fas fa-graduation-cap"></i>
                <div>
                    <h4>Aprendizaje Vivencial</h4>
                    <p>Experiencias fuera del aula con impacto real.</p>
                </div>
            </div>
            <div class="info-card purple">
                <i class="fas fa-users"></i>
                <div>
                    <h4>Vínculo Familiar</h4>
                    <p>Padres involucrados en el crecimiento de sus hijos.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- SECCIÓN DE EVENTOS (Un evento por fila) --}}
    <section class="section container space-y-12">

        @php
            $eventos = [
                [
                    "titulo" => "🎉 Actividad Final de Informática",
                    "fecha" => "26 de marzo 2025",
                    "descripcion" => "Elaboración de puestos de comida para actividad final.",
                    "link" => "https://www.facebook.com/camlaboralsanpedro"
                ],
                [
                    "titulo" => "🎓 Asamblea de Marzo",
                    "fecha" => "24 de marzo 2025",
                    "descripcion" => "Asamblea para la celebración de efemérides de marzo.",
                    "link" => "https://www.facebook.com/media/set?vanity=camlaboralsanpedro&set=a.4528365904044568"
                ],
                [
                    "titulo" => "🎓 Asamblea de Febrero",
                    "fecha" => "27 de febrero 2025",
                    "descripcion" => "Asamblea para la celebración de efemérides de febrero.",
                    "link" => "https://www.facebook.com/media/set/?vanity=camlaboralsanpedro&set=a.4499212796959879"
                ],
                [
                    "titulo" => "🎉 Red de Padres",
                    "fecha" => "Diciembre 2025",
                    "descripcion" => "Evento de convivencia familiar.",
                    "link" => "https://www.facebook.com/media/set/?vanity=camlaboralsanpedro&set=a.4470606916487134"
                ],
                [
                    "titulo" => "🌱 Huerto Escolar",
                    "fecha" => "Noviembre 2025",
                    "descripcion" => "Actividad de siembra y cuidado ambiental.",
                    "link" => "https://facebook.com/CAMSanPedro/albums/ejemplo2"
                ],
                [
                    "titulo" => "🎓 Graduación",
                    "fecha" => "Diciembre 2025",
                    "descripcion" => "Entrega de reconocimientos.",
                    "link" => "https://facebook.com/CAMSanPedro/albums/ejemplo3"
                ],
                [
                    "titulo" => "🎭 Actividad Cultural",
                    "fecha" => "Evento",
                    "descripcion" => "Presentaciones artísticas.",
                    "link" => "#"
                ],
                [
                    "titulo" => "🎶 Música",
                    "fecha" => "Evento",
                    "descripcion" => "Actividad recreativa musical.",
                    "link" => "#"
                ],
                [
                    "titulo" => "📚 Académico",
                    "fecha" => "Evento",
                    "descripcion" => "Actividades educativas.",
                    "link" => "#"
                ],
                [
                    "titulo" => "🏆 Logros",
                    "fecha" => "Evento",
                    "descripcion" => "Reconocimiento a estudiantes.",
                    "link" => "#"
                ],
            ];
        @endphp

        @foreach ($eventos as $i => $evento)
            @php
                $ext = ($i == 0) ? 'jpeg' : 'jpg';
            @endphp

            <div class="evento-card-full">
                <div class="p-8">

                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                        <h3 class="evento-title-big">
                            {{ $evento['titulo'] }}
                        </h3>
                        <span class="evento-badge-large">
                            <i class="fas fa-calendar-alt mr-2"></i> {{ $evento['fecha'] }}
                        </span>
                    </div>

                    <p class="evento-text-large mb-8">
                        {{ $evento['descripcion'] }}
                    </p>

                    <div class="evento-galeria-grande">
                        <img src="{{ asset('Imagenes/CAM Evento' . $i . 'A.' . $ext) }}">
                        <img src="{{ asset('Imagenes/CAM Evento' . $i . 'B.' . $ext) }}">
                        <img src="{{ asset('Imagenes/CAM Evento' . $i . 'C.' . $ext) }}">
                        <img src="{{ asset('Imagenes/CAM Evento' . $i . 'D.' . $ext) }}">
                    </div>

                    <div class="mt-8 flex justify-end">
                        <a href="{{ $evento['link'] }}" target="_blank" class="evento-btn-wide">
                            <i class="fab fa-facebook mr-2"></i> VER ÁLBUM COMPLETO
                        </a>
                    </div>

                </div>
            </div>
        @endforeach

    </section>

    {{-- ESTILOS ACTUALIZADOS --}}
    <style>
        /* INFO CARDS (Iguales) */
        .info-card {
            display: flex;
            gap: 15px;
            padding: 20px;
            border-radius: 16px;
            align-items: center;
            font-size: 13px;
        }

        .info-card i {
            padding: 12px;
            border-radius: 10px;
            color: white;
        }

        .info-card h4 {
            font-weight: 800;
            font-size: 12px;
            text-transform: uppercase;
        }

        .info-card.blue {
            background: #eff6ff;
        }

        .info-card.blue i {
            background: #2563eb;
        }

        .info-card.green {
            background: #ecfdf5;
        }

        .info-card.green i {
            background: #059669;
        }

        .info-card.purple {
            background: #f5f3ff;
        }

        .info-card.purple i {
            background: #7c3aed;
        }

        /* EVENTOS FULL WIDTH */
        .evento-card-full {
            background: white;
            border-radius: 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
            border-left: 10px solid;
            /* Cambié el borde al lado para que luzca mejor en filas largas */
            transition: 0.4s;
            overflow: hidden;
        }

        .evento-card-full:hover {
            transform: scale(1.01);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
        }

        .evento-title-big {
            font-weight: 900;
            font-size: 24px;
            color: #1e293b;
            letter-spacing: -0.05em;
        }

        .evento-text-large {
            font-size: 16px;
            color: #64748b;
            line-height: 1.6;
        }

        /* GALERÍA GRANDE */
        .evento-galeria-grande {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            /* 1 foto por fila en móvil */
            gap: 15px;
        }

        @media (min-width: 768px) {
            .evento-galeria-grande {
                grid-template-columns: repeat(4, 1fr);
                /* 4 fotos en fila en PC */
            }
        }

        .evento-galeria-grande img {
            width: 100%;
            height: 250px;
            /* AQUÍ AJUSTAS EL TAMAÑO DE LAS IMÁGENES */
            object-fit: cover;
            border-radius: 20px;
            transition: 0.5s;
            cursor: pointer;
        }

        .evento-galeria-grande img:hover {
            transform: scale(1.03);
            filter: brightness(1.1);
        }

        /* BADGE Y BOTÓN */
        .evento-badge-large {
            font-size: 12px;
            font-weight: 800;
            padding: 8px 16px;
            border-radius: 12px;
            text-transform: uppercase;
        }

        .evento-btn-wide {
            display: inline-block;
            padding: 14px 30px;
            background: #1e293b;
            color: white;
            border-radius: 15px;
            font-weight: 800;
            font-size: 13px;
            transition: 0.3s;
        }

        .evento-btn-wide:hover {
            background: #2563eb;
            padding-right: 40px;
        }

        /* COLORES DINÁMICOS POR FILA */
        .evento-card-full:nth-child(4n+1) {
            border-color: #2563eb;
        }

        .evento-card-full:nth-child(4n+1) .evento-badge-large {
            background: #dbeafe;
            color: #2563eb;
        }

        .evento-card-full:nth-child(4n+2) {
            border-color: #059669;
        }

        .evento-card-full:nth-child(4n+2) .evento-badge-large {
            background: #d1fae5;
            color: #059669;
        }

        .evento-card-full:nth-child(4n+3) {
            border-color: #d97706;
        }

        .evento-card-full:nth-child(4n+3) .evento-badge-large {
            background: #fef3c7;
            color: #d97706;
        }

        .evento-card-full:nth-child(4n+4) {
            border-color: #7c3aed;
        }

        .evento-card-full:nth-child(4n+4) .evento-badge-large {
            background: #ede9fe;
            color: #7c3aed;
        }
    </style>

@endsection