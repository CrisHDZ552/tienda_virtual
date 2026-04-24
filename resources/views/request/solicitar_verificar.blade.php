@extends('layouts.app')

@section('title', 'Solicitar Verificación')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0 fw-bold">Solicitud de Verificación</h4>
                </div>
                <div class="card-body text-center p-5">
                    <h5 class="mb-3">¡Da el siguiente paso!</h5>
                    <p class="text-muted mb-4">Envía tu solicitud de verificación para obtener una insignia de cuenta verificada y acceder a nuevas funciones.</p>
                    <form action="{{ route('verification.request.store') }}" method="POST">
                        @csrf
                        <div class="mb-4 text-start">
                            <label for="reason" class="form-label fw-bold">¿Por qué deberíamos verificar tu cuenta?</label>
                            <textarea class="form-control @error('reason') is-invalid @enderror" id="reason" name="reason" rows="4" required placeholder="Escribe aquí las razones por las que solicitas la verificación..."></textarea>
                            @error('reason')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success px-4 py-2 fw-bold">Enviar Solicitud</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection