var carruselNoticias = document.getElementById('carruselNoticias');

function mostrarError() {
    carruselNoticias.innerHTML =
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

function crearCardNoticia(el) {
    let fechaFormateada = formatearFecha(el.fecha);

    return `
        <div class="cardNoticia">
            <p class="TitulodelaNoticia">${el.titulo}</p>
            <p class="FechadelaNoticia">${fechaFormateada}</p>
            <img class="imgTarjetaIndex" src="${el.img}">
            <p class="textNoticia">${el.descripcion}</p>
            <a class="cardboton" href="CompletaNoticia.php?id=${el.id}">Leer más</a>
        </div>
    `;
}

fetch('Index/php/carruselNoticiasJson.php')
    .then(response => {
        if (!response.ok) {
            throw new Error(`Error en la solicitud. Estado: ${response.status}`);
        }
        return response.json();
    })
    .then(listaNoticias => {
        if (listaNoticias.length > 0) {
            var cardsNoticias = listaNoticias.map(crearCardNoticia).join('');
            carruselNoticias.insertAdjacentHTML('beforeend', cardsNoticias);
        } else {
            console.error("No hay noticias disponibles.");
            mostrarError();
        }
    })
    .catch(error => {
        if (error.message.includes('404')) {
            console.error("No se encontraron resultados en la base de datos.");
        } else {
            console.error("Error en la solicitud:", error.message);
        }
        mostrarError();
    });
