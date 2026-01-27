@extends('layouts.app')

@section('title', 'Mis Lecturas - Tarot Místico')

@section('content')

<section class="section pb-0"
    style="background-image: url('{{ asset('assets/images/banner/banner.jpg') }}'); 
           background-size: cover; 
           background-position: center; 
           padding-top: 180px; 
           padding-bottom: 80px;
           position: relative;">

    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(26, 5, 38, 0.8); z-index: 1;"></div>

    <div class="container" style="position: relative; z-index: 2;">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="font-weight-bold text-white" style="font-family: inherit !important; letter-spacing: 2px;">Tu Historial Espiritual</h2>
                <p class="text-white-50 italic" style="font-family: inherit !important;">"Los mensajes del oráculo que han marcado tu camino."</p>
                <div class="section-border bg-white" style="opacity: 0.5;"></div>
            </div>
        </div>
    </div>
</section>

<section class="section bg-light" style="min-height: 70vh; padding-top: 60px;">
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-md-8 col-lg-6">
                <form method="GET" action="{{ route('lectura.index') }}">
                    <div class="input-group shadow-sm" style="border-radius: 30px; overflow: hidden;">
                        <select name="tema_id" class="form-control border-0" style="height: 50px; padding-left: 20px;">
                            <option value="">Ver todos los temas</option>
                            @foreach($temas as $tema)
                            <option value="{{ $tema->id }}" {{ request('tema_id') == $tema->id ? 'selected' : '' }}>
                                {{ $tema->nombre }}
                            </option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-primary px-4 border-0" type="submit">
                                <i class="ti-filter mr-1"></i> Filtrar
                            </button>
                        </div>
                    </div>

                    @if(request('tema_id'))
                    <div class="text-center mt-2">
                        <a href="{{ route('lectura.index') }}" class="text-muted small" style="text-decoration: underline;">
                            <i class="ti-close mr-1"></i> Ver todas las lecturas
                        </a>
                    </div>
                    @endif
                </form>
            </div>
        </div>

        @if($lecturas->count() > 0)
        <div class="row">
            @foreach($lecturas as $lectura)
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; overflow: hidden;">
                    <div style="height: 4px; background: #c77dff;"></div>

                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge px-3 py-2" style="background-color: #f8f5fa; color: #6f42c1; border: 1px solid #e9ecef; font-family: inherit !important;">
                                {{ $lectura->tema->nombre }}
                            </span>
                            <small class="text-muted"><i class="ti-calendar mr-1"></i> {{ $lectura->created_at->format('d/m/Y') }}</small>
                        </div>

                        <h4 class="mb-3 text-secondary" style="font-family: inherit !important; font-weight: 600; line-height: 1.4;">
                            "{{ Str::limit($lectura->pregunta, 80, '...') }}"
                        </h4>

                        <p class="text-muted small mb-4">
                            <i class="ti-layout-grid2 mr-1"></i> Tirada: {{ $lectura->tipoTirada->nombre ?? 'Oráculo' }}
                        </p>

                        <div class="d-flex justify-content-between align-items-center border-top pt-3">

                            <a href="{{ route('lectura.show', $lectura->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-4">
                                Releer Mensaje <i class="ti-arrow-right ml-1"></i>
                            </a>

                            <button type="button"
                                class="btn-icon bg-white text-danger shadow-sm rounded-circle d-flex align-items-center justify-content-center border-0"
                                style="width: 35px; height: 35px; cursor: pointer; transition: 0.3s;"
                                data-toggle="modal"
                                data-target="#modalBorrar-{{ $lectura->id }}">
                                <i class="ti-trash"></i>
                            </button>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalBorrar-{{ $lectura->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                        <div class="modal-header border-0" style="background-color: #1a0526;">
                            <h5 class="modal-title font-weight-bold" style="color: #ffffff !important;">
                                <i class="ti-alert mr-2" style="color: #ffffff !important;"></i> Eliminar Lectura
                            </h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.8;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body p-4 text-center">
                            <p class="text-secondary font-weight-bold mb-2">¿Quieres borrar este mensaje del destino?</p>
                            <p class="text-muted small font-italic mb-0">"{{ Str::limit($lectura->pregunta, 50) }}"</p>
                            <p class="text-danger small mt-3 mb-0">Esta acción es irreversible.</p>
                        </div>
                        <div class="modal-footer border-0 justify-content-center pb-4">
                            <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-4" data-dismiss="modal">Cancelar</button>
                            <form action="{{ route('lectura.destroy', $lectura->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-primary btn-sm rounded-pill px-4 shadow">Sí, Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                {{-- Genera los botones 1, 2, 3... --}}
                {{ $lecturas->links() }}
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('main') }}#seccion-temas" class="btn btn-primary btn-lg shadow px-5 rounded-pill">
                Nueva Consulta al Tarot
            </a>
        </div>

        @else
        {{-- Cuando no hay resultados o el filtro no encuentra nada --}}
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="card shadow-sm border-0 p-5 bg-white" style="border-radius: 20px;">
                    <i class="ti-receipt display-4 text-muted mb-3 d-block"></i>
                    <h3 class="text-secondary" style="font-family: inherit !important;">No se encontraron lecturas</h3>
                    <p class="text-muted mb-4">
                        @if(request('tema_id'))
                        No tienes lecturas guardadas en este tema.
                        @else
                        Tu camino espiritual está empezando.
                        @endif
                    </p>
                    <a href="{{ route('main') }}#seccion-temas" class="btn btn-primary rounded-pill px-4">Nueva Consulta</a>
                </div>
            </div>
        </div>
        @endif

    </div>
</section>

@endsection