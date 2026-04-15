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
                Nuestras actividades están diseñadas para potenciar la autonomía y crear lazos sólidos.
            </p>
        </div>

        {{-- BLOQUES DE PROPÓSITO --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">
            <div class="info-card blue">
                <i class="fas fa-hands-helping"></i>
                <div>
                    <h4>Inclusión Real</h4>
                    <p>Participación sin etiquetas.</p>
                </div>
            </div>
            <div class="info-card green">
                <i class="fas fa-graduation-cap"></i>
                <div>
                    <h4>Aprendizaje Vivencial</h4>
                    <p>Experiencias con impacto real.</p>
                </div>
            </div>
            <div class="info-card purple">
                <i class="fas fa-users"></i>
                <div>
                    <h4>Vínculo Familiar</h4>
                    <p>Padres involucrados.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CONTENEDOR DE EVENTOS EN UNA SOLA FILA (ANCHO COMPLETO) --}}
    <section class="container pb-20">
        <div class="flex flex-col gap-16"> {{-- Cambiado a Flex Column para una sola fila por evento --}}

            @forelse ($eventos as $evento)
                <div class="evento-card-horizontal">

                    {{-- PARTE SUPERIOR: SLIDER --}}
                    <div class="evento-img-container" id="slider-{{ $evento->id }}">
                        <div class="slider-wrapper">
                            @if($evento->imagenes && count($evento->imagenes))
                                @foreach($evento->imagenes as $index => $img)
                                    <div class="slide {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset($img) }}" alt="{{ $evento->titulo }}" class="main-img"
                                            onclick="openModal('{{ asset($img) }}')">
                                    </div>
                                @endforeach

                                @if(count($evento->imagenes) > 1)
                                    <button class="slider-arrow prev"
                                        onclick="moveSlide('slider-{{ $evento->id }}', -1)">&#10094;</button>
                                    <button class="slider-arrow next"
                                        onclick="moveSlide('slider-{{ $evento->id }}', 1)">&#10095;</button>
                                @endif
                            @else
                                <img src="{{ asset('Imagenes/default.jpg') }}" class="main-img">
                            @endif
                        </div>

                        <span class="evento-badge-float">
                            {{ $evento->fecha ? $evento->fecha->format('d/m/Y') : 'Sin fecha' }}
                        </span>
                    </div>

                    {{-- PARTE INFERIOR: MINIATURAS Y TEXTO --}}
                    <div class="p-8">
                        <div class="flex flex-col md:flex-row gap-8">

                            {{-- MINIATURAS (Debajo de la imagen principal) --}}
                            <div class="w-full md:w-1/3">
                                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Galería del evento
                                </h4>
                                <div class="grid grid-cols-4 gap-2">
                                    @if($evento->imagenes && count($evento->imagenes))
                                        @foreach($evento->imagenes as $img)
                                            <img src="{{ asset($img) }}"
                                                class="h-20 w-full object-cover rounded-xl cursor-pointer hover:opacity-75 transition"
                                                onclick="openModal('{{ asset($img) }}')">
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            {{-- CONTENIDO DE TEXTO --}}
                            <div class="w-full md:w-2/3 flex flex-col justify-between">
                                <div>
                                    <h3 class="evento-title-grid">{{ $evento->titulo }}</h3>
                                    <p class="evento-text-grid">
                                        {{ $evento->descripcion ?? 'Sin descripción disponible.' }}
                                    </p>
                                </div>

                                <div class="mt-8 flex justify-between items-center border-t pt-6">
                                    @if($evento->link)
                                        <a href="{{ $evento->link }}" target="_blank" class="btn-fb-style">
                                            <i class="fab fa-facebook mr-2"></i> ÁLBUM COMPLETO EN FACEBOOK
                                        </a>
                                    @endif
                                    <span class="text-xs font-bold text-slate-400 tracking-widest uppercase">CAM SAN
                                        PEDRO</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-slate-400 py-20">
                    No hay eventos disponibles
                </div>
            @endforelse

        </div>
    </section>

    {{-- MODAL LIGHTBOX --}}
    <div id="imageModal" class="lightbox-modal" onclick="closeModal()">
        <span class="lightbox-close">&times;</span>
        <img class="lightbox-content" id="imgFull">
        <div id="caption">Haz clic fuera para cerrar</div>
    </div>

    <style>
        .evento-card-horizontal {
            background: white;
            border-radius: 40px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.08);
            transition: 0.4s ease;
            border: 1px solid #f1f5f9;
        }

        .evento-card-horizontal:hover {
            transform: scale(1.01);
        }

        .evento-img-container {
            position: relative;
            width: 100%;
            height: 600px;
            /* Imagen mucho más grande para el ancho completo */
            background: #f8fafc;
        }

        .slider-wrapper,
        .slide,
        .main-img {
            width: 100%;
            height: 100%;
        }

        .slide {
            display: none;
        }

        .slide.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        .main-img {
            object-fit: cover;
            cursor: zoom-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* FLECHAS */
        .slider-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: white;
            color: #1e293b;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 10;
            font-size: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .slider-arrow:hover {
            background: #1e293b;
            color: white;
        }

        .prev {
            left: 30px;
        }

        .next {
            right: 30px;
        }

        .evento-badge-float {
            position: absolute;
            top: 30px;
            left: 30px;
            background: #1e293b;
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 800;
        }

        .evento-title-grid {
            font-size: 2rem;
            font-weight: 900;
            color: #1e293b;
            margin-bottom: 15px;
        }

        .evento-text-grid {
            font-size: 1.1rem;
            color: #64748b;
            line-height: 1.7;
        }

        .btn-fb-style {
            background: #1877f2;
            color: white;
            padding: 12px 25px;
            border-radius: 15px;
            font-weight: 800;
            font-size: 13px;
        }

        /* LIGHTBOX */
        .lightbox-modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(15, 23, 42, 0.98);
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .lightbox-content {
            max-width: 90%;
            max-height: 85vh;
            border-radius: 12px;
            animation: zoomImg 0.3s ease;
        }

        .lightbox-close {
            position: absolute;
            top: 30px;
            right: 40px;
            color: white;
            font-size: 50px;
            cursor: pointer;
        }

        /* COLORES */
        .evento-card-horizontal:nth-child(4n+1) {
            border-top: 10px solid #2563eb;
        }

        .evento-card-horizontal:nth-child(4n+2) {
            border-top: 10px solid #059669;
        }

        .evento-card-horizontal:nth-child(4n+3) {
            border-top: 10px solid #d97706;
        }

        .evento-card-horizontal:nth-child(4n+4) {
            border-top: 10px solid #7c3aed;
        }
    </style>

    <script>
        function moveSlide(sliderId, direction) {
            const container = document.getElementById(sliderId);
            const slides = container.getElementsByClassName('slide');
            let currentIndex = 0;
            for (let i = 0; i < slides.length; i++) {
                if (slides[i].classList.contains('active')) {
                    currentIndex = i;
                    slides[i].classList.remove('active');
                    break;
                }
            }
            let nextIndex = (currentIndex + direction + slides.length) % slides.length;
            slides[nextIndex].classList.add('active');
        }

        function openModal(src) {
            document.getElementById("imgFull").src = src;
            document.getElementById("imageModal").style.display = "flex";
            document.body.style.overflow = "hidden";
        }

        function closeModal() {
            document.getElementById("imageModal").style.display = "none";
            document.body.style.overflow = "auto";
        }
    </script>
@endsection