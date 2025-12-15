@extends('layouts.app')

@section('title', 'Resultado de la Lectura - Tarot Místico')

@section('content')

<section class="page-title bg-cover overlay-secondary" style="background-image: url('{{ asset('assets/images/backgrounds/about-bg.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center text-white zindex-1">
                <h1 class="font-weight-bold display-4">El Oráculo ha Hablado</h1>
                <p class="font-primary lead mt-3">
                    <span class="text-primary">{{ $lectura->tema->nombre }}</span>
                    <span class="mx-2">|</span>
                    {{ $lectura->tipoTirada->nombre }}
                </p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">

        @if($lectura->pregunta)
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm" style="border-left: 5px solid #c77dff !important;">
                    <div class="card-body p-4 bg-light">
                        <h5 class="text-secondary mb-2"><i class="ti-thought text-primary mr-2"></i>Tu consulta fue:</h5>
                        <p class="lead font-italic text-dark mb-0">"{{ $lectura->pregunta }}"</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-title text-secondary">Interpretación de las Cartas</h2>
                <div class="section-border"></div>
            </div>
        </div>

        <div class="row justify-content-center">

            @foreach($lectura->cartaLecturas as $item)

            <div class="col-lg-4 col-md-6 mb-5">
                <div class="card border-0 bg-transparent h-100">

                    <div class="position-relative text-center perspective-container mb-4">
                        <div class="card-image-wrapper shadow rounded d-inline-block position-relative"
                            style="transition: transform 0.5s; {{ $item->invertida ? 'transform: rotate(180deg);' : '' }}">

                            <img src="{{ asset('img/cartas/' . $item->carta->imagen) }}"
                                class="img-fluid rounded"
                                alt="{{ $item->carta->nombre }}"
                                style="max-width: 200px; width: 100%;">

                            @if($item->invertida)
                            <div class="position-absolute w-100 h-100 d-flex align-items-center justify-content-center" style="top:0; left:0; pointer-events: none;">
                                <span class="badge badge-danger shadow" style="transform: rotate(-180deg); font-size: 0.9rem; opacity: 0.9;">
                                    INVERTIDA
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="card-body text-center p-0">

                        <h4 class="card-title font-weight-bold mb-1" style="color: #1a0526;">
                            {{ $item->carta->nombre }}
                        </h4>

                        <p class="text-uppercase font-weight-bold text-primary mb-3" style="letter-spacing: 2px; font-size: 0.8rem;">
                            {{ $item->nombre_posicion }}
                        </p>

                        <div class="card-text text-muted px-2 text-justify">

                            @if($item->invertida)
                            <strong class="d-block text-center text-warning mb-2">Sentido Invertido:</strong>
                            {{ $item->carta->descripcion }}
                            @else
                            <strong class="d-block text-center text-success mb-2">Sentido al Derecho:</strong>
                            {{ $item->carta->descripcion }}
                            @endif

                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row mt-5">
            <div class="col-12 text-center">
                <hr class="mb-5">
                <a href="{{ route('lectura.index') }}" class="btn btn-outline-secondary mr-2">
                    <i class="ti-arrow-left mr-1"></i> Volver al Historial
                </a>

                <a href="{{ route('main') }}#seccion-temas" class="btn btn-primary shadow">
                    <i class="ti-star mr-1"></i> Nueva Consulta
                </a>

                <form action="{{ route('lectura.destroy', $lectura->id) }}" method="POST" class="d-inline-block ml-2" onsubmit="return confirm('¿Borrar esta lectura?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="ti-trash"></i>
                    </button>
                </form>
            </div>
        </div>

    </div>
</section>

@endsection