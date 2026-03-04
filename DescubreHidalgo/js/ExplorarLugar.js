document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('CerrarExplorarLugar').addEventListener('click', function () {
        setTimeout(function () {
            document.getElementById("ventanaExplorarLugar").classList.remove("mostrarVentanaExplorarLugar");
        }, 300);
    });
});

// Función para explorar el lugar del marcador en turno
document.getElementById('explore-button').addEventListener('click', function () {
    if (currentMarker) {
        document.getElementById("ventanaExplorarLugar").classList.add("mostrarVentanaExplorarLugar");

        var streetViewService = new google.maps.StreetViewService();
        var selectedPlace = currentMarker.getPosition();

        streetViewService.getPanorama({ location: selectedPlace, radius: 50 }, function (data, status) {
            if (status === 'OK') {
                var panorama = new google.maps.StreetViewPanorama(
                    document.getElementById("ExplorarLugar"), {
                        position: selectedPlace,
                        pov: { heading: data.location.heading, pitch: 0 },
                        zoom: 1
                    });
                map.setStreetView(panorama);
            } else {
                // Si no hay vista de Street View, busca la vista más cercana y la muestra
                var streetViewRequest = {
                    location: selectedPlace,
                    radius: 1000, // Buscar dentro de un radio de 1 km
                    preference: google.maps.StreetViewPreference.NEAREST
                };
                streetViewService.getPanorama(streetViewRequest, function (data, status) {
                    if (status === 'OK') {
                        var panorama = new google.maps.StreetViewPanorama(
                            document.getElementById("ExplorarLugar"), {
                                position: data.location.latLng,
                                pov: { heading: data.location.heading, pitch: 0 },
                                zoom: 1
                            });
                        map.setStreetView(panorama);
                    } else {
                        alert('No hay vista de Street View disponible cerca de este lugar.');
                    }
                });
            }
        });
    } else {
        alert('Por favor, selecciona un marcador primero.');
    }
});
