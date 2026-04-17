<link id="bootstrap-css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script id="bootstrap-js" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Codigo de Prueba
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof bootstrap === 'undefined') {
            console.error('Framework Bootstrap no se ha cargado correctamente');
        } else {
            console.info('Framework Bootstrap se ha cargado correctamente');
        }
        const testElement = document.createElement('div');
        testElement.className = 'd-none';
        document.body.appendChild(testElement);
        const isCssLoaded = window.getComputedStyle(testElement).display === 'none';
        if (!isCssLoaded) {
            console.warn('El CSS de Bootstrap no se ha cargado correctamente');
        } else {
            console.info('El CSS de Bootstrap se ha cargado correctamente');
        }
        document.body.removeChild(testElement);
    });
</script>