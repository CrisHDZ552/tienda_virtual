@extends('layouts.app')

@section('title', 'Página no encontrada')

@section('content')
<html>
    <body>
        <div class="container d-flex flex-column align-items-center justify-content-center text-center" style="min-height: 70vh;">
            <?php if (mt_rand(1, 100) <= 1): ?>
                <img src="{{ asset('image/errors/dog_maraca.gif') }}" alt="Dog_english" class="mb-4" style="max-width: 200px;" draggable="false">
            <?php else: ?>
                <img src="{{ asset('image/errors/dog_sleep.gif') }}" alt="Dog_english" class="mb-4" style="max-width: 250px;" draggable="false">
            <?php endif; ?>
            <h1 class="display-1 fw-bold text-danger">404</h1>
            <h2 class="mb-4">¡Oops! Página no encontrada</h2>
            <p class="lead mb-4 text-muted">
                Lo sentimos, la página que estás buscando no existe, ha sido movida o está temporalmente inaccesible.
            </p>
            <a href="javascript:history.back()" class="btn btn-dark btn-lg px-4 rounded-pill">Volver</a>
        </div>
    </body>
</html>
@endsection