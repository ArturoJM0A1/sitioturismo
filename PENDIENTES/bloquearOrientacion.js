window.addEventListener("DOMContentLoaded", function() {
    // Función para forzar la orientación vertical y bloquear la horizontal
    function forceVerticalOrientation() {
        // Si la orientación es horizontal, forzar la orientación vertical
        if (Math.abs(window.orientation) === 90) {
            // Si estamos en orientación horizontal, forzar la orientación vertical
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
                document.documentElement.style.transform = "rotate(-90deg)"; // Rotar -90 grados
                document.documentElement.style.transformOrigin = "top left"; // Establecer el origen de la transformación en la esquina superior izquierda
                document.documentElement.style.width = "100vh";
                document.documentElement.style.height = "100vw";
                document.documentElement.style.overflow = "hidden";
                document.documentElement.style.position = "fixed"; // Cambiar a posición fija para que el contenido se muestre correctamente
                document.documentElement.style.top = "100%"; // Desplazar el contenido hacia abajo para que se muestre completamente
                document.documentElement.style.left = "0"; // Alinear el contenido con la parte superior del área visible
            }
        } else {
            // Restablecer los estilos cuando la orientación es vertical
            document.documentElement.style.transform = "";
            document.documentElement.style.transformOrigin = "";
            document.documentElement.style.position = "";
            document.documentElement.style.top = "";
            document.documentElement.style.left = "";
            document.documentElement.style.width = "";
            document.documentElement.style.height = "";
            document.documentElement.style.overflow = "";
        }
    }

    // Llamar a la función al cargar la página y en cada cambio de orientación
    window.addEventListener("orientationchange", forceVerticalOrientation);

    // Llamar a la función inicialmente para asegurar que los estilos se apliquen correctamente
    forceVerticalOrientation();
});
