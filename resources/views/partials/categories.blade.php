<nav class="navbar navbar-expand-md bg-light shadow-sm mb-4 py-1">
    <div class="container-fluid justify-content-center">
        <!-- Botón que funcionará como dropdown en pantallas pequeñas -->
        <button class="navbar-toggler w-100 border-0 text-center rounded-pill py-2 my-1" type="button" data-bs-toggle="collapse" data-bs-target="#categoriesMenu" aria-controls="categoriesMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fs-6 d-flex justify-content-center align-items-center gap-2">Ver Categorías <span class="dropdown-toggle"></span></span>
        </button>

        <!-- Contenedor que colapsará u ocultará las opciones dependiendo el espacio -->
        <div class="collapse navbar-collapse justify-content-center" id="categoriesMenu">
            <ul class="navbar-nav nav-pills justify-content-center py-1 gap-1 gap-lg-2 gap-xl-3 flex-md-nowrap" style="font-size: 0.9rem;">
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle rounded-pill px-3 px-md-1 px-lg-2 px-xl-4 py-2 py-md-1 text-center text-nowrap" href="#" id="todoDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Todo
                    </a>
                    <ul class="dropdown-menu shadow-sm border-0" aria-labelledby="todoDropdown">
                        <li><a class="dropdown-item" href="index">Inicio (Todo)</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="herramientas">Herramientas</a></li>
                        <li><a class="dropdown-item" href="supermercado">Supermercado</a></li>
                        <li><a class="dropdown-item" href="mascotas">Mascotas</a></li>
                        <li><a class="dropdown-item" href="temuPlay">Temu Play</a></li>
                        <li><a class="dropdown-item disabled" href="debug" tabindex="-1" aria-disabled="true">Debug</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-dark rounded-pill px-3 px-md-1 px-lg-2 px-xl-4 py-2 py-md-1 text-center text-nowrap" href="ofertas">Ofertas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-dark rounded-pill px-3 px-md-1 px-lg-2 px-xl-4 py-2 py-md-1 text-center text-nowrap" href="cupones">Cupones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-dark rounded-pill px-3 px-md-1 px-lg-2 px-xl-4 py-2 py-md-1 text-center text-nowrap" href="vender">Vender</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-dark rounded-pill px-3 px-md-1 px-lg-2 px-xl-4 py-2 py-md-1 text-center text-nowrap" href="alimentos">Alimentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-dark rounded-pill px-3 px-md-1 px-lg-2 px-xl-4 py-2 py-md-1 text-center text-nowrap" href="Vehiculos">Vehiculos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-dark rounded-pill px-3 px-md-1 px-lg-2 px-xl-4 py-2 py-md-1 text-center text-nowrap" href="electronica">Electrónica</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-dark rounded-pill px-3 px-md-1 px-lg-2 px-xl-4 py-2 py-md-1 text-center text-nowrap" href="linea_blanca">Línea Blanca</a>
                </li>
            </ul>
        </div>
    </div>
</nav>