@extends('layouts.dashboard')

@section('title', 'Evento - ' . $evento->titulo)

@section('content')

    <div class="max-w-6xl mx-auto py-12 px-4 space-y-10">

        {{-- 🔵 TARJETA ÚNICA DE EVENTO (Estilo Horizontal de Eventos) --}}
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
                            <button class="slider-arrow prev" onclick="moveSlide('slider-{{ $evento->id }}', -1)">&#10094;</button>
                            <button class="slider-arrow next" onclick="moveSlide('slider-{{ $evento->id }}', 1)">&#10095;</button>
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
            <div class="p-8 md:p-12">
                <div class="flex flex-col lg:flex-row gap-12">

                    {{-- MINIATURAS (Lado izquierdo) --}}
                    <div class="w-full lg:w-1/3">
                        <h4
                            class="text-xs font-black text-slate-400 uppercase tracking-widest mb-6 flex items-center gap-2">
                            <i class="fas fa-images text-blue-500"></i> Galería del evento
                        </h4>
                        <div class="grid grid-cols-4 gap-3">
                            @if($evento->imagenes && count($evento->imagenes))
                                @foreach($evento->imagenes as $img)
                                    <img src="{{ asset($img) }}"
                                        class="h-20 w-full object-cover rounded-2xl cursor-pointer hover:scale-105 transition-all shadow-sm border border-slate-100"
                                        onclick="openModal('{{ asset($img) }}')">
                                @endforeach
                            @endif
                        </div>
                    </div>

                    {{-- CONTENIDO DE TEXTO (Lado derecho) --}}
                    <div class="w-full lg:w-2/3 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-3 mb-4">
                                <span
                                    class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-[10px] font-black uppercase">Evento
                                    Institucional</span>
                                <span class="text-slate-300">|</span>
                                <span class="text-slate-400 text-xs font-bold"><i class="far fa-calendar-alt mr-1"></i>
                                    {{ $evento->fecha ? $evento->fecha->format('d/m/Y') : 'Pendiente' }}</span>
                            </div>

                            <h3 class="evento-title-grid text-4xl mb-6">{{ $evento->titulo }}</h3>

                            <p class="evento-text-grid text-lg">
                                {{ $evento->descripcion ?? 'Sin descripción disponible para este evento.' }}
                            </p>
                        </div>

                        <div class="mt-12 border-t border-slate-100 pt-8">
                            {{-- Contenedor principal centrado --}}
                            <div class="flex flex-col md:flex-row items-center justify-center gap-6 md:gap-12">

                                {{-- 1. BOTÓN FACEBOOK --}}
                                @if($evento->link)
                                    <a href="{{ $evento->link }}" target="_blank" class="btn-fb-style !mt-0">
                                        <i class="fab fa-facebook mr-2"></i> VER ÁLBUM COMPLETO EN FACEBOOK
                                    </a>
                                @endif

                                {{-- 2. BOTÓN VOLVER --}}
                                <a href="{{ route('eventos.index') }}"
                                    class="inline-flex items-center gap-2 px-8 py-4 bg-slate-900 text-white rounded-2xl text-xs font-black hover:bg-black hover:-translate-y-1 transition-all shadow-xl">
                                    <i class="fas fa-arrow-left"></i> VOLVER A LA TABLA
                                </a>

                                {{-- 3. LOGO Y NOMBRE --}}
                                <div class="flex items-center gap-2 opacity-40">
                                    <span class="text-[10px] font-black text-slate-500 tracking-tighter uppercase">CAM SAN
                                        PEDRO</span>
                                    <img src="/Imagenes/CAM logo.png" class="h-6">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL LIGHTBOX --}}
    <div id="imageModal" class="lightbox-modal" onclick="closeModal()">
        <span class="lightbox-close">&times;</span>
        <img class="lightbox-content" id="imgFull">
        <div id="caption">Haz clic fuera para cerrar la imagen</div>
    </div>

    <style>
        .evento-card-horizontal {
            background: white;
            border-radius: 45px;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.1);
            border: 1px solid #f1f5f9;
            border-top: 12px solid #2563eb;
            /* Color por defecto */
        }

        .evento-img-container {
            position: relative;
            width: 100%;
            height: 550px;
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
            animation: fadeIn 0.6s ease;
        }

        .main-img {
            object-fit: cover;
            cursor: zoom-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(1.05);
            }

            to {
                opacity: 1;
                transform: scale(1);
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
            width: 55px;
            height: 55px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 10;
            font-size: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            transition: all 0.3s;
        }

        .slider-arrow:hover {
            background: #1e293b;
            color: white;
            transform: translateY(-50%) scale(1.1);
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
            padding: 10px 25px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 900;
            letter-spacing: 1px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .evento-title-grid {
            font-weight: 900;
            color: #1e293b;
            line-height: 1.1;
            letter-spacing: -0.04em;
        }

        .evento-text-grid {
            color: #64748b;
            line-height: 1.8;
        }

        .btn-fb-style {
            background: #1877f2;
            color: white;
            padding: 15px 30px;
            border-radius: 20px;
            font-weight: 900;
            font-size: 12px;
            transition: 0.3s;
            box-shadow: 0 10px 20px rgba(24, 119, 242, 0.2);
        }

        .btn-fb-style:hover {
            background: #145dbf;
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(24, 119, 242, 0.3);
        }

        /* LIGHTBOX */
        .lightbox-modal {
            display: none;
            position: fixed;
            z-index: 9999;
            inset: 0;
            background-color: rgba(15, 23, 42, 0.98);
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .lightbox-content {
            max-width: 95%;
            max-height: 85vh;
            border-radius: 20px;
            box-shadow: 0 0 100px rgba(0, 0, 0, 0.5);
            animation: zoomImg 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .lightbox-close {
            position: absolute;
            top: 30px;
            right: 50px;
            color: white;
            font-size: 60px;
            cursor: pointer;
            font-weight: 200;
        }

        #caption {
            color: #64748b;
            margin-top: 20px;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 2px;
        }

        @keyframes zoomImg {
            from {
                transform: scale(0.9);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
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