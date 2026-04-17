<?php
    include 'head.php';
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index">
            <img src="/tceyorP/assets/image/image_logo/logo_Temu.png" alt="Logo original" height="24">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse align-items-center text-center" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-center">
                <li class="nav-item">
                    <a class="nav-link active text-center" aria-current="page" href="codigo_postal">Ubicación de Entrega: Desconocido</a>
                </li>
            </ul>
            <form class="d-flex mx-auto my-2 my-lg-0 w-100 w-lg-50 justify-content-center">
                <input class="form-control me-2" type="search" placeholder="Buscar en Temu.org" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
            <a href="sesion" class="btn btn-outline-light ms-lg-3 mt-3 mt-lg-0 text-nowrap">Iniciar sesión</a>
        </div>
    </div>
</nav>
<script>
    // Codigo de Prueba para el Navbar
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof bootstrap !== 'undefined' && typeof bootstrap.Collapse !== 'undefined') {
            console.info('Navbar está disponible');
        } else {
            console.error('Navbar no se ha cargado correctamente');
        }
        const myNavbar = document.querySelector('.navbar');
        if (myNavbar) {
            const navStyle = window.getComputedStyle(myNavbar);
            if (navStyle.display === 'flex' && navStyle.position === 'relative') {
                console.info('El CSS del Navbar se ha cargado y aplicado correctamente');
            } else {
                console.warn('El CSS del Navbar no se está aplicando como se esperaba');
            }
        } else {
            console.error('No se encontró el elemento Navbar en el DOM');
        }
    });
</script>