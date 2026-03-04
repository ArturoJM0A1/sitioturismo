document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('CerrarExplorarLugar').addEventListener('click', function () {    
        setTimeout(function() {
            document.getElementById("ventanaExplorarLugar").classList.remove("mostrarVentanaExplorarLugar");
        }, 300);
    });    
});


function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 20.369945129471926, lng: -98.84083386789494 },
        zoom: 9
    });

    map.setOptions({ styles: mapStyles });

    var card = document.getElementById('pac-card');
    var input = document.getElementById('lugar');
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);
    var infowindow = new google.maps.InfoWindow();
    var infowindowContent = document.getElementById('infowindow-content');
    infowindow.setContent(infowindowContent);
    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });

    var selectedPlace = null; // Variable global para almacenar el lugar seleccionado
    var streetViewService = new google.maps.StreetViewService();

    autocomplete.addListener('place_changed', function () {

        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("No se encontró el lugar: '" + place.name + "'");
            return;
        }

        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);

        var address = '';
        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }

        infowindowContent.children['place-icon'].src = place.icon;
        infowindowContent.children['place-name'].textContent = place.name;
        infowindowContent.children['place-address'].textContent = address;
        infowindow.open(map, marker);

        selectedPlace = place; // Almacena el lugar seleccionado


        var latitud = place.geometry.location.lat().toString();
        var longitud = place.geometry.location.lng().toString();
        var coordenadas = latitud + ',' + ' ' + longitud;
        console.log("cordenadas "+coordenadas);
        document.getElementById('coordenadas').value = coordenadas;
    });

    input.addEventListener('keydown', function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            google.maps.event.trigger(input, 'place_changed');
        }
    });

    document.getElementById('explore-button').addEventListener('click', function () {
        if (selectedPlace && selectedPlace.geometry && selectedPlace.geometry.location) {
            document.getElementById("ventanaExplorarLugar").classList.add("mostrarVentanaExplorarLugar");
            streetViewService.getPanorama({ location: selectedPlace.geometry.location, radius: 50 }, function (data, status) {
                if (status === 'OK') {
                    var panorama = new google.maps.StreetViewPanorama(
                        document.getElementById("ExplorarLugar"), {
                        position: selectedPlace.geometry.location,
                        pov: { heading: data.location.heading, pitch: 0 },
                        zoom: 1
                    });
                    map.setStreetView(panorama);
                } else {
                    // Si no hay vista de Street View, busca la vista más cercana y la muestra
                    var streetViewRequest = {
                        location: selectedPlace.geometry.location,
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
            alert('Selecciona un lugar primero. O vuelve a ingresarlo hasta que aparezca el marcador');
        }
    });

}

