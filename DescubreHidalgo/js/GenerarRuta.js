/// Función para trazar una ruta
function trazarRuta(origin, destination) {
    // Marcar que se está animando la ruta
    animating = true;

    // Cerrar el InfoWindow si está abierto
    if (currentInfoWindow) {
        currentInfoWindow.close();
    }

    // Configurar opciones para el renderer de direcciones
    directionsRenderer.setOptions({
        markerOptions: {
            visible: false // Ocultar marcadores de la ruta
        }
    });

    var request = {
        origin: origin,
        destination: destination,
        travelMode: 'DRIVING'
    };
    directionsService.route(request, function (result, status) {
        if (status == 'OK') {
            // Setear la dirección resultante en el renderer
            directionsRenderer.setDirections(result);

            // Animar el marcador del usuario a lo largo de la ruta
            animateUserMarker(result, function() {
                // Obtener el tiempo estimado de llegada y la distancia
                var duration = result.routes[0].legs[0].duration.text;
                var distance = result.routes[0].legs[0].distance.text;

                // Mostrar la alerta con el tiempo estimado de llegada y la distancia
                alert('Tiempo estimado de llegada: ' + duration + '\nDistancia: ' + distance);
            });
        } else {
            alert('Error al trazar la ruta: ' + status);
            // Habilitar el botón en caso de error
            document.getElementById('trazarRuta').disabled = false;
        }
    });
}

// Función para animar el marcador del usuario a lo largo de la ruta
function animateUserMarker(result, callback) {
    var path = result.routes[0].overview_path;
    var step = 0;

    function animatePath() {
        if (step >= path.length) {
            clearInterval(animation);
            animationFinished(callback);
            return;
        }
        userMarker.setPosition(path[step]);
        step++;
    }

    var animation = setInterval(animatePath, 10);

    function animationFinished(callback) {
        userMarker.setMap(null);
        // Marcar que se ha terminado la animación
        animating = false;
        // Habilitar el botón una vez terminada la animación
        document.getElementById('trazarRuta').disabled = false;
        // Llamar al callback
        if (typeof callback === 'function') {
            callback();
        }
    }
}
