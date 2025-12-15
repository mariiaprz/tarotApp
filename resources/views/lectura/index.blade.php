@extends('layouts.app')

@section('title', 'Mis Lecturas - Tarot Místico')

@section('content')

<section class="section bg-light" style="min-height: 100vh; padding-top: 150px;">
    <div class="container">

        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-title text-secondary">Tu Historial Espiritual</h2>
                <p class="lead text-muted">Repasa los consejos que el oráculo te ha dado en el pasado.</p>
                <div class="section-border"></div>
            </div>
        </div>

        @if($lecturas->count() > 0)
        <div class="row">
            @foreach($lecturas as $lectura)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card hover-shadow h-100 border-0 shadow-sm">

                    <div class="card-header bg-white border-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                        <span class="badge badge-pill px-3 py-2" style="background-color: #f8f5fa; color: #1a0526; border: 1px solid #c77dff;">
                            {{ $lectura->tema->nombre }}
                        </span>
                        <small class="text-muted font-italic">{{ $lectura->created_at->format('d/m/Y') }}</small>
                    </div>

                    <div class="card-body px-4">
                        <h5 class="card-title mt-3 text-secondary" style="font-weight: 600;">
                            <!-- Usado para limitar la pregunta que nos hagan a 60 caracteres a la hora de visualizarla -->
                            {{ Str::limit($lectura->pregunta, 60, '...') }}
                        </h5>
                        <p class="card-text text-muted small">
                            <i class="ti-layers-alt mr-1"></i> Tirada: {{ $lectura->tipoTirada->nombre ?? 'General' }}
                        </p>
                    </div>

                    <div class="card-footer bg-white border-0 pb-4 px-4 d-flex justify-content-between align-items-center">

                        <a href="{{ route('lectura.show', $lectura->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="ti-eye mr-1"></i> Ver
                        </a>

                        <form action="{{ route('lectura.destroy', $lectura->id) }}" method="POST"
                            onsubmit="return confirm('¿Seguro que quieres olvidar esta lectura? La energía se perderá para siempre.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm text-danger bg-transparent border-0 p-0" title="Eliminar">
                                <i class="ti-trash" style="font-size: 18px;"></i>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="{{ route('main') }}#seccion-temas" class="btn btn-primary btn-lg shadow">
                    Consultar de nuevo al Tarot
                </a>
            </div>
        </div>

        @else
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="card shadow border-0 p-5 mt-4">
                    <div class="mb-4">
                        <span class="icon-lg icon-box rounded-circle bg-secondary text-white shadow">
                            <i class="ti-thought"></i>
                        </span>
                    </div>
                    <h3 class="text-secondary">Aún no has consultado al oráculo</h3>
                    <p class="text-muted mb-4">Tu destino está esperando ser revelado. Elige un tema y haz tu primera pregunta para verla aquí.</p>

                    <a href="{{ route('main') }}#seccion-temas" class="btn btn-primary btn-lg">
                        Comenzar Nueva Lectura
                    </a>
                </div>
            </div>
        </div>
        @endif

    </div>
</section>

@endsection