//del menu
var IrA = document.getElementById("IrA");
var Menubuscar = document.getElementById("Menubuscar");
var Menuareageografica = document.getElementById("Menuareageografica");
var Menumunicipio = document.getElementById("Menumunicipio");
var Menuanio = document.getElementById("Menuanio");
var Menulugares = document.getElementById("Menulugares");
var Menuactividades = document.getElementById("Menuactividades");
var Menueventos = document.getElementById("Menueventos");
var Menurelevantes = document.getElementById("Menurelevantes");

//del filtro
var filtroIrA = document.getElementById("filtroIrA");
var filtrobuscador = document.getElementById("filtrobuscador");
var filtroareageografica = document.getElementById("filtroareageografica");
var filtromunicipio = document.getElementById("filtromunicipio");
var filtroanios = document.getElementById("filtroanios");
var filtrolugares = document.getElementById("filtrolugares");
var filtroactividades = document.getElementById("filtroactividades");
var filtroeventos = document.getElementById("filtroeventos");
var filtrorelevantes = document.getElementById("filtrorelevantes");

//del cerrar filtro
var XfiltroIrA = document.getElementById("XfiltroIrA");
var XFiltrobuscador = document.getElementById("XFiltrobuscador");
var XFiltroareageografica = document.getElementById("XFiltroareageografica");
var XFiltromunicipio = document.getElementById("XFiltromunicipio");
var XFiltroanios = document.getElementById("XFiltroanios");
var XFiltrolugares = document.getElementById("XFiltrolugares");
var XFiltroactividades = document.getElementById("XFiltroactividades");
var XFiltroeventos = document.getElementById("XFiltroeventos");
var XFiltrorelevantes = document.getElementById("XFiltrorelevantes");


//Al hacer click en una opcion de el Menu
asignarEventoMostrarFiltro(IrA, filtroIrA, XfiltroIrA);
asignarEventoMostrarFiltro(Menubuscar, filtrobuscador, XFiltrobuscador);
asignarEventoMostrarFiltro(Menuareageografica, filtroareageografica, XFiltroareageografica);
asignarEventoMostrarFiltro(Menumunicipio, filtromunicipio, XFiltromunicipio);
asignarEventoMostrarFiltro(Menuanio, filtroanios, XFiltroanios);
asignarEventoMostrarFiltro(Menulugares, filtrolugares, XFiltrolugares);
asignarEventoMostrarFiltro(Menuactividades, filtroactividades, XFiltroactividades);
asignarEventoMostrarFiltro(Menueventos, filtroeventos, XFiltroeventos);
asignarEventoMostrarFiltro(Menurelevantes, filtrorelevantes, XFiltrorelevantes);

function asignarEventoMostrarFiltro(menu, filtro, xFiltro) {
    menu.addEventListener("click", function () {
        ocultarTodosFiltrosYXfiltros();
        filtro.style.display = "flex";
        xFiltro.style.display = "flex";
    });
}

function ocultarTodosFiltrosYXfiltros() {
    ocultarElementos(filtros);
    ocultarElementos(xFiltros);
}

function ocultarElementos(elementos) {
    elementos.forEach(function(elemento) {
        elemento.style.display = "none";
    });
}

var filtros = [filtroIrA, filtrobuscador, filtroareageografica, filtromunicipio, filtroanios, filtrolugares, filtroactividades, filtroeventos, filtrorelevantes];
var xFiltros = [XfiltroIrA, XFiltrobuscador, XFiltroareageografica, XFiltromunicipio, XFiltroanios, XFiltrolugares, XFiltroactividades, XFiltroeventos, XFiltrorelevantes];




XfiltroIrA.addEventListener("click", function () {
    quitarfiltro(IrA, filtroIrA, XfiltroIrA);
});

XFiltrobuscador.addEventListener("click", function () {
    quitarfiltro(Menubuscar, filtrobuscador, XFiltrobuscador);
});

XFiltroareageografica.addEventListener("click", function () {
    quitarfiltro(Menuareageografica, filtroareageografica, XFiltroareageografica);
});

XFiltromunicipio.addEventListener("click", function () {
    quitarfiltro(Menumunicipio, filtromunicipio, XFiltromunicipio);
});

XFiltroanios.addEventListener("click", function () {
    quitarfiltro(Menuanio, filtroanios, XFiltroanios);
});

XFiltrolugares.addEventListener("click", function () {
    quitarfiltro(Menulugares, filtrolugares, XFiltrolugares);
});

XFiltroactividades.addEventListener("click", function () {
    quitarfiltro(Menuactividades, filtroactividades, XFiltroactividades);
});

XFiltroeventos.addEventListener("click", function () {
    quitarfiltro(Menueventos, filtroeventos, XFiltroeventos);
});

XFiltrorelevantes.addEventListener("click", function () {
    quitarfiltro(Menurelevantes, filtrorelevantes, XFiltrorelevantes);
});





