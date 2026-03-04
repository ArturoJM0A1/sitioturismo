function initMap() {
  var cordenadasEventoStr = document.getElementById('cordenadasEvento').innerHTML;
  var cordenadasEventoArr = cordenadasEventoStr.split(', ');
  var cordenadasEvento = {
    lat: parseFloat(cordenadasEventoArr[0]),
    lng: parseFloat(cordenadasEventoArr[1])
  };

  var map = new google.maps.Map(document.getElementById('map'), {
    center: cordenadasEvento,
    zoom: 10
  });

  map.setOptions({ styles: mapStyles });

  var streetViewService = new google.maps.StreetViewService(); // Definimos streetViewService

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) {
      var userLocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      var userMarker1 = new google.maps.Marker({
        position: userLocation,
        map: map,
        title: 'Tu ubicación',
        icon: {
          url: 'Index/imagenes/locationMap.png',
          scaledSize: new google.maps.Size(28, 30)
        }
      });

      var userMarker2Quieto = new google.maps.Marker({
        position: userLocation,
        map: map,
        title: 'Tu ubicación',
        icon: {
          url: 'Index/imagenes/locationMap.png',
          scaledSize: new google.maps.Size(28, 30)
        }
      });

      var eventoMarker = new google.maps.Marker({
        position: cordenadasEvento,
        map: map,
        title: 'Evento',
        icon: {
          url: 'Index/imagenes/iconEvento.png',
          scaledSize: new google.maps.Size(43, 43)
        }
      });

      var directionsService = new google.maps.DirectionsService();
      var directionsDisplay = new google.maps.DirectionsRenderer({
        suppressMarkers: true,
        polylineOptions: {
          strokeColor: '#30ECCC',
          strokeWeight: 5, // Ajusta el grosor de la línea
          strokeOpacity: 0.7, // Ajusta la opacidad de la línea
        }
      });
      directionsDisplay.setMap(map);

      var request = {
        origin: userLocation,
        destination: cordenadasEvento,
        travelMode: 'DRIVING'
      };

      directionsService.route(request, function (result, status) {
        if (status == 'OK') {
          var route = result.routes[0];
          var duration = route.legs[0].duration.text;
          var distance = route.legs[0].distance.text;
          document.getElementById('info').innerHTML = 'Tiempo estimado de llegada: ' + duration + '<br>Distancia: ' + distance;

          var path = result.routes[0].overview_path;
          var step = 0;

          function animatePath() {
            if (step >= path.length) {
              clearInterval(animation);
              animationFinished();
              return;
            }
            userMarker1.setPosition(path[step]);
            step++;
          }

          var animation = setInterval(animatePath, 5);
          directionsDisplay.setDirections(result);
        }

        function animationFinished() {
          userMarker1.setMap(null);
        }
      });
    });
  }

  document.getElementById('explore-button').addEventListener('click', function () {
    if (cordenadasEvento) {
        document.getElementById("ventanaExplorarLugar").classList.add("mostrarVentanaExplorarLugar");

        streetViewService.getPanorama({ location: cordenadasEvento, radius: 50 }, function (data, status) {
            if (status === 'OK') {
                var panorama = new google.maps.StreetViewPanorama(
                    document.getElementById("ExplorarLugar"), {
                    position: cordenadasEvento,
                    pov: { heading: data.location.heading, pitch: 0 },
                    zoom: 1
                });
                map.setStreetView(panorama);
            } else {
                var streetViewRequest = {
                    location: cordenadasEvento,
                    radius: 1000, 
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
        alert('Las coordenadas del evento no están definidas.');
    }
  });
}

document.getElementById('CerrarExplorarLugar').addEventListener('click', function () {
  document.getElementById("ventanaExplorarLugar").classList.remove("mostrarVentanaExplorarLugar");
});

