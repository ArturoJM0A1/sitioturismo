var variablesAreasGeograficas = {}; // Variable que almacenará los nombres de las áreas geográficas

function obtenerAreasGeograficas(url, filtroareageograficaDiv) {
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error de red: ${response.status}`);
            }
            return response.json();
        })
        .then(opciones => {
            opciones.forEach(opcion => {
                // Limpia espacios en el nombre y convierte a minúsculas
                var idBoton = 'btn' + opcion.nombre.replace(/\s/g, '').toLowerCase();

                var nombreAreaGeografica = opcion.nombre;
                variablesAreasGeograficas[idBoton] = nombreAreaGeografica;

                // Crea el botón
                var boton = document.createElement('button');
                boton.id = idBoton;
                boton.className = 'optionList';
                boton.innerText = opcion.nombre;

                filtroareageograficaDiv.appendChild(boton); // Agrega el botón al div 

                boton.addEventListener('click', function () {
                    var nombreAreaGeografica = variablesAreasGeograficas[idBoton];
                    window.location.href = `?AreaGeografica=${encodeURIComponent(nombreAreaGeografica)}&showAreaGeografica=true`;
                });
            });
        })
        .catch(error => {
            console.error('Error al obtener opciones:', error);
        });
}

// Pasar valores a la función
var filtroareageograficaDiv = document.getElementById("filtroareageografica");
obtenerAreasGeograficas("getCategoriasVisibles/categoriaareaGeografica.php", filtroareageograficaDiv);


/////////////////////////////////////////////////////////////////////

var variablesMunicipios = {}; //Variable que almacena todos los nombres de municipios

function obtenerMunicipios(url, filtromunicipioDiv) {
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error de red: ${response.status}`);
            }
            return response.json();
        })
        .then(opciones => {
            opciones.forEach(opcion => {
                // Limpia espacios en el nombre y convierte a minúsculas
                var idBoton = 'btn' + opcion.nombre.replace(/\s/g, '').toLowerCase();

                var nombreMunicipio = opcion.nombre;
                variablesMunicipios[idBoton] = nombreMunicipio;

                // Crea el botón
                var boton = document.createElement('button');
                boton.id = idBoton;
                boton.className = 'optionList';
                boton.innerText = opcion.nombre;

                filtromunicipioDiv.appendChild(boton); // Agrega el botón al div 

                boton.addEventListener('click', function () {
                    var nombreMunicipio = variablesMunicipios[idBoton];
                    window.location.href = `?Municipio=${encodeURIComponent(nombreMunicipio)}&showMunicipio=true`;
                });
            });
        })
        .catch(error => {
            console.error('Error al obtener opciones:', error);
        });
}

// Pasar valores a la funcion
var filtromunicipioDiv = document.getElementById("filtromunicipio");
obtenerMunicipios("getCategoriasVisibles/categoriaMunicipio.php", filtromunicipioDiv);

/////////////////////////////////////////////////////////////////////

var variablesAños = {}; // Variable que almacena todos los años de noticias

function obtenerAños(url, filtroAñoDiv) {
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error de red: ${response.status}`);
            }
            return response.json();
        })
        .then(años => {
            años.forEach(opcion => {
                // Crea el botón
                var boton = document.createElement('button');
                boton.id = 'btn' + opcion.año;
                boton.className = 'optionList';
                boton.innerText = opcion.año;

                filtroAñoDiv.appendChild(boton); // Agrega el botón al div 

                variablesAños[boton.id] = opcion.año;

                boton.addEventListener('click', function () {
                    var añoSeleccionado = variablesAños[boton.id];
                    window.location.href = `?Anio=${encodeURIComponent(añoSeleccionado)}&showAnio=true`;
                });
            });
        })
        .catch(error => {
            console.error('Error al obtener años:', error);
        });
}

// Pasar valores a la función
var filtroAñoDiv = document.getElementById("filtroanios");
obtenerAños("getCategoriasVisibles/categoriaAnio.php", filtroAñoDiv);

/////////////////////////////////////////////////////////////////////

var variablesLugares = {}; //Variable que almacena todos los nombres de los lugares

function obtenerLugares(url, filtrolugaresDiv) {
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error de red: ${response.status}`);
            }
            return response.json();
        })
        .then(opciones => {
            opciones.forEach(opcion => {
                // Limpia espacios en el nombre y convierte a minúsculas
                var idBoton = 'btn' + opcion.nombre.replace(/\s/g, '').toLowerCase();

                var nombreLugar = opcion.nombre;
                variablesLugares[idBoton] = nombreLugar;

                // Crea el botón
                var boton = document.createElement('button');
                boton.id = idBoton;
                boton.className = 'optionList';
                boton.innerText = opcion.nombre;

                filtrolugaresDiv.appendChild(boton); // Agrega el botón al div 

                boton.addEventListener('click', function () {
                    var nombreLugar = variablesLugares[idBoton];
                    window.location.href = `?Lugar=${encodeURIComponent(nombreLugar)}&showLugar=true`;
                });
            });
        })
        .catch(error => {
            console.error('Error al obtener opciones:', error);
        });
}

// Pasar valores a la funcion
var filtrolugaresDiv = document.getElementById("filtrolugares");
obtenerLugares("getCategoriasVisibles/categoriaLugar.php", filtrolugaresDiv);



/////////////////////////////////////////////////////////////////////

var variablesActividades = {}; //Variable que almacena todos los nombres de las actividades

function obtenerActividades(url, filtroactividades) {
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error de red: ${response.status}`);
            }
            return response.json();
        })
        .then(opciones => {
            opciones.forEach(opcion => {
                // Limpia espacios en el nombre y convierte a minúsculas
                var idBoton = 'btn' + opcion.nombre.replace(/\s/g, '').toLowerCase();

                var nombreactividad = opcion.nombre;
                variablesActividades[idBoton] = nombreactividad;

                // Crea el botón
                var boton = document.createElement('button');
                boton.id = idBoton;
                boton.className = 'optionList';
                boton.innerText = opcion.nombre;

                filtroactividades.appendChild(boton); // Agrega el botón al div 

                boton.addEventListener('click', function () {
                    var nombreactividad = variablesActividades[idBoton];
                    window.location.href = `?Actividad=${encodeURIComponent(nombreactividad)}&showActividad=true`;
                });
            });
        })
        .catch(error => {
            console.error('Error al obtener opciones:', error);
        });
}

// Pasar valores a la funcion
var filtroactividades = document.getElementById("filtroactividades");
obtenerActividades("getCategoriasVisibles/categoriaActividad.php", filtroactividades);




/////////////////////////////////////////////////////////////////////

var variablesEventos = {}; //Variable que almacena todos los nombres de las actividades

function obtenerEventos(url, filtroeventos) {
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error de red: ${response.status}`);
            }
            return response.json();
        })
        .then(opciones => {
            opciones.forEach(opcion => {
                // Limpia espacios en el nombre y convierte a minúsculas
                var idBoton = 'btn' + opcion.nombre.replace(/\s/g, '').toLowerCase();

                var nombreEventos = opcion.nombre;
                variablesEventos[idBoton] = nombreEventos;

                // Crea el botón
                var boton = document.createElement('button');
                boton.id = idBoton;
                boton.className = 'optionList';
                boton.innerText = opcion.nombre;

                filtroeventos.appendChild(boton); // Agrega el botón al div 

                boton.addEventListener('click', function () {
                    var nombreEventos = variablesEventos[idBoton];
                    window.location.href = `?Evento=${encodeURIComponent(nombreEventos)}&showEvento=true`;
                });
            });
        })
        .catch(error => {
            console.error('Error al obtener opciones:', error);
        });
}

// Pasar valores a la funcion
var filtroeventos = document.getElementById("filtroeventos");
obtenerEventos("getCategoriasVisibles/categoriaEvento.php", filtroeventos);


/////////////////////////////////////////////////////////////////////

$("#Menurelevantes").click(function(event) {
    event.preventDefault();
    var url = window.location.href;
    if (url.indexOf('Relevante=') === -1) {
        window.location.href = `?Relevante=true&showRelevante=true`;
    }
});

