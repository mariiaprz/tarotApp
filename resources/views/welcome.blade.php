@extends('layouts.app')

@section('title', 'Tarot Místico - Descubre tu Destino')

@section('content')

<section class="banner bg-cover position-relative d-flex justify-content-center align-items-center"
    style="background-image: url('{{ asset('assets/images/banner/hero.jpg') }}'); background-color: #2a0a4d;">

    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(20, 0, 40, 0.6);"></div>

    <div class="container position-relative zindex-1">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-1 text-white font-weight-bold font-primary">Tarot Místico</h1>
                <p class="lead text-light mb-4">Las respuestas que buscas están en las cartas. Conecta con tu intuición.</p>

                <a href="#seccion-temas" class="btn btn-lg btn-primary">Comenzar Lectura</a>
            </div>
        </div>
    </div>
</section>

<section class="section" id="seccion-temas">
    <div class="container">

        <div class="row">
            <div class="col-lg-10 mx-auto text-center">
                <h2 class="section-title">Elige tu Consulta</h2>
                <p class="lead">Selecciona el área de tu vida sobre la que deseas recibir guía espiritual hoy.</p>
                <div class="section-border"></div>
            </div>
        </div>

        <div class="row">
            @forelse($temas as $tema)
            <div class="col-lg-4 mb-4 mb-lg-0">

                @auth
                <a href="{{ route('lectura.create', $tema->id) }}" class="text-decoration-none text-dark">
                    @else
                    <a href="#" class="text-decoration-none text-dark" data-toggle="modal" data-target="#modalRegistro">
                        @endauth

                        <div class="card hover-bg-secondary shadow py-4 h-100">
                            <div class="card-body text-center">
                                <div class="position-relative">
                                    <i class="icon-lg icon-box bg-gradient-primary rounded-circle {{ $tema->icono ?? 'ti-star' }} mb-5 d-inline-block text-white"></i>
                                    <i class="icon-lg icon-watermark text-white {{ $tema->icono ?? 'ti-star' }}"></i>
                                </div>
                                <h4 class="mb-4">{{ $tema->nombre }}</h4>
                                <p>{{ $tema->descripcion }}</p>

                                <span class="btn btn-sm btn-outline-primary mt-3">Consultar Ahora</span>
                            </div>
                        </div>
                    </a>
            </div>
            @empty
            <div class="col-12 text-center">
                <div class="alert alert-warning">
                    No hay temas disponibles.
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<section class="section bg-secondary position-relative">
    <div class="bg-image overlay-secondary">
        <img src="{{ asset('assets/images/tarot.jpg') }}" alt="bg-image">
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="row align-items-center">

                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <img src="{{ asset('assets/images/tarot.jpg') }}" alt="tarot-image" class="img-fluid rounded shadow-lg">
                    </div>

                    <div class="col-lg-7 offset-lg-1">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="text-white">Cómo Funciona el Oráculo</h2>
                                <div class="section-border ml-0"></div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="media">
                                    <i class="icon text-gradient-primary ti-user mr-3"></i>
                                    <div class="media-body">
                                        <h4 class="text-white">1. Regístrate</h4>
                                        <p class="text-light">Crea tu cuenta gratuita para guardar tu historial de lecturas y conectar tu energía.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="media">
                                    <i class="icon text-gradient-primary ti-thought mr-3"></i>
                                    <div class="media-body">
                                        <h4 class="text-white">2. Concéntrate</h4>
                                        <p class="text-light">Piensa en tu pregunta. Visualiza la situación que te preocupa con claridad.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="media">
                                    <i class="icon text-gradient-primary ti-layers-alt mr-3"></i>
                                    <div class="media-body">
                                        <h4 class="text-white">3. Elige Tirada</h4>
                                        <p class="text-light">Selecciona entre tirada de 3 cartas, Cruz Celta o carta del día.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="media">
                                    <i class="icon text-gradient-primary ti-eye mr-3"></i>
                                    <div class="media-body">
                                        <h4 class="text-white">4. Descubre</h4>
                                        <p class="text-light">Recibe la interpretación de los arcanos y su consejo para tu camino.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto text-center">
                <h2>Los Arcanos Guía</h2>
                <p>Las cartas más poderosas que podrían aparecer en tu lectura</p>
                <div class="section-border"></div>
            </div>
        </div>

        <div class="row no-gutters">

            @foreach($cartasGuia as $carta)
            <div class="col-lg-3 col-sm-6">
                <div class="card hover-shadow h-100">

                    <div style="height: 400px; overflow: hidden;">
                        <img src="{{ asset($carta->imagen) }}"
                            alt="{{ $carta->nombre }}"
                            class="card-img-top"
                            style="width: 100%; height: 100%; object-fit: cover;">
                    </div>

                    <div class="card-body text-center position-relative zindex-1">
                        <h4>{{ $carta->nombre }}</h4>
                        <i class="text-muted">{{ Str::limit($carta->descripcion, 30, '...') }}</i>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section>
    <div class="container section-sm overlay-secondary-half bg-cover"
        data-background="{{ asset('assets/images/backgrounds/dudas.jpg') }}"
        style="background-image: url('{{ asset('assets/images/backgrounds/dudas.jpg') }}');">

        <div class="row">
            <div class="col-lg-8 offset-lg-1">
                <h2 class="text-gradient-primary">¿Tienes dudas sobre tu futuro?</h2>
                <p class="h4 font-weight-bold text-white mb-4">"El destino baraja las cartas, pero nosotros somos quienes jugamos."</p>

                @guest
                <a href="{{ route('register') }}" class="btn btn-lg btn-primary">Regístrate y Pregunta</a>
                @else
                <a href="#seccion-temas" class="btn btn-lg btn-primary">Hacer Nueva Lectura</a>
                @endguest
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">Destino Bloqueado</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body text-center py-4">
                <i class="ti-lock icon-lg text-primary mb-3"></i>
                <p class="h4 text-white mb-3">Necesitas identificarte</p>
                <p class="text-light px-4">Para que las cartas conecten con tu energía y podamos guardar tu lectura, debes iniciar sesión o crear una cuenta gratuita.</p>
            </div>

            <div class="modal-footer border-0 d-flex justify-content-center flex-wrap pb-4">
                <button type="button" class="btn btn-sm btn-outline-light m-1" data-dismiss="modal">Cancelar</button>
                <a href="{{ route('login') }}" class="btn btn-sm btn-secondary m-1">Iniciar Sesión</a>
                <a href="{{ route('register') }}" class="btn btn-sm btn-primary m-1">Registrarse</a>
            </div>
        </div>
    </div>
</div>

@endsection