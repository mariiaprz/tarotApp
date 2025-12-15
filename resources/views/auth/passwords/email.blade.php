@extends('layouts.app')

@section('title', 'Recuperar Contraseña - Tarot Místico')

@section('content')

<section class="section bg-cover overlay-secondary-half"
    style="background-image: url('{{ asset('assets/images/backgrounds/hero.jpg') }}'); padding-top: 150px; padding-bottom: 100px; min-height: 100vh;">

    <div class="container position-relative zindex-1">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">

                <div class="card shadow border-0" style="background: #fff;">
                    <div class="card-body p-5">

                        <div class="text-center mb-4">
                            <i class="ti-lock text-primary icon-lg mb-3"></i>
                            <h2 class="text-secondary h4">Recuperar Acceso</h2>
                            <p class="text-muted small">Te enviaremos un enlace mágico para restablecer tu clave.</p>
                        </div>

                        @if (session('status'))
                        <div class="alert alert-success border-0 shadow-sm mb-4" role="alert">
                            <i class="ti-check mr-2"></i> {{ session('status') }}
                        </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group mb-4">
                                <label for="email" class="text-secondary font-weight-bold small text-uppercase">Correo Electrónico</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="tu@email.com">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-block w-100 shadow-sm mb-4">
                                Enviar Enlace de Recuperación
                            </button>

                            <div class="text-center">
                                <a href="{{ route('login') }}" class="small text-muted font-weight-bold">
                                    <i class="ti-arrow-left mr-1"></i> Volver al Login
                                </a>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection