@extends('layouts.app')

@section('title', 'Editar Perfil - Tarot Místico')

@section('content')

<section class="position-relative text-center d-flex align-items-center justify-content-center"
    style="
        background-color: #2a0a4d; /* Fondo de seguridad */
        background-image: url('{{ asset('assets/images/banner/banner2.jpg') }}'); /* Imagen de fondo */
        background-size: cover;
        background-position: center;
        height: 400px;">

    <div class="position-absolute w-100 h-100" style="top:0; left:0; background: rgba(42, 10, 77, 0.7);"></div>

    <div class="container position-relative zindex-1 text-white">
        <div class="icon-md bg-white text-primary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center shadow-sm"
            style="width: 70px; height: 70px;">
            <i class="ti-settings" style="font-size: 1.8rem;"></i>
        </div>

        <h1 class="font-weight-bold display-4 text-white" style="font-family: inherit !important;">Editar Perfil</h1>
        <p class="lead text-white opacity-75" style="font-family: inherit !important;">Actualiza tu identidad y refuerza tu seguridad</p>
    </div>
</section>

<section class="section bg-light" style="padding-top: 0; min-height: 60vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card shadow border-0 overflow-hidden" style="margin-top: -80px; z-index: 10;">

                    <div class="card-body p-5">

                        <form method="POST" action="{{ route('home.update') }}">
                            @csrf
                            @method('put')

                            <h4 class="text-secondary mb-4 border-bottom pb-3">
                                <i class="ti-id-badge mr-2 text-primary"></i>Datos de Identidad
                            </h4>

                            <div class="row">
                                <div class="col-md-6 form-group mb-4">
                                    <label for="name" class="text-secondary font-weight-bold small text-uppercase">Nombre</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name', Auth::user()->name) }}" required autocomplete="name">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group mb-4">
                                    <label for="email" class="text-secondary font-weight-bold small text-uppercase">Correo Electrónico</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email', Auth::user()->email) }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <h4 class="text-secondary mb-4 border-bottom pb-3 mt-4">
                                <i class="ti-lock mr-2 text-primary"></i>Seguridad (Opcional)
                            </h4>

                            <div class="alert alert-light border mb-4">
                                <small class="text-muted"><i class="ti-info-alt mr-1"></i> Solo rellena estos campos si deseas cambiar tu contraseña.</small>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group mb-4">
                                    <label for="password" class="text-secondary font-weight-bold small text-uppercase">Nueva Contraseña</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" autocomplete="new-password" placeholder="Dejar vacío para no cambiar">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group mb-4">
                                    <label for="password-confirm" class="text-secondary font-weight-bold small text-uppercase">Confirmar Nueva</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" autocomplete="new-password" placeholder="Repetir nueva contraseña">
                                </div>
                            </div>

                            <div class="form-group mb-4 bg-light p-4 rounded border mt-2">
                                <label for="currentpassword" class="text-secondary font-weight-bold small text-uppercase">
                                    Contraseña Actual <span class="text-danger">*</span>
                                </label>
                                <input id="currentpassword" type="password" class="form-control @error('currentpassword') is-invalid @enderror"
                                    name="currentpassword" required placeholder="Confirma tu clave actual para guardar">

                                <small class="text-muted mt-2 d-block">Por seguridad, es necesario confirmar tu identidad para aplicar cambios.</small>

                                @error('currentpassword')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <a href="{{ route('home') }}" class="btn btn-outline-secondary px-4 rounded-pill">
                                    <i class="ti-arrow-left mr-1"></i> Volver
                                </a>

                                <button type="submit" class="btn btn-primary shadow px-5 rounded-pill">
                                    <i class="ti-save mr-2"></i> Guardar Cambios
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection