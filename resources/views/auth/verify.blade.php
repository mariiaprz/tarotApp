@extends('layouts.app')

@section('title', 'Verificar Email - Tarot Místico')

@section('content')

<section class="section bg-cover overlay-secondary-half"
    style="background-image: url('{{ asset('assets/images/backgrounds/verify.jpg') }}'); padding-top: 150px; padding-bottom: 100px; min-height: 100vh;">

    <div class="container position-relative zindex-1">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">

                <div class="card shadow border-0" style="background: #fff;">
                    <div class="card-body p-5 text-center">

                        <div class="mb-4">
                            <i class="ti-email text-primary icon-lg"></i>
                        </div>

                        <h2 class="text-secondary h3 mb-3">Verifica tu Correo</h2>
                        <p class="text-muted mb-4">Para asegurar tu conexión con el portal, necesitamos confirmar que este email es tuyo.</p>

                        @if (session('resent'))
                        <div class="alert alert-success border-0 shadow-sm mb-4" role="alert">
                            <i class="ti-check mr-2"></i> Acabamos de enviar un nuevo enlace de verificación a tu correo.
                        </div>
                        @endif

                        <p class="mb-2">Antes de continuar, por favor revisa tu bandeja de entrada y busca el enlace de verificación.</p>

                        <p class="mb-4 small text-muted">¿No has recibido el correo?</p>

                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary shadow-sm">
                                Haz clic aquí para pedir otro
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection