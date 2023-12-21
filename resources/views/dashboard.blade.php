@extends('layout/plantilla')

@section('tituloPagina', 'Dashboard')

@section('contenido')
    @include('partials.nav')
    <p>Bienvenido {{ Auth::user()->name }}!!!</p>

    <h1>Tus Noticias</h1>
    <a href="{{ route("preferencias.edit") }}" class="btn btn-primary">Editar preferencias</a>
    <a href="{{ route("favoritas.index") }}" class="btn btn-primary">Ver favoritas</a>
    <br><br>
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

    @foreach ($noticias as $noticia)
        <div class="card w-100">
            <div class="card-body">
                <a href="{{ route('noticias.show', $noticia->id) }}"><h5 class="card-title">{{ $noticia->titulo }} <span class="badge bg-secondary">({{ $noticia->numlikes }} likes)</span></h5></a>
                <h6 class="card-subtitle mb-2 text-muted">{{ $noticia->fecha }} - {{ $noticia->categoria }}</h6>
                <p class="card-text">{{ $noticia->descripcion }}</p>
                <form action="{{ route('favoritas.store', $noticia->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-success">Agregar a favoritas</button>
                </form>
                <br>
                @if($noticia->like == '')
                    <form action="{{ route('likes.store', $noticia->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-primary">Like</button>
                    </form>
                @else
                    <form action="{{ route('likes.destroy', $noticia->id) }}" method="POST">
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
            {{ $noticias->links() }}
        </div>
    </div>
@endsection