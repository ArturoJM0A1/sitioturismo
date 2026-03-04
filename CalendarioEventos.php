<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width,height=device-height,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">

    <script src="./EventosPublicados/Calendario/Modernizr.js" type="text/javascript"></script>

    <link rel="stylesheet" href="./EventosPublicados/Calendario/Calendario.css">

    <link rel="stylesheet" href="./Generales/Generales.css">
    <link rel="stylesheet" href="Generales/DivError.css">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link rel="stylesheet" href="./Generales/MenuOptions.css">
    <link rel="stylesheet" href="./Generales/subMenu.css">

    <link rel="stylesheet" href="./EventosPublicados/Calendario/buscarEventos.css">

    <?php include './conexionBD.php'; ?>
</head>

<body>

    <div class="Menu">
        <div class="tab-nav-container">
            <div class="TABmenu">
                <i class="fa-solid fa-bars abrirmenu"></i>
                <i class="fa-solid fa-xmark cerrarMenu"></i>
                <p class="abrirTexto">Menu</p>
                <p class="cerrarTexto">Cerrar</p>
            </div>

            <div class="tab pink" id="VerInicio">
                <i class="fas fa-home"></i>
                <p>Inicio</p>
            </div>
            <div class="tab pink" id="VerTodasLasNoticias">
                <i class="fa-solid fa-newspaper"></i>
                <p>Noticias</p>
            </div>
            <div class="tab pink" id="VerTodosDescrubreHidalgo">
                <i class="fa-solid fa-map-location"></i>
                <p>Descubre Hidalgo</p>
            </div>
        </div>
    </div>

    <script>
        var VerInicio = document.getElementById("VerInicio");
        VerInicio.addEventListener("click", function () {
            window.location.href = "index.html";
        });

        var VerTodasLasNoticias = document.getElementById("VerTodasLasNoticias");
        VerTodasLasNoticias.addEventListener("click", function () {
            window.location.href = "NoticiasPublicadas.php";
        });

        var VerTodosDescrubreHidalgo = document.getElementById("VerTodosDescrubreHidalgo");
        VerTodosDescrubreHidalgo.addEventListener("click", function () {
            window.location.href = "DescubreHidalgo/index.html";
        });

    </script>

    <div id="contenidoCalendario">
        <div class="FiltrosCalendarioFecha">

            <label for="month">Mes:</label>
            <select id="month" name="month">
                <?php
                $currentMonth = date('n'); // Obtiene el número del mes actual
                $months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                for ($i = 0; $i < count($months); $i++) {
                    $selected = ($i + 1 == $currentMonth) ? 'selected' : ''; // Verifica si el mes es el actual y lo selecciona
                    echo "<option value='" . ($i + 1) . "' $selected>" . $months[$i] . "</option>";
                }
                ?>
            </select>

            <label for="year">Año:</label>
            <select id="year" name="year">
                <?php
                $startYear = 2023;
                $endYear = 2040;
                $currentYear = date('Y'); // Obtiene el año actual
                for ($year = $startYear; $year <= $endYear; $year++) {
                    $selected = ($year == $currentYear) ? 'selected' : ''; // Verifica si el año es el actual y lo selecciona
                    echo "<option value='$year' $selected>$year</option>";
                }
                ?>
            </select>


            <label for="categoria">Categoría:</label>
            <select id="categoria" name="categoria" required>
                <option value="0" disabled>Selecciona una opción</option>
                <option value="todas" selected>Todas</option>
                <option value="1">Cultural</option>
                <option value="2">Deportivo / Recreativo</option>
                <option value="3">Gastronomía</option>
                <option value="4">Educativo / Conferencias</option>
                <option value="5">Festivos</option>
            </select>
        </div>

        <div class="FiltrosCalendarioFecha">

            <label for="internoExterno">Interno / Externo:</label>
            <select id="internoExterno">
                <option value="0" disabled>Selecciona una opción</option>
                <option value="todos">Todos</option>
                <option value="1">Eventos internos</option>
                <option value="2">Eventos externos</option>
            </select>


            <button id="actualizarBtn" class="cardboton">Ver eventos</button>


        </div>

        <section>
            <div class="main">
                <div class="custom-calendar-wrap" id="todosLosEventos">
                    <div id="custom-inner" class="custom-inner">
                        <div class="custom-header clearfix">
                            <nav>
                                <span id="custom-prev" class="custom-prev"></span>
                                <span id="custom-next" class="custom-next"></span>
                            </nav>
                            <h2 id="custom-month" class="custom-month"></h2>
                            <h3 id="custom-year" class="custom-year"></h3>
                        </div>
                        <div id="calendar" class="fc-calendar-container"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <div id="resultadosBusquedaEventos">
        <div class="eventosEncontrados"></div>
    </div>




    <script src="./Generales/MenuOptions.js"></script>

    <script src="./EventosPublicados/Calendario/calendario-plugin.js"></script>
    <script src="./EventosPublicados/Calendario/GestionCalendario.js"></script>

    <script src="./EventosPublicados/Calendario/ConsultaDefecto.js"></script>

    <script>

        //del menu
        var Menubuscar = document.getElementById("Menubuscar");
        //del filtro
        var filtrobuscador = document.getElementById("filtrobuscador");
        //del cerrar filtro
        var XFiltrobuscador = document.getElementById("XFiltrobuscador");

        //Al hacer click en una opcion de el Menu
        asignarEventoMostrarFiltro(Menubuscar, filtrobuscador, XFiltrobuscador);

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
            elementos.forEach(function (elemento) {
                elemento.style.display = "none";
            });
        }


        var filtros = [filtrobuscador];
        var xFiltros = [XFiltrobuscador];


        //Al hacer click en X
        XFiltrobuscador.addEventListener("click", function () {
            location.reload(); // Recarga la página
        });

        /////////////////

        $('#Menubuscar').click(function () {
            $('#contenidoCalendario').css('display', 'none');
            $('#resultadosBusquedaEventos').css('display', 'flex');
        });


        $(document).ready(function () {
            $("#inputSearch").on("input", function () {
                var searchQueryEventos = $(this).val().trim();

                if (searchQueryEventos != '') {
                    $.ajax({
                        url: './EventosPublicados/Calendario/buscarEventos.php',
                        type: 'post',
                        data: { searchQueryEventos: searchQueryEventos },
                        success: function (response) {
                            $(".eventosEncontrados").html(response);
                        },
                        error: function () {
                            console.error("Error al realizar la búsqueda de eventos.");
                        }
                    });
                }
            });
        });


    </script>





</body>

</html>