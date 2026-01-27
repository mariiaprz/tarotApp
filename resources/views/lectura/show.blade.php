@extends('layouts.app')

@section('title', 'Resultado de la Lectura - Tarot Místico')

@section('content')

<style>
    /* Estilos para la interpretación de la IA */

    .lectura-content h3 {
        font-family: "Poppins", sans-serif !important;
        color: #1a0526 !important;
        font-size: 24px !important;
        font-weight: 700 !important;
        margin-top: 30px !important;
        margin-bottom: 15px !important;
        line-height: 1.3 !important;
        border-bottom: 0px !important;
    }

    .lectura-content ul {
        list-style-type: disc !important;
        padding-left: 20px !important;
        margin-bottom: 20px !important;
    }

    .lectura-content li {
        margin-bottom: 5px;
        font-family: "Poppins", sans-serif !important;
    }

    .lectura-content p {
        font-family: "Poppins", sans-serif !important;
        font-size: 15px !important;
        line-height: 1.7 !important;
        text-align: justify;
        color: #5d4e60;
    }
</style>

<section class="position-relative text-center d-flex align-items-center justify-content-center"
    style="
        background-color: #1a0526;
        background-image: url('{{ asset('assets/images/banner/oraculo.jpg') }}'); 
        background-size: cover;
        background-position: center;
        height: 500px; 
        margin-top: -90px;
    ">

    <div class="position-absolute w-100 h-100" style="top:0; left:0; background: rgba(26, 5, 38, 0.75);"></div>

    <div class="container position-relative zindex-1" style="padding-top: 150px;">
        <h1 class="font-weight-bold mb-0 text-white display-3">El Oráculo ha Hablado</h1>
        <p class="opacity-75 lead text-white mt-3">
            <span class="text-primary font-weight-bold">{{ $lectura->tema->nombre }}</span>
            <span class="mx-2 text-white-50">|</span>
            {{ $lectura->tipoTirada->nombre }}
        </p>
    </div>
</section>

<section class="section bg-light">
    <div class="container">

        @if($lectura->pregunta)
        <div class="row justify-content-center mb-60">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm" style="border-left: 5px solid #c77dff !important; border-radius: 12px;">
                    <div class="card-body p-4 bg-white">
                        <h5 class="text-secondary mb-2"><i class="ti-thought text-primary mr-2"></i>Tu consulta fue:</h5>
                        <p class="lead font-italic text-dark mb-0">"{{ $lectura->pregunta }}"</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row mb-50">
            <div class="col-12 text-center">
                <h2 class="text-secondary">Interpretación de las Cartas</h2>
                <div class="section-border"></div>
            </div>
        </div>

        <div class="row justify-content-center">
            @foreach($lectura->cartaLecturas as $item)
            <div class="col-lg-4 col-md-6 mb-60">
                <div class="card border-0 bg-transparent h-100">

                    <div class="position-relative text-center mb-4">
                        <div style="display: inline-block; transition: transform 0.6s; {{ $item->invertida ? 'transform: rotate(180deg);' : '' }}">
                            <img src="{{ asset($item->carta->imagen) }}"
                                class="shadow-lg rounded"
                                alt="{{ $item->carta->nombre }}"
                                style="height: 320px; width: auto; max-width: 100%; object-fit: contain; border: 6px solid white; background-color: white;">
                        </div>
                    </div>

                    <div class="card-body text-center pt-0">
                        <h4 class="font-weight-bold mb-1 text-secondary">{{ $item->carta->nombre }}</h4>
                        <p class="text-uppercase text-primary mb-3 font-weight-bold" style="letter-spacing: 2px; font-size: 0.85rem;">
                            {{ $item->nombre_posicion }}
                        </p>

                        <div class="text-color px-2" style="text-align: justify; line-height: 1.6;">
                            @if($item->invertida)
                            <span class="d-block text-center text-warning mb-2 font-weight-bold" style="color: #ffb400 !important;">Significado Invertido</span>
                            {{ $item->carta->descripcion_invertida ?? $item->carta->descripcion }}
                            @else
                            <span class="d-block text-center text-success mb-2 font-weight-bold">Significado al Derecho</span>
                            {{ $item->carta->descripcion }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($lectura->interpretacion)
        <div class="row mt-3 mb-60">
            <div class="col-lg-10 mx-auto">
                <div class="card shadow-lg border-0 overflow-hidden" style="border-radius: 15px;">

                    <div class="card-header text-center py-4"
                        style="background-color: #1a0526; border-bottom: 4px solid #c77dff;">
                        <h3 class="mb-0 font-weight-bold text-white" style="font-family: inherit !important;">
                            <i class="ti-shine mr-2 text-warning"></i> La Voz de los Arcanos
                        </h3>
                        <p class="text-white-50 small mb-0 mt-1 italic">Interpretación del Oráculo Digital</p>
                    </div>

                    <div class="card-body p-5 bg-white">

                        {{-- Usamos {!! !!} para interpretar el HTML que envía la IA (negritas, párrafos). 
                         Si usáramos {{ }}, Laravel mostraría las etiquetas escritas en pantalla como texto plano. --}}
                        <div class="lectura-content">
                            {!! $lectura->interpretacion !!}
                        </div>

                        <div class="text-center mt-5">
                            <div class="section-border mx-auto" style="width: 50px; background-color: #c77dff;"></div>
                            <small class="text-muted mt-3 d-block font-italic">
                                "El destino baraja las cartas, pero nosotros las jugamos."
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row mt-5">
            <div class="col-12 text-center">
                <hr class="mb-50">
                <a href="{{ route('lectura.index') }}" class="btn btn-outline-secondary px-4 mr-2">
                    <i class="ti-arrow-left mr-1"></i> Volver al Historial
                </a>
                <a href="{{ route('main') }}#seccion-temas" class="btn btn-primary px-4">
                    <i class="ti-star mr-1"></i> Nueva Consulta
                </a>
            </div>
        </div>

    </div>
</section>

@endsection