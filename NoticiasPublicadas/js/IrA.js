var Menumedialsocial = document.getElementById("IrA");
var filtroMedialSocial = document.getElementById("filtroIrA");

Menumedialsocial.addEventListener("click", function () {
    filtroMedialSocial.style.display = "flex";
});


filtroMedialSocial.addEventListener("click", function () {
    $("#IrA").addClass("active");
});


$(document).ready(function () {
    $("#IrA").on("click", function () {
        // Verificar si el ancho de la pantalla es igual o menor a 768px
        if (window.matchMedia("(max-width: 768px)").matches) {
            var tab = document.getElementsByClassName("tab");
            $(tab).css("overflow", "visible");

            var tabnavcontainer = document.getElementsByClassName("tab-nav-container");
            $(tabnavcontainer).css("width", "110px");
            $(tabnavcontainer).css("height", "auto");
        }
    });
});


//Cerrar

$(document).ready(function () {
    $("#IrA").click(function () {
        $("#filtroIrA").css("display", "flex");
        $("#IrA").addClass("active");
        $("#XfiltroIrA").css("display", "flex");
    });

    $("#XfiltroIrA").click(function () {
        location.reload(); // Recargar la página
    });
});


/////////////////////////


document.getElementById('IrAinicio').addEventListener('click', function() {
    window.location.href = 'index.html';
});

document.getElementById('IrEventosExternos').addEventListener('click', function() {
    window.location.href = 'CalendarioEventos.php?externo=true';
});

document.getElementById('IrAEventosInternos').addEventListener('click', function() {
    window.location.href = 'CalendarioEventos.php?interno=true';
});


document.getElementById('IrADescubreHidalgo').addEventListener('click', function() {
    window.location.href = 'DescubreHidalgo/index.html';
});


document.getElementById('XfiltroIrA').addEventListener('click', function() {
    window.location.href = 'NoticiasPublicadas.php';
});


