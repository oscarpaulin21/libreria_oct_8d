<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesion</title>
</head>
<body>

    @extends('layouts.app')
    @section('content')

    <h1>Inicio de Sesión</h1>

    <form action="{{ route('acceso.store') }}" method = "POST">
    @csrf

    <br>
    <input type="email" name="email" placeholder="Email" class="form-control">
    <br>
    <input type="password" name="password" placeholder="Contraseña" class="form-control">
    <br>
    <button type="submit" class="btn btn-primary">ENVIAR</button>
    </form>

    @endsection
</body>
</html>