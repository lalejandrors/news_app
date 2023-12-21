@extends('layout/plantilla')

@section('tituloPagina', 'Favoritas')

@section('contenido')
    @include('partials.nav')

    <h1>Tus Favoritas</h1>
    <br>
    <div class="row">
        <div class="col-sm-12">
            @if($mensaje = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $mensaje }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            @if($mensaje = Session::get('warning'))
                <div class="alert alert-warning" role="alert">
                    {{ $mensaje }}
                </div>
            @endif
        </div>
    </div>
    <br>
    @foreach ($favoritas as $favorita)
        <div class="card w-100">
            <div class="card-body">
                <a href="{{ route('noticias.show', $favorita->id) }}"><h5 class="card-title">{{ $favorita->titulo }} <span class="badge bg-secondary">({{ $favorita->numlikes }} likes)</span></h5></a>
                <h6 class="card-subtitle mb-2 text-muted">{{ $favorita->fecha }} - {{ $favorita->categoria }}</h6>
                <p class="card-text">{{ $favorita->descripcion }}</p>
                <form action="{{ route('favoritas.destroy', $favorita->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Eliminar de favoritas</button>
                </form>
                <br>
                @if($favorita->like == '')
                    <form action="{{ route('likes.store', $favorita->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-primary">Like</button>
                    </form>
                @else
                    <form action="{{ route('likes.destroy', $favorita->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-warning">Dislike</button>
                    </form>
                @endif
            </div>
        </div>
        <br>
    @endforeach
    <hr>
    <div class="row">
        <div class="col-sm-12">
            {{ $favoritas->links() }}
        </div>
    </div>
@endsection