<!-- resources/views/errors/403.blade.php -->
@extends('adminlte::page')

@section('title', 'Acceso Denegado')

@section('content_header')
    <h1>Acceso Denegado</h1>
@stop

@section('content')
    <div class="error-page">
        <h2 class="headline text-warning"> 403</h2>
        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! No tienes autorización para esta acción.</h3>
            <p>
                Lo sentimos, pero no tienes los permisos necesarios para acceder a esta página.
                Mientras tanto, puedes regresar al <a href="{{ route('no_autorizado') }}">inicio</a>.
            </p>
        </div>
    </div>
@stop

