@extends('layout/plantilla')

@section('tituloPagina', 'Login')

@section('contenido')
    @include('partials.nav')
    <h1>Login</h1>
    <br>
    <form method="POST">
        @csrf
        <label>
            <input name="email" class="form-control" type="email" placeholder="Email..." required>
        </label><br><br>
        <label>
            <input name="password" class="form-control" type="password" placeholder="Password..." required>
        </label>
        <br><br>
        <button class="btn btn-primary" type="submit">Login</button>
    </form>
@endsection