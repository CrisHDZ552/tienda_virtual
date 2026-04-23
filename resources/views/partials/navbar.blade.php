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
                        <li><a class="dropdown-item" href="#">Configuración</a></li>
                        @unlessrole('admin')
                            @unlessrole('verificado')
                                <li><a class="dropdown-item" href="{{ url('solicitud_vendedor') }}">Empezar a Vender</a></li>
                            @endunlessrole
                        @endunlessrole
                        @role('vendedor')
                            <li><a class="dropdown-item" href="/verificar">Verificarte</a></li>
                        @endrole
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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