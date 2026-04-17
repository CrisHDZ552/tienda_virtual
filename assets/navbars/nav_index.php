<nav class="navbar navbar-expand-md bg-light shadow-sm mb-4 py-1">
    <div class="container-fluid justify-content-center">
        <!-- Botón que funcionará como dropdown en pantallas pequeñas -->
        <button class="navbar-toggler w-100 border-0 text-center rounded-pill py-2 my-1" type="button" data-bs-toggle="collapse" data-bs-target="#categoriesMenu" aria-controls="categoriesMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fs-6 d-flex justify-content-center align-items-center gap-2">Ver Categorías <span class="dropdown-toggle"></span></span>
        </button>

        <!-- Contenedor que colapsará u ocultará las opciones dependiendo el espacio -->
        <div class="collapse navbar-collapse justify-content-center" id="categoriesMenu">
            <ul class="navbar-nav nav-pills justify-content-center py-1 gap-1 gap-md-2 gap-lg-3 flex-nowrap overflow-auto" style="font-size: 0.9rem;">
                <li class="nav-item">
                    <a class="nav-link active rounded-pill px-3 px-md-4 py-1 text-center text-nowrap" aria-current="page" href="index">Todo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-dark rounded-pill px-3 px-md-4 py-1 text-center text-nowrap" href="vender">Vender</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-dark rounded-pill px-3 px-md-4 py-1 text-center text-nowrap" href="alimentos">Alimentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-dark rounded-pill px-3 px-md-4 py-1 text-center text-nowrap" href="Vehiculos">Vehiculos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-dark rounded-pill px-3 px-md-4 py-1 text-center text-nowrap" href="electronica">Electrónica</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-dark rounded-pill px-3 px-md-4 py-1 text-center text-nowrap" href="linea_blanca">Línea Blanca</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-dark rounded-pill px-3 px-md-4 py-1 text-center text-nowrap" href="herramientas">Herramientas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-dark rounded-pill px-3 px-md-4 py-1 text-center text-nowrap" href="mascotas">Mascotas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled rounded-pill px-3 px-md-4 py-1 text-center text-nowrap" href="debug" tabindex="-1" aria-disabled="true">Debug</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
