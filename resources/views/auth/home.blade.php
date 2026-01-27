@extends('layouts.app')

@section('title', 'Mi Perfil - Tarot Místico')

@section('content')

<section class="position-relative text-center d-flex align-items-center justify-content-center"
    style="
        background-color: #2a0a4d;
        background-image: url('{{ asset('assets/images/banner/banner2.jpg') }}'); 
        background-size: cover;
        background-position: center;
        height: 450px;">

    <div class="position-absolute w-100 h-100" style="top:0; left:0; background: rgba(42, 10, 77, 0.6);"></div>

    <div class="container position-relative zindex-1">

        <div class="icon-lg rounded-circle bg-white text-primary mx-auto mb-3 d-flex align-items-center justify-content-center shadow-lg"
            style="width: 110px; height: 110px; border: 4px solid rgba(255,255,255,0.3);">
            <span style="font-size: 3rem; font-weight: bold;">{{ substr(Auth::user()->name, 0, 1) }}</span>
        </div>

        <h1 class="font-weight-bold mb-0 text-white display-4" style="font-family: inherit !important;">{{ Auth::user()->name }}</h1>
        <p class="opacity-75 lead text-white" style="font-family: inherit !important;">{{ Auth::user()->email }}</p>

    </div>
</section>


<section class="section bg-light" style="padding-top: 0; min-height: 60vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card shadow border-0 overflow-hidden" style="margin-top: -80px; z-index: 10;">

                    <div class="card-body p-5">

                        @if (session('status'))
                        <div class="alert alert-success mb-4 d-flex align-items-center" role="alert">
                            <i class="ti-check-box mr-2"></i> {{ session('status') }}
                        </div>
                        @endif

                        <h4 class="text-secondary mb-4 border-bottom pb-3" style="font-family: inherit !important;">Tus Datos de Usuario</h4>

                        <div class="row mb-5">
                            <div class="col-md-6 mb-3">
                                <div class="p-4 border rounded bg-white h-100 shadow-sm d-flex align-items-center">
                                    <div class="icon-md bg-light text-primary rounded mr-3 text-center" style="width: 50px; height: 50px; line-height: 50px;">
                                        <i class="ti-calendar"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted text-uppercase d-block mb-1">Miembro Desde</small>
                                        <h5 class="text-dark mb-0 font-weight-bold" style="font-family: inherit !important;">
                                            {{ Auth::user()->created_at->format('d/m/Y') }}
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="p-4 border rounded bg-white h-100 shadow-sm d-flex align-items-center">
                                    <div class="icon-md bg-light text-primary rounded mr-3 text-center" style="width: 50px; height: 50px; line-height: 50px;">
                                        <i class="ti-time"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted text-uppercase d-block mb-1">Última Modificación</small>
                                        <h5 class="text-dark mb-0 font-weight-bold" style="font-family: inherit !important;">
                                            {{ Auth::user()->updated_at->format('d/m/Y') }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('home.edit') }}" class="btn btn-primary px-4">
                                <i class="ti-pencil mr-1"></i> Editar Perfil
                            </a>

                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form-profile').submit();"
                                class="btn btn-outline-danger px-4">
                                <i class="ti-power-off mr-1"></i> Cerrar Sesión
                            </a>
                        </div>

                        <form id="logout-form-profile" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection