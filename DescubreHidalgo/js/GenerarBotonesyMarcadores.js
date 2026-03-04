// Función para cargar los datos desde PHP
function cargarDatosDescubreHidalgo() {
    var xmlhttp = new XMLHttpRequest();
    var url = "consultaMarcadores.php";

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            crearBotones(data);
        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

// Función para crear los botones de marcadores
function crearBotones(data) {
    var botonesMarcadores = document.getElementById('botonesMarcadores');
    botonesMarcadores.innerHTML = '';

    data.forEach(function (item) {
        var button = document.createElement('button');
        button.textContent = item.TituloMarcador;
        button.classList.add('cardboton'); // Añadir la clase 'cardboton'
        button.addEventListener('click', function () {
            mostrarMarcadorEnMapa(item);
        });
        botonesMarcadores.appendChild(button);
    });
}


// Función para mostrar un marcador específico en el mapa
function mostrarMarcadorEnMapa(item) {
    if (currentMarker) {
        currentMarker.setMap(null);
    }
    if (currentInfoWindow) {
        currentInfoWindow.close();
    }

    var positionStr = item.coordenadas.split(",");
    var position = { lat: parseFloat(positionStr[0]), lng: parseFloat(positionStr[1]) };

    currentMarker = new google.maps.Marker({
        position: position,
        map: map,
        title: item.TituloMarcador,
        icon: {
            url: '../Index/imagenes/iconSitioTuristico.png',
            scaledSize: new google.maps.Size(33, 33)
        }
    });

    map.setCenter(position);

    var contentString = '<div class="info-window">' +
        '<h3>' + item.TituloMarcador + '</h3>' +
        '<p>' + item.Descripcion + '</p>' +
        '<img src="../' + item.img + '">' +
        '<a class="cardboton" href="' + item.enlace + '">Enlace</a>'
        '</div>';
    currentInfoWindow = new google.maps.InfoWindow({
        content: contentString
    });

    setTimeout(function () {
        currentInfoWindow.open(map, currentMarker);
    }, 100);
}
 
cargarDatosDescubreHidalgo();
