@extends('layouts.app')

@section('title', 'Resultado de la Lectura - Tarot Místico')

@section('content')

{{-- 1. CABECERA --}}
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

{{-- 2. CUERPO DE LA PÁGINA --}}
<section class="section bg-light">
    <div class="container">

        {{-- Caja de la Pregunta --}}
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

        {{-- Título de interpretación --}}
        <div class="row mb-50">
            <div class="col-12 text-center">
                <h2 class="text-secondary">Interpretación de las Cartas</h2>
                <div class="section-border"></div>
            </div>
        </div>

        {{-- Grid de Cartas --}}
        <div class="row justify-content-center">
            @foreach($lectura->cartaLecturas as $item)
            <div class="col-lg-4 col-md-6 mb-60"> {{-- Aumentado margen inferior para separar filas --}}
                <div class="card border-0 bg-transparent h-100">
                    
                    {{-- Imagen de la Carta --}}
                    <div class="position-relative text-center mb-4">
                        {{-- Contenedor para la rotación --}}
                        <div style="display: inline-block; transition: transform 0.6s; {{ $item->invertida ? 'transform: rotate(180deg);' : '' }}">
                            {{-- 
                                IMAGEN CON ALTURA FIJA:
                                - height: 320px; -> Fuerza la altura.
                                - object-fit: contain; -> Evita que se deforme la imagen.
                                - background-color: white; -> Rellena huecos si el formato varía.
                            --}}
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
                                {{-- CAMBIO DE COLOR: Usamos text-warning y forzamos un dorado --}}
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

        {{-- Botones --}}
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