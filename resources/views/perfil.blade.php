@extends('layouts.app')

@section('title', 'Perfil')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Mensaje de éxito -->
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white text-center py-3">
                    <h4 class="mb-0 fw-bold">Mi Perfil</h4>
                </div>
                <div class="card-body p-4">
                    @php
                        $displayRole = null;
                        $roleColor = '';
                        if (Auth::user()->hasRole('admin')) {
                            $displayRole = 'Administrador';
                            $roleColor = 'bg-success';
                        } elseif (Auth::user()->hasRole('verificado') || Auth::user()->hasRole('vendedor') || Auth::user()->hasRole('seller')) {
                            $displayRole = 'Vendedor';
                            $roleColor = 'bg-primary';
                        }
                    @endphp

                    <form id="profileForm" method="POST" action="{{ route('perfil.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                @if(Auth::user()->avatar)
                                    <img src="{{ asset('image/avatar/' . Auth::user()->avatar) }}" alt="Avatar" class="rounded-circle object-fit-cover shadow-sm" draggable="false" style="width: 120px; height: 120px;">
                                @else
                                    <span class="rounded-circle d-inline-flex justify-content-center align-items-center bg-secondary text-white shadow-sm" style="width: 120px; height: 120px; font-size: 48px; font-weight: bold;">
                                        {{ Str::upper(substr(Auth::user()->name, 0, 1)) }}
                                    </span>
                                @endif
                                
                                <!-- Input oculto para cambiar la imagen, se muestra al editar -->
                                <div class="mt-3 d-none" id="avatarInputContainer">
                                    <label for="avatar" class="form-label small fw-bold text-muted">Cambiar Avatar</label>
                                    <input class="form-control form-control-sm" type="file" id="avatar" name="avatar" accept="image/*" disabled>
                                </div>
                            </div>
                            @if($displayRole)
                                <div class="mb-3 mt-3">
                                    <span class="badge {{ $roleColor }} px-3 py-2 fs-6 rounded-pill shadow-sm">{{ $displayRole }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Nombre</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" disabled required>
                            @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Correo Electrónico</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" disabled required>
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="codigo_postal" class="form-label fw-bold">Código Postal</label>
                            <input type="text" class="form-control @error('codigo_postal') is-invalid @enderror" id="codigo_postal" name="codigo_postal" value="{{ old('codigo_postal', Auth::user()->codigo_postal) }}" disabled>
                            @error('codigo_postal')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <hr class="my-4">

                        <p class="fw-bold text-muted">Cambiar Contraseña</p>

                        <div class="mb-3">
                            <label for="current_password" class="form-label fw-bold">Contraseña Actual</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" disabled autocomplete="current-password">
                            @error('current_password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Nueva Contraseña</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" disabled autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-bold">Confirmar Nueva Contraseña</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" disabled autocomplete="new-password">
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button type="button" class="btn btn-primary" id="btnModify">
                                Modificar Información
                            </button>
                            <button type="button" class="btn btn-outline-secondary d-none" id="btnCancel">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-success d-none" id="btnSave">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('profileForm');
        const btnModify = document.getElementById('btnModify');
        const btnCancel = document.getElementById('btnCancel');
        const btnSave = document.getElementById('btnSave');
        const inputs = form.querySelectorAll('input');
        const avatarInputContainer = document.getElementById('avatarInputContainer');

        // Función para cambiar el estado de edición
        function toggleEditState(isEditing) {
            inputs.forEach(input => input.disabled = !isEditing);
            avatarInputContainer.classList.toggle('d-none', !isEditing);
            btnModify.classList.toggle('d-none', isEditing);
            btnCancel.classList.toggle('d-none', !isEditing);
            btnSave.classList.toggle('d-none', !isEditing);
        }

        // Eventos de los botones
        btnModify.addEventListener('click', () => toggleEditState(true));
        
        btnCancel.addEventListener('click', () => {
            toggleEditState(false);
            form.reset(); // Restaura los valores originales si se cancela
        });

        // Si la página se recarga por un error de validación, abrir el formulario en modo edición
        @if($errors->any())
            toggleEditState(true);
        @endif
    });
</script>

@endsection