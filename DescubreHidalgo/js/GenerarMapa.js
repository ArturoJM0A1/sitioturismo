// Variable global para el mapa
var map;
var currentMarker = null;
var currentInfoWindow = null;
var userMarker = null;
var userMarker2Quieto = null;
var directionsService;
var directionsRenderer;
var animating = false;

// Establecer el estilo por defecto del polígono
var defaultPolygonStyle = {
    fillColor: "#B51C40",
    fillOpacity: 0.7,
    strokeColor: '#000000',
    strokeOpacity: 1,
    strokeWeight: 1,
    zIndex: -50
};

// Función para inicializar el mapa
function initMap() {
    // Inicializar el mapa con centro y zoom
    map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 20.4799, lng: -99.2456 },
        zoom: 7
    });

    map.setOptions({ styles: mapStyles });

    // Variable para almacenar el límite del GeoJSON
    var bounds = new google.maps.LatLngBounds();

    // Cargar el GeoJSON y aplicar estilos
    map.data.loadGeoJson('json/Hidalgo.json');

    // Establecer estilos y eventos para los polígonos
    map.data.setStyle(defaultPolygonStyle);
    map.data.addListener('mouseover', function (event) {
        map.data.revertStyle();
        map.data.overrideStyle(event.feature, { fillColor: '#BC955C', fillOpacity: 1 });
    });
    map.data.addListener('mouseout', function (event) {
        map.data.revertStyle();
        map.data.setStyle(defaultPolygonStyle);
    });

    // Listener para mostrar nombre del municipio al hacer clic
    map.data.addListener('click', function (event) {
        var municipalityName = event.feature.getProperty('NOMGEO');
        alert(municipalityName);
    });

    // Listener para ajustar los límites del mapa
    map.data.addListener('addfeature', function (event) {
        event.feature.getGeometry().forEachLatLng(function (latlng) {
            bounds.extend(latlng);
        });
        map.fitBounds(bounds);
    });

    // Inicializar servicios de direcciones y renderer
    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer({
        map: map,
        polylineOptions: {
            strokeColor: '#30ECCC',
            strokeWeight: 5, // Ajusta el grosor de la línea
            strokeOpacity: 0.7, // Ajusta la opacidad de la línea
        },
        zIndex: 100 // Ajustar el z-index para que esté sobre el GeoJSON
    });

    // Cargar datos de los marcadores
    cargarDatosDescubreHidalgo();

    // Evento para el botón trazarRuta
    document.getElementById('trazarRuta').addEventListener('click', function () {
        if (animating) {
            // Si ya se está animando, salir sin hacer nada
            return;
        }
    
        if (currentMarker) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var userPosition = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                if (userMarker) {
                    userMarker.setMap(null);
                }
                userMarker = new google.maps.Marker({
                    position: userPosition,
                    map: map,
                    title: 'Tu ubicación',
                    icon: {
                        url: '../Index/imagenes/locationMap.png',
                        scaledSize: new google.maps.Size(27, 27)
                    }
                });
    
                userMarker2Quieto = new google.maps.Marker({
                    position: userPosition,
                    map: map,
                    title: 'Tu ubicación',
                    icon: {
                        url: '../Index/imagenes/locationMap.png',
                        scaledSize: new google.maps.Size(27, 27)
                    }
                });
    
                map.setCenter(userPosition);
    
                // Deshabilitar el botón mientras se anima la ruta
                document.getElementById('trazarRuta').disabled = true;
    
                trazarRuta(userPosition, currentMarker.getPosition());
            }, function () {
                alert('Error al obtener tu ubicación');
            });
        } else {
            alert('Por favor, selecciona un marcador primero.');
        }
    });
}

