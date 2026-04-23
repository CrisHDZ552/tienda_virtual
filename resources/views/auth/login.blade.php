@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 75vh;">
    <div class="card shadow-sm border-0 w-100 position-relative" style="max-width: 450px;">
        <a href="{{ route('welcome') }}" class="btn btn-link text-muted position-absolute top-0 start-0 m-3 text-decoration-none" title="Volver al inicio">
            <i class="fas fa-arrow-left fs-5"></i>
        </a>
        <div class="card-body p-4 p-md-5">
            <div class="text-center mb-4">
                <h2 class="fw-bold mb-1">Bienvenido</h2>
                <p class="text-muted">Inicia sesión en tu cuenta para continuar</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-floating mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="nombre@ejemplo.com">
                    <label for="email">Correo Electrónico</label>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-floating mb-3 position-relative">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña" style="padding-right: 2.5rem;">
                    <label for="password">Contraseña</label>
                    <button type="button" id="toggleBtn" class="btn border-0 position-absolute top-50 end-0 translate-middle-y me-2" style="z-index: 5;" title="Mostrar/Ocultar contraseña">
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </button>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label text-muted" for="remember">
                            Recuérdame
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a class="text-decoration-none small fw-bold" href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

                <button type="submit" class="btn btn-dark w-100 py-3 mb-4 rounded-pill fw-bold">
                    Ingresar
                </button>

                @if (Route::has('register'))
                    <div class="text-center mt-3">
                        <p class="text-muted mb-0">¿No tienes cuenta? <a href="{{ route('register') }}" class="text-decoration-none fw-bold">Regístrate aquí</a></p>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('toggleBtn');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        
        if (toggleBtn && passwordInput && eyeIcon) {
            toggleBtn.addEventListener('click', () => {
                const isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';
                eyeIcon.classList.toggle('fa-eye');
                eyeIcon.classList.toggle('fa-eye-slash');
            });
        }
    });
</script>
@endsection
