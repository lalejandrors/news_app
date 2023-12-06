@extends('layout/plantilla')

@section('tituloPagina', 'Registro')

@section('contenido')
    @include('partials.nav')
    <h1>Registro</h1>
    <br>
    <form method="POST">
        @csrf
        <label>
            <input name="name" class="form-control" type="text" placeholder="Nombre..." required>
        </label><br><br>
        <label>
            <input name="email" class="form-control" type="email" placeholder="Email..." required>
        </label><br><br>
        <label>
            <input name="password" class="form-control" type="password" placeholder="Password..." required>
        </label>
        <br><br>
        <button class="btn btn-primary" type="submit">Registrarme</button>
    </form>
@endsection