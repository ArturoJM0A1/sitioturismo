$(document).ready(function () {

    $("#inputSearch").on("input", function () {
        var searchQuery = $(this).val().trim();

        if (searchQuery != '') {
            $.ajax({
                url: 'CrudNoticia/php/buscarNoticia.php',
                type: 'post',
                data: { searchQuery: searchQuery },
                success: function (response) {
                    $(".todasNoticias").html(response);

                    ejecutarEfectosDespuesDeCarga();

                    var tarjetas = document.querySelectorAll(".TarjetaNoticia");

                    function ejecutarEfectosDespuesDeCarga() {
                        setTimeout(function () {
                            window.addEventListener("scroll", mostrarTarjetas);
                            mostrarTarjetas();
                        }, 50);
                    }

                    function mostrarTarjetas() {
                        tarjetas.forEach(function (tarjeta) {
                            var distanciaDesdeLaCima = tarjeta.getBoundingClientRect().top;

                            if (distanciaDesdeLaCima - window.innerHeight <= 0 && distanciaDesdeLaCima >= 0) {
                                tarjeta.classList.add("visible");
                            }
                        });
                    }
                },
                error: function () {
                    console.error("Error al realizar la búsqueda.");
                }
            });
        }
    });

});
