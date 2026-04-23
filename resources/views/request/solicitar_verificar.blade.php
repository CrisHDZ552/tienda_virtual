@extends('layouts.app')

@section('title', 'Solicitar Verificación')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0 fw-bold">Solicitud de Verificación</h4>
                </div>
                <div class="card-body text-center p-5">
                    <h5 class="mb-3">¡Da el siguiente paso!</h5>
                    <p class="text-muted mb-4">Envía tu solicitud de verificación para obtener una insignia de cuenta verificada y acceder a nuevas funciones.</p>
                    {{-- You will need to create this route and the corresponding controller action --}}
                    <form action="{{-- route('verification.request.store') --}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success px-4 py-2 fw-bold">Enviar Solicitud</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection