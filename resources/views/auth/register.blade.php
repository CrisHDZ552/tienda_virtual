@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center py-5" style="min-height: 75vh;">
    <div class="card shadow-sm border-0 w-100 position-relative" style="max-width: 500px;">
        <a href="{{ route('login') }}" class="btn btn-link text-muted position-absolute top-0 start-0 m-3 text-decoration-none" title="Volver al inicio">
            <i class="fas fa-arrow-left fs-5"></i>
        </a>
        <div class="card-body p-4 p-md-5">
            <div class="text-center mb-4">
                <h2 class="fw-bold mb-1">Crea tu cuenta</h2>
                <p class="text-muted">Regístrate para comenzar a disfrutar</p>
            </div>

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <!-- Drag and Drop para Avatar -->
                <div class="mb-4">
                    <div id="drop-zone" class="border border-2 border-dashed rounded-3 p-4 text-center transition-all" style="cursor: pointer; border-style: dashed !important; border-color: #dee2e6;">
                        <i class="fas fa-cloud-upload-alt fs-2 text-muted mb-2"></i>
                        <p class="mb-0 text-muted small">Arrastra tu avatar aquí o haz clic para seleccionar</p>
                        <input type="file" id="avatar" name="avatar" class="d-none @error('avatar') is-invalid @enderror" accept="image/*">
                    </div>
                    @error('avatar')
                        <span class="text-danger small mt-1 d-block text-center" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                    <div id="preview-container" class="text-center mt-3 d-none">
                        <img id="avatar-preview" src="#" alt="Vista previa" class="rounded-circle object-fit-cover shadow-sm border" style="width: 100px; height: 100px;">
                        <button type="button" id="remove-avatar" class="btn btn-sm btn-outline-danger mt-3 d-block mx-auto rounded-pill px-3">Quitar imagen</button>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Tu nombre">
                    <label for="name">Nombre Completo</label>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="nombre@ejemplo.com">
                    <label for="email">Correo Electrónico</label>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-floating">
                        <input id="codigo_postal" type="text" class="form-control @error('codigo_postal') is-invalid @enderror" name="codigo_postal" value="{{ old('codigo_postal') }}" placeholder="Código Postal">
                        <label for="codigo_postal">Código Postal</label>
                        @error('codigo_postal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="text-end mt-1">
                        <a href="https://www.google.com/search?q=consultar+codigo+postal" target="_blank" class="text-decoration-none small text-muted"><i class="fas fa-search"></i> ¿No sabes tu código postal? Búscalo aquí</a>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Contraseña">
                    <label for="password">Contraseña</label>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-floating mb-4">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar Contraseña">
                    <label for="password-confirm">Confirmar Contraseña</label>
                </div>

                <button type="submit" class="btn btn-dark w-100 py-3 mb-4 rounded-pill fw-bold">
                    Registrarse
                </button>

                @if (Route::has('login'))
                    <div class="text-center mt-3">
                        <p class="text-muted mb-0">¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-decoration-none fw-bold">Inicia sesión aquí</a></p>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('avatar');
        const previewContainer = document.getElementById('preview-container');
        const avatarPreview = document.getElementById('avatar-preview');
        const removeAvatarBtn = document.getElementById('remove-avatar');

        // Abrir el selector de archivos al hacer clic en la zona
        dropZone.addEventListener('click', () => fileInput.click());

        // Prevenir comportamiento por defecto en drag and drop
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        // Efectos visuales al arrastrar
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.add('bg-light');
                dropZone.style.borderColor = '#0d6efd';
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.remove('bg-light');
                dropZone.style.borderColor = '#dee2e6';
            }, false);
        });

        // Manejar el soltado (drop) de archivos
        dropZone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length) {
                fileInput.files = files; // Asignar al input oculto
                updatePreview(files[0]);
            }
        });

        // Manejar la selección manual de archivos
        fileInput.addEventListener('change', function() {
            if (this.files.length) {
                updatePreview(this.files[0]);
            }
        });

        // Mostrar vista previa de la imagen
        function updatePreview(file) {
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    avatarPreview.src = e.target.result;
                    previewContainer.classList.remove('d-none');
                    dropZone.classList.add('d-none');
                };
                reader.readAsDataURL(file);
            }
        }

        // Quitar la imagen seleccionada
        removeAvatarBtn.addEventListener('click', () => {
            fileInput.value = '';
            avatarPreview.src = '#';
            previewContainer.classList.add('d-none');
            dropZone.classList.remove('d-none');
        });
    });
</script>
@endsection
