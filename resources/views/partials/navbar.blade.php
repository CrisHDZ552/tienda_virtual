<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('image/image_logo/image_logo/logo_Temu.png') }}" alt="Logo original" height="24" draggable="false">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse align-items-center text-center" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-center">
                <li class="nav-item">
                    <a class="nav-link active text-center" aria-current="page" href="codigo_postal">
                        <span class="text-nowrap">Ubicación de Entrega:</span>
                        <span class="d-block fw-bold">
                            @auth
                                {{ Auth::user()->codigo_postal ?? 'Desconocido' }}
                            @else
                                Desconocido
                            @endauth
                        </span>
                    </a>
                </li>
            </ul>
            <form class="d-flex mx-auto my-2 my-lg-0 w-100 w-lg-50 justify-content-center">
                <input class="form-control me-2" type="search" placeholder="Buscar en Temu.org" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
            <a href="sesion" class="btn btn-outline-light ms-2 mt-3 mt-lg-0 d-flex align-items-center" title="Carrito de compras">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
            </a>
            @auth
            <div class="dropdown ms-lg-3 mt-3 mt-lg-0">
                <button class="btn btn-outline-light position-relative d-flex align-items-center justify-content-center" type="button" id="notificationMenu" data-bs-toggle="dropdown" aria-expanded="false" style="width: 40px; height: 40px; border-radius: 50%;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                    </svg>
                    @if(auth()->user()->unreadNotifications->count() > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.65rem;">
                            {{ auth()->user()->unreadNotifications->count() }}
                            <span class="visually-hidden">mensajes no leídos</span>
                        </span>
                    @endif
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2" aria-labelledby="notificationMenu" style="min-width: 300px;">
                    <li class="dropdown-header fw-bold">Notificaciones</li>
                    @forelse(auth()->user()->unreadNotifications as $notification)
                        <li>
                            <a class="dropdown-item text-wrap py-2 border-bottom" href="{{ url('/notificaciones/leer/' . $notification->id) }}">
                                <div>{{ $notification->data['message'] ?? 'Nueva notificación' }}</div>
                                <small class="text-muted" style="font-size: 0.75rem;">{{ $notification->created_at->diffForHumans() }}</small>
                            </a>
                        </li>
                    @empty
                        <li><span class="dropdown-item text-muted py-3 text-center">No tienes notificaciones nuevas.</span></li>
                    @endforelse
                    @if(auth()->user()->unreadNotifications->count() > 0)
                        <li><a class="dropdown-item text-center text-primary py-2" href="{{ url('/notificaciones/marcar-todas') }}">Marcar todas como leídas</a></li>
                    @endif
                </ul>
            </div>
                <div class="dropdown ms-lg-3 mt-3 mt-lg-0">
                    <a href="#" class="d-flex align-items-center text-decoration-none" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('image/avatar/' . Auth::user()->avatar) }}" alt="Avatar" class="rounded-circle object-fit-cover" style="width: 40px; height: 40px;">
                        @else
                            <span class="rounded-circle d-inline-flex justify-content-center align-items-center bg-secondary text-white" style="width: 40px; height: 40px; font-size: 14px; font-weight: bold;">
                                {{ Str::upper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2" aria-labelledby="userMenu">
                        <li><a class="dropdown-item" href="{{ url('perfil') }}">Perfil</a></li>
                        <li><a class="dropdown-item mt-3" href="#">Configuración</a></li>
                        @role('customer')
                            <li><a class="dropdown-item mt-3" href="{{ url('solicitud_vendedor') }}">Empezar a Vender</a></li>
                        @endrole
                        @role('vendedor')
                            <li><a class="dropdown-item mt-3" href="/verificar">Verificarte</a></li>
                        @endrole
                        @role('admin')
                            <li><a class="dropdown-item mt-3" href="/verificar_solicitud">Gestionar Verificaciones</a></li>
                        @endrole
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger mt-3" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light ms-lg-3 mt-3 mt-lg-0 text-nowrap">Iniciar sesión</a>
            @endauth
        </div>
    </div>
</nav>