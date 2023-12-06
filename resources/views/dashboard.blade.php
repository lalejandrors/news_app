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
                <h5 class="card-title">{{ $noticia->titulo }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ $noticia->fecha }} - {{ $noticia->categoria }}</h6>
                <p class="card-text">{{ $noticia->descripcion }}</p>
                <form action="{{ route('favoritas.store', $noticia->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-success">Agregar a favoritas</button>
                </form>
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