document.addEventListener('DOMContentLoaded', function () {
    ejecutarEfectosDespuesDeCarga();
});

window.addEventListener('load', function() {
    ejecutarEfectosDespuesDeCarga();
});

function ejecutarEfectosDespuesDeCarga() {
    setTimeout(function () {
        var tarjetas = document.querySelectorAll(".parallaxContentTitulo, .cardNoticia, .cardEventosExternos, .CardEventoInterno, #contenidoMapa, .TarjetaNoticia");

        function mostrarTarjetas() {
            tarjetas.forEach(function (tarjeta) {
                var distanciaDesdeLaCima = tarjeta.getBoundingClientRect().top;

                if (distanciaDesdeLaCima - window.innerHeight <= 0 && distanciaDesdeLaCima >= 0) {
                    tarjeta.classList.add("visible");
                }
            });
        }

        window.addEventListener("scroll", mostrarTarjetas);
        mostrarTarjetas();
    }, 50);
}

