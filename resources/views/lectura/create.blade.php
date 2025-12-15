@extends('layouts.app')

@section('content')

<div class="container" style="margin-top: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">

                <div class="card-header bg-dark text-white text-center">
                    <h3><i class="{{ $tema->icono ?? 'ti-star' }}"></i> Consulta: {{ $tema->nombre }}</h3>
                    <small>{{ $tema->descripcion }}</small>
                </div>

                <div class="card-body">

                    <form action="{{ route('lectura.store') }}" method="post">
                        @csrf

                        <input type="hidden" name="idtema" value="{{ $tema->id }}">

                        <div class="form-group mb-4"> @error('idtipo_tirada')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror

                            <label for="idtipo_tirada" class="fw-bold">Elige tu Tirada:</label>

                            <select name="idtipo_tirada" id="idtipo_tirada" required class="form-control">
                                <option value="" @if(old('idtipo_tirada')==null) selected @endif disabled>-- Selecciona cómo leer las cartas --</option>

                                @foreach($tipos as $tipo)
                                <option value="{{ $tipo->id }}" @if(old('idtipo_tirada')==$tipo->id) selected @endif>
                                    {{ $tipo->nombre }} ({{ $tipo->num_cartas }} cartas)
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-4">

                            @error('pregunta')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror

                            <label for="pregunta" class="fw-bold">Tu Pregunta al Universo:</label>

                            <textarea class="form-control"
                                minlength="5"
                                maxlength="500"
                                required
                                id="pregunta"
                                name="pregunta"
                                placeholder="Concéntrate y escribe aquí..."
                                rows="5">{{ old('pregunta') }}</textarea>
                        </div>

                        <div class="form-group text-center">
                            <input class="btn btn-primary btn-lg" value="Revelar Destino" type="submit">

                            <a href="{{ route('home') }}" class="btn btn-link text-secondary">Cancelar</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection