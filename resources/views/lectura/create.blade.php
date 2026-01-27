@extends('layouts.app')

@section('title', 'Nueva Consulta - Tarot Místico')

@section('content')

<section class="position-relative text-center d-flex align-items-center justify-content-center"
    style="
        background-color: #2a0a4d;
        background-image: url('{{ asset('assets/images/banner/consulta.jpg') }}'); 
        background-size: cover;
        background-position: center;
        height: 450px;">

    <div class="position-absolute w-100 h-100" style="top:0; left:0; background: rgba(26, 5, 38, 0.7);"></div>

    <div class="container position-relative zindex-1">
        
        <h1 class="font-weight-bold mb-0 text-white display-4" style="font-family: inherit !important;">
            Consultar a los Arcanos
        </h1>
        
        <p class="opacity-75 lead text-white mt-3 mb-4" style="font-family: inherit !important;">
            "Concéntrate en tu pregunta y deja que las cartas guíen tu intuición."
        </p>

        <div class="section-border bg-white" style="opacity: 0.5;"></div>
    </div>
</section>

<section class="section bg-light" style="padding-top: 0; min-height: 60vh;">
    <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-lg-8">
                
                <div class="card shadow border-0 overflow-hidden" style="margin-top: -80px; z-index: 10;">
                    
                    <div class="card-header bg-white text-center py-4 border-bottom-0">
                        <div class="icon-box-sm bg-gradient-primary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center shadow">
                            <i class="{{ $tema->icono ?? 'ti-star' }} text-white h3 mb-0"></i>
                        </div>
                        <h4 class="text-secondary font-weight-bold mb-2" style="font-family: inherit !important;">
                            Tema: {{ $tema->nombre }}
                        </h4>
                        <p class="text-muted small px-4 mb-0">
                            {{ $tema->descripcion }}
                        </p>
                    </div>

                    <div class="card-body p-4 p-md-5 pt-0">
                        <form action="{{ route('lectura.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="idtema" value="{{ $tema->id }}">

                            <div class="mb-4">
                                @error('idtipo_tirada')
                                    <div class="alert alert-danger mb-3" role="alert">
                                        <i class="ti-alert mr-1"></i> {{ $message }}
                                    </div>
                                @enderror
                                <label for="idtipo_tirada" class="h5 text-secondary mb-2 d-block" style="font-family: inherit !important;">
                                    <i class="ti-layers-alt text-primary mr-2"></i> Elige tu Tirada
                                </label>
                                <select name="idtipo_tirada" id="idtipo_tirada" required class="form-control" style="height: 50px;">
                                    <option value="" @if(old('idtipo_tirada')==null) selected @endif disabled>-- Selecciona el método de lectura --</option>
                                    @foreach($tipos as $tipo)
                                    <option value="{{ $tipo->id }}" @if(old('idtipo_tirada')==$tipo->id) selected @endif>
                                        {{ $tipo->nombre }} ({{ $tipo->num_cartas }} cartas)
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-5">
                                @error('pregunta')
                                    <div class="alert alert-danger mb-3">
                                        <i class="ti-alert mr-1"></i> {{ $message }}
                                    </div>
                                @enderror
                                <label for="pregunta" class="h5 text-secondary mb-2 d-block" style="font-family: inherit !important;">
                                    <i class="ti-thought text-primary mr-2"></i> Tu Pregunta al Universo
                                </label>
                                <textarea class="form-control"
                                    minlength="5" maxlength="500" required
                                    id="pregunta" name="pregunta"
                                    placeholder="Escribe aquí tu duda con claridad..."
                                    rows="4" style="height: auto; padding-top: 15px;">{{ old('pregunta') }}</textarea>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg mb-4 px-5 rounded-pill">
                                    <i class="ti-shine mr-2"></i> Revelar Destino
                                </button>

                                <div class="d-block">
                                    <a href="{{ route('main') }}#seccion-temas" class="text-muted hover-text-underline small">
                                        <i class="ti-arrow-left mr-1"></i> Cancelar y volver atrás
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection