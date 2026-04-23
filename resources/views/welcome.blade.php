@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

    <div class="container">
        @unlessrole('admin')
            <div class="text-center mb-5 mt-4">
                <h1 class="fw-bold">No hay productos Disponibles</h1>
                <p class="text-muted">Pronto tendras mejores ofertas</p>
            </div>
        @endunlessrole
    </div>

    @role('admin')
        <div class="container mt-5">
            <h2 class="fw-bold text-center mb-4">Nuestros Usuarios</h2>
            <div class="row justify-content-center">
                @forelse ($users ?? [] as $user)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body text-center">
                                @if($user->avatar)
                                    <img src="{{ asset('image/avatar/' . $user->avatar) }}" alt="Avatar de {{ $user->name }}" class="rounded-circle object-fit-cover mb-3" style="width: 80px; height: 80px;" draggable="false">
                                @else
                                    <span class="rounded-circle d-inline-flex justify-content-center align-items-center bg-secondary text-white mb-3" style="width: 80px; height: 80px; font-size: 24px; font-weight: bold;">
                                        {{ Str::upper(substr($user->name, 0, 1)) }}
                                    </span>
                                @endif

                                @php
                                    $displayRole = 'Comprador';
                                    if ($user->hasRole('admin')) {
                                        $displayRole = 'Administrador';
                                    } elseif ($user->hasRole('verificado') || $user->hasRole('vendedor') || $user->hasRole('seller')) {
                                        $displayRole = 'Vendedor';
                                    }
                                @endphp

                                <h5 class="card-title fw-bold mb-1 d-flex justify-content-center align-items-center gap-1">
                                    {{ $user->name }}
                                    @if($user->hasRole('verificado'))
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-primary" viewBox="0 0 16 16" title="Vendedor Verificado">
                                            <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                                        </svg>
                                    @endif
                                </h5>
                                <p class="mb-1 small fw-bold text-secondary">{{ $displayRole }}</p>
                                <p class="card-text text-muted small">Código Postal: {{ $user->codigo_postal ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No hay usuarios registrados para mostrar.</p>
                    </div>
                @endforelse
            </div>
        </div>
    @endrole
@endsection