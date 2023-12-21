@extends('layout/plantilla')

@section('tituloPagina', '')

@section('contenido')
    @include('partials.nav')
    <h1>{{ $noticia->titulo }}</h1>

    <div class="row">
        <div class="col-sm-12">
            @if($mensaje = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $mensaje }}
                </div>
            @endif
        </div>
    </div>

    <div class="card w-100">
        <div class="card-body">
            <h6 class="card-subtitle mb-2 text-muted">{{ $noticia->fecha }} - {{ $noticia->categoria }} <span class="badge bg-secondary">({{ $noticia->numlikes }} likes)</span></h6>
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
            <br>
            <form action="{{ route('comentarios.store', $noticia->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <textarea class="form-control" id="comentario" name="comentario" rows="3" placeholder="Escribe tu comentario..." required></textarea>
                </div>
                <button class="btn btn-primary">Agregar comentario</button>
            </form>
            <br>
            <h5>Comentarios</h5>
            @foreach ($comentarios as $comentario)
                <div class="card">
                    <div class="card-header">
                        {{ $comentario->usuario }}
                    </div>
                    <div class="card-body">
                    <h6 class="card-title">{{ $comentario->created_at }}</h6>
                    <p class="card-text">{{ $comentario->comentario }}</p>
                    </div>
                </div>
            @endforeach
            <hr>
            <div class="row">
                <div class="col-sm-12">
                    {{ $comentarios->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection