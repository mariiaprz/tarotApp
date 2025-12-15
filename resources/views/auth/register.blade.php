@extends('layouts.app')

@section('title', 'Crear Cuenta - Tarot Místico')

@section('content')

<section class="section bg-cover overlay-secondary-half"
    style="background-image: url('{{ asset('assets/images/backgrounds/register.jpg') }}'); padding-top: 150px; padding-bottom: 100px; min-height: 100vh;">

    <div class="container position-relative zindex-1">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-9">
                <div class="card shadow border-0" style="background: #fff;">
                    <div class="card-body p-5">

                        <div class="text-center mb-4">
                            <i class="ti-wand text-primary icon-md mb-3"></i>
                            <h2 class="text-secondary h3">{{ __('Register') }}</h2>
                            <p class="text-muted small">Únete al círculo y guarda tu destino</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group mb-4">
                                <label for="name" class="text-secondary font-weight-bold small text-uppercase">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                    placeholder="Tu nombre espiritual">
                                @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="email" class="text-secondary font-weight-bold small text-uppercase">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email"
                                    placeholder="tu@email.com">
                                @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group mb-4">
                                    <label for="password" class="text-secondary font-weight-bold small text-uppercase">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="new-password" placeholder="••••••••">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group mb-4">
                                    <label for="password-confirm" class="text-secondary font-weight-bold small text-uppercase">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block w-100 mb-4 shadow-sm">
                                {{ __('Register') }}
                            </button>

                            <div class="text-center">
                                <p class="small text-muted mb-0">¿Ya eres miembro?</p>
                                <a href="{{ route('login') }}" class="text-primary font-weight-bold">
                                    {{ __('Login') }}
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