@extends('layout/plantilla')

@section('tituloPagina', 'Ediar preferencias')

@section('contenido')
    @include('partials.nav')
    <h1>Tus Preferencias</h1>

    <form action="{{ route('preferencias.update') }}" method="POST">
        @csrf
        @method("PUT")
        @foreach ($categorias as $categoria)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="preferencia[]" value="{{ $categoria->id }}">
                <label class="form-check-label">
                    {{ $categoria->nombre }}
                </label>
            </div>
        @endforeach
        <br>
        <button class="btn btn-primary">Actualizar</button>
    </form>
@endsection