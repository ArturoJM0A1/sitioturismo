//Valores seleccionados por defecto dependiendo la estructura actual del HTML y del parametro URL

$(document).ready(function () {
    // Función para obtener el valor del parámetro en la URL
    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }



    // Obtener el valor del parámetro 'interno' de la URL
    var internoParam = getParameterByName('interno');
    // Obtener el valor del parámetro 'externo' de la URL
    var externoParam = getParameterByName('externo');

    // Verificar si el parámetro interno es true o false
    if (internoParam === 'true') {
        $('#internoExterno').val('1'); // Seleccionar eventos internos
        //si Calendario.php?externo=true
    } else if (externoParam === 'true') {
        $('#internoExterno').val('2'); // Seleccionar eventos externos
        //si Calendario.php?interno=true
    } else {
        $('#internoExterno').val('todos'); // Seleccionar todos los eventos
        //Calendario.php
    }

    function cargarEventos() {
        var categoriaSeleccionada = $('#categoria').val();
        var internoExternoSeleccionado = $('#internoExterno').val();
        obtenerEventos(categoriaSeleccionada, internoExternoSeleccionado);
    }
    cargarEventos();
});


//simula un click en el boton 
window.onload = function () {
    document.getElementById("actualizarBtn").click();
};