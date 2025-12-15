@extends('layouts.app')

@section('title', 'Nueva Contraseña - Tarot Místico')

@section('content')

<section class="section bg-cover overlay-secondary-half"
    style="background-image: url('{{ asset('assets/images/backgrounds/hero.jpg') }}'); padding-top: 150px; padding-bottom: 100px; min-height: 100vh;">

    <div class="container position-relative zindex-1">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">

                <div class="card shadow border-0" style="background: #fff;">
                    <div class="card-body p-5">

                        <div class="text-center mb-4">
                            <i class="ti-key text-primary icon-lg mb-3"></i>
                            <h2 class="text-secondary h4">Restablecer Contraseña</h2>
                            <p class="text-muted small">Elige una nueva clave segura para tu cuenta.</p>
                        </div>

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group mb-4">
                                <label for="email" class="text-secondary font-weight-bold small text-uppercase">Correo Electrónico</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="password" class="text-secondary font-weight-bold small text-uppercase">Nueva Contraseña</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password" placeholder="********">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="password-confirm" class="text-secondary font-weight-bold small text-uppercase">Confirmar Contraseña</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password" placeholder="********">
                            </div>

                            <button type="submit" class="btn btn-primary btn-block w-100 shadow-sm">
                                Cambiar Contraseña
                            </button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection