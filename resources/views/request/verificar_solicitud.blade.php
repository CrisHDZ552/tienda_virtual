@extends('layouts.app')

@section('title', 'Gestionar Solicitudes de Verificación')

@section('content')

<div class="container mt-5">
    <h2 class="mb-4 fw-bold text-center">Gestión de Solicitudes de Verificación</h2>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Filtros y Búsqueda -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('verificar_solicitud') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label for="search" class="form-label fw-bold">Buscar Usuario</label>
                    <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Nombre o correo electrónico...">
                </div>
                <div class="col-md-4">
                    <label for="status" class="form-label fw-bold">Estado de la Solicitud</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Todos los estados</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pendientes de Revisión</option>
                        <option value="accepted" {{ request('status') === 'accepted' ? 'selected' : '' }}>Aceptados</option>
                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rechazados</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100 fw-bold">
                        Buscar y Filtrar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Resultados (Tarjetas) -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
        @forelse ($requests as $req)
            <div class="col">
                <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                    <div class="card-header bg-transparent border-bottom-0 pt-4 pb-2 d-flex justify-content-between align-items-start">
                        <div class="d-flex align-items-center">
                            @if($req->user->avatar)
                                <img src="{{ asset('image/avatar/' .  $req->user->avatar) }}" alt="Avatar" class="rounded-circle object-fit-cover me-3 shadow-sm" style="width: 48px; height: 48px;" draggable="false">
                            @else
                                <span class="rounded-circle d-inline-flex justify-content-center align-items-center bg-primary text-white me-3 shadow-sm" style="width: 48px; height: 48px; font-size: 18px; font-weight: bold;">
                                    {{ Str::upper(substr($req->user->name, 0, 1)) }}
                                </span>
                            @endif
                            <div>
                                <h6 class="mb-0 fw-bold text-dark text-truncate d-flex align-items-center" style="max-width: 150px;" title="{{ $req->user->name }}">
                                    {{ $req->user->name }}
                                    @if($req->user->hasRole('verificado'))
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#0d6efd" class="bi bi-patch-check-fill ms-1 flex-shrink-0" viewBox="0 0 16 16" title="Cuenta Verificada">
                                            <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                                        </svg>
                                    @endif
                                </h6>
                                <small class="text-muted d-block text-truncate" style="max-width: 150px;" title="{{ $req->user->email }}">{{ $req->user->email }}</small>
                            </div>
                        </div>
                        <div>
                            @if (is_null($req->status))
                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill shadow-sm">Pendiente</span>
                            @elseif ($req->status == 1)
                                <span class="badge bg-success px-3 py-2 rounded-pill shadow-sm">Aceptado</span>
                            @elseif ($req->status == 0)
                                <span class="badge bg-danger px-3 py-2 rounded-pill shadow-sm">Rechazado</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="text-uppercase text-muted small fw-bold mb-2">Motivo de la solicitud</h6>
                        <p class="card-text text-secondary mb-0" style="font-size: 0.95rem;">
                            {{ Str::limit($req->reason, 150) }}
                        </p>
                    </div>
                    <div class="card-footer bg-light border-top d-flex justify-content-between align-items-center py-3">
                        <small class="text-muted fw-semibold">
                            Fecha: {{ $req->created_at->format('d/m/Y - H:i') }}
                        </small>
                        @if (is_null($req->status))
                            <div class="d-flex gap-2">
                                <form action="{{ route('verification.request.update', $req->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="1">
                                    <button type="submit" class="btn btn-sm btn-success fw-bold d-flex align-items-center" title="Aceptar Solicitud">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/>
                                        </svg>
                                    </button>
                                </form>
                                <form action="{{ route('verification.request.update', $req->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="0">
                                    <button type="submit" class="btn btn-sm btn-danger fw-bold d-flex align-items-center" title="Rechazar Solicitud">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body text-center py-5 text-muted">
                        <h5 class="fw-bold">No se encontraron solicitudes</h5>
                        <p class="mb-0">No hay solicitudes con los criterios de búsqueda actuales.</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    @if($requests->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $requests->withQueryString()->links() }}
    </div>
    @endif
</div>

@endsection
