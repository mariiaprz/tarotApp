@extends('layouts.app')

@section('title', 'Iniciar Sesión - Tarot Místico')

@section('content')

<section class="section bg-cover overlay-secondary-half"
    style="background-image: url('{{ asset('assets/images/backgrounds/login.jpg') }}'); padding-top: 150px; padding-bottom: 100px; min-height: 100vh;">

    <div class="container position-relative zindex-1">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">

                <div class="card shadow border-0" style="background: #fff;">
                    <div class="card-body p-5">

                        <div class="text-center mb-4">
                            <i class="ti-user text-primary icon-md mb-3"></i>
                            <h2 class="text-secondary h3">{{ __('Login') }}</h2>
                            <p class="text-muted small">Conecta con tu energía</p>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group mb-4">
                                <label for="email" class="text-secondary font-weight-bold small text-uppercase">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="tu@email.com">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="password" class="text-secondary font-weight-bold small text-uppercase mb-0">{{ __('Password') }}</label>

                                    @if (Route::has('password.request'))
                                    <a class="small text-primary" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif
                                </div>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password"
                                    placeholder="••••••••">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label text-muted small" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block w-100 mb-4 shadow-sm">
                                {{ __('Login') }}
                            </button>

                            <div class="text-center">
                                <p class="small text-muted mb-0">¿No tienes cuenta?</p>
                                <a href="{{ route('register') }}" class="text-primary font-weight-bold">
                                    {{ __('Register') }}
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