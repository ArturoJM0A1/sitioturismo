var carruselEventosExternos = document.getElementById('carruselEventosExternos');

function mostrarMensajeError() {
    carruselEventosExternos.innerHTML =
        `<div class="errormensaje">
            <div>   
                <i class="fa-solid fa-triangle-exclamation"></i>
                <p></p>        
                <i class="fa-solid fa-wrench"></i>
            </div>
        </div>`;
}

function formatearFecha(fechaOriginal) {
    let partesFecha = fechaOriginal.split("-");
    return `${partesFecha[2]}/${partesFecha[1]}/${partesFecha[0]}`;
}

function crearTarjetaEvento(el) {
    let fechaFormateada = formatearFecha(el.fechaInicio);
    let imagenPrincipal = el.imagenPrincipal; // Suponiendo que recibes la ruta de la imagen principal desde el servidor

    return `
        <div class="cardEventosExternos">
            <div class="cardEventosExternos-date"> 
              <p>${fechaFormateada}</p>
              <p>${el.lugar}</p>
            </div>

            <img class="imgTarjetaIndex" src="${imagenPrincipal}" alt="Imagen principal del evento">

            <div class="cardEventosExternos-details"> 
                <div class="contenidoEventoExterno"> 
                  <h2>${el.titulo}</h2>
                      <p>${el.descripcion}</p>
                      <p>${el.horario}</p>
                    <a class="cardboton" href="CompletoEvento.php?id=${el.id}">Leer más</a>
                </div>
            </div>
        </div>
    `; 
}

fetch('Index/php/carruselEventosExternosJson.php')
    .then(response => {
        if (!response.ok) {
            throw new Error(`Error en la solicitud. Estado: ${response.status}`);
        }
        return response.json();
    })
    .then(listaEventos => {
        if (listaEventos.length > 0) {
            var cardsEventos = listaEventos.map(crearTarjetaEvento).join('');
            carruselEventosExternos.insertAdjacentHTML('beforeend', cardsEventos);
        } else {
            console.error("No hay eventos disponibles.");
            mostrarMensajeError();
        }
    })
    .catch(error => {
        if (error.message.includes('404')) {
            console.error("No se encontraron resultados en la base de datos.");
        } else {
            console.error("Error en la solicitud:", error.message);
        }
        mostrarMensajeError();
    });
