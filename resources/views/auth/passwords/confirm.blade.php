@extends('layouts.app')

@section('title', 'Confirmar Acceso - Tarot Místico')

@section('content')

<section class="section bg-cover overlay-secondary-half"
    style="background-image: url('{{ asset('assets/images/backgrounds/hero.jpg') }}'); padding-top: 150px; padding-bottom: 100px; min-height: 100vh;">

    <div class="container position-relative zindex-1">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">

                <div class="card shadow border-0" style="background: #fff;">
                    <div class="card-body p-5">

                        <div class="text-center mb-4">
                            <i class="ti-shield text-primary icon-lg mb-3"></i>
                            <h2 class="text-secondary h4">Confirmación de Seguridad</h2>
                            <p class="text-muted small">Esta es una zona protegida. Por favor, confirma tu contraseña para continuar.</p>
                        </div>

                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            <div class="form-group mb-4">
                                <label for="password" class="text-secondary font-weight-bold small text-uppercase">Contraseña Actual</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password" placeholder="********">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-block w-100 shadow-sm mb-4">
                                Confirmar Acceso
                            </button>

                            @if (Route::has('password.request'))
                            <div class="text-center">
                                <a class="small text-muted" href="{{ route('password.request') }}">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            </div>
                            @endif

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection