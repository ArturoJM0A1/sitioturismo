<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias</title>

    <link rel="stylesheet" href="Generales/Generales.css">
    <link rel="stylesheet" href="Generales/DivError.css">

    <link rel="stylesheet" href="Generales/MenuOptions.css">
    <link rel="stylesheet" href="Generales/subMenu.css">

    <link rel="stylesheet" href="Generales/desenfoqueTarjeta.css">

    <link rel="stylesheet" href="NoticiasPublicadas/css/NoticiasPublicadas.css">


    <link rel="stylesheet" href="CrudNoticia/css/EditarNoticia.css">


    <?php include 'conexionBD.php';
    session_start();

    // Verificar si el usuario está autenticado y obtener su nombre de usuario
    if (isset($_SESSION["usuario_nombre"]) && !empty($_SESSION["usuario_nombre"])) {
        $nombreusuario = $_SESSION["usuario_nombre"];
    } else {
        header("Location: index.html");
        exit();
    }

    // Verificar  el rol del usuario 
    if ($_SESSION["usuario_rol"] !== "Jefe de edicion Prensa" && $_SESSION["usuario_rol"] !== "Admin") {
        header("Location: index.html");
        exit();
    }

    ?>





    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


</head>

<body>

    <button class="regresarMenuOIndex" id="MenuUsuario">Menu</button>
    <script>const MenuUsuario = document.getElementById('MenuUsuario');
        MenuUsuario.addEventListener('click', function () { window.location.href = 'MenuUsuario.php'; });
    </script>

    <div class="Menu">
        <div class="tab-nav-container">


            <div class="TABmenu">
                <i class="fa-solid fa-bars abrirmenu"></i>
                <i class="fa-solid fa-xmark cerrarMenu"></i>
                <p class="abrirTexto">Menu</p>
                <p class="cerrarTexto">Cerrar</p>
            </div>


            <div class="tab pink" id="IrA">
                <i class="fa-solid fa-paper-plane"></i>
                <p>Ir a</p>
                <div class="contenedorListaOpciones">
                    <div class="listaOpciones">
                        <div class="filtros maximotamanofiltro">
                            <div id="filtroIrA">

                                <button class="optionList" id="IrAinicio">
                                    <i class="fas fa-home"></i>
                                    Inicio
                                </button>

                                <button class="optionList" id="IrEventosExternos">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    Eventos externos
                                </button>

                                <button class="optionList" id="IrAEventosInternos">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    Eventos internos
                                </button>

                                <button class="optionList" id="IrADescubreHidalgo">
                                    <i class="fa-solid fa-map-location"></i>
                                    Descubre Hidalgo
                                </button>

                            </div>
                        </div>
                        <i class="fa-solid fa-xmark cerrarfiltro" id="XfiltroIrA"></i>
                    </div>
                </div>
            </div>



            <div class="tab pink" id="Menubuscar">
                <i class="fa-solid fa-magnifying-glass"></i>
                <p>Buscar</p>

                <div class="contenedorListaOpciones">

                    <div class="listaOpciones">

                        <div class="filtros maximotamanofiltrobuscador">
                            <div id="filtrobuscador">
                                <center>
                                    <input type="search" id="inputSearch" placeholder="Buscar...">
                                </center>
                            </div>
                        </div>
                    </div>
                    <i class="fa-solid fa-xmark cerrarfiltro" id="XFiltrobuscador"></i>

                </div>

            </div>




            <div class="tab pink" id="Menuareageografica">
                <i class="fa-solid fa-globe"></i>
                <p>Área geográfica</p>


                <div class="contenedorListaOpciones">
                    <div class="listaOpciones">
                        <div class="filtros maximotamanofiltro">
                            <div id="filtroareageografica">
                            </div>
                        </div>
                    </div>
                    <i class="fa-solid fa-xmark cerrarfiltro" id="XFiltroareageografica"></i>
                </div>




            </div>

            <div class="tab pink" id="Menumunicipio">
                <i class="fa-solid fa-tree-city"></i>
                <p>Municipio</p>

                <div class="contenedorListaOpciones">
                    <div class="listaOpciones">
                        <div class="filtros maximotamanofiltro">
                            <div id="filtromunicipio">
                            </div>
                        </div>

                        <i class="fa-solid fa-xmark cerrarfiltro" id="XFiltromunicipio"></i>
                    </div>
                </div>
            </div>

            <div class="tab pink" id="Menuanio">
                <i class="fa-solid fa-calendar-days"></i>
                <p>Año</p>

                <div class="contenedorListaOpciones">
                    <div class="listaOpciones">
                        <div class="filtros maximotamanofiltro">
                            <div id="filtroanios"></div>
                        </div>

                        <i class="fa-solid fa-xmark cerrarfiltro" id="XFiltroanios"></i>
                    </div>
                </div>


            </div>

            <div class="tab pink" id="Menulugares">
                <i class="fa-solid fa-church"></i>
                <p>Lugares</p>
                <div class="contenedorListaOpciones">
                    <div class="listaOpciones">
                        <div class="filtros maximotamanofiltro">
                            <div id="filtrolugares"></div>
                        </div>

                        <i class="fa-solid fa-xmark cerrarfiltro" id="XFiltrolugares"></i>
                    </div>
                </div>
            </div>

            <div class="tab pink" id="Menuactividades">
                <i class="fa-solid fa-martini-glass-citrus"></i>
                <p>Actividades</p>
                <div class="contenedorListaOpciones">
                    <div class="listaOpciones">
                        <div class="filtros maximotamanofiltro">
                            <div id="filtroactividades"></div>
                        </div>
                        <i class="fa-solid fa-xmark cerrarfiltro" id="XFiltroactividades"></i>
                    </div>
                </div>
            </div>

            <div class="tab pink" id="Menueventos">
                <i class="fa-solid fa-music"></i>
                <p>Eventos</p>
                <div class="contenedorListaOpciones">
                    <div class="listaOpciones">
                        <div class="filtros maximotamanofiltro">
                            <div id="filtroeventos"></div>
                        </div>
                        <i class="fa-solid fa-xmark cerrarfiltro" id="XFiltroeventos"></i>
                    </div>
                </div>
            </div>

            <div class="tab pink" id="Menurelevantes">
                <i class="fa-solid fa-star"></i>
                <p>Relevantes</p>
                <div class="contenedorListaOpciones">
                    <div class="listaOpciones">
                        <div class="filtros maximotamanofiltro">
                            <div id="filtrorelevantes"></div>
                        </div>
                        <i class="fa-solid fa-xmark cerrarfiltro" id="XFiltrorelevantes"></i>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="centrarTodo">
        <div class="fondo">
            <div class="todasNoticias">
                <?php

                ////////////Consulta Inicial por defecto para mostrar todo////////////
                $cAreaGeografica = "";
                $Cmunicipio = "";
                $Canio = "";
                $Clugar = "";
                $Cactividad = "";
                $Cevento = "";
                $CRelevante = "";

                $limiteResultadosPagina = 25;
                $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1; // Obtener el número de página actual
                $offset = ($pagina - 1) * $limiteResultadosPagina;

                $AreaGeografica = isset($_GET['AreaGeografica']) ? urldecode($_GET['AreaGeografica']) : ''; // Ver si el parametro esta en la url
                $cAreaGeografica = $AreaGeografica ? "WHERE cAreaGeografica.nombre = '$AreaGeografica'" : '';   //(condición) ? (valor_si_verdadero) : (valor_si_falso);
                
                $nombreMunicipio = isset($_GET['Municipio']) ? urldecode($_GET['Municipio']) : ''; // Ver si el parametro esta en la url
                $Cmunicipio = $nombreMunicipio ? "WHERE cMunicipio.nombre = '$nombreMunicipio'" : '';   //(condición) ? (valor_si_verdadero) : (valor_si_falso);
                
                $anio = isset($_GET['Anio']) ? urldecode($_GET['Anio']) : '';
                $Canio = $anio ? "WHERE YEAR(ln.fecha) = $anio" : '';

                $lugar = isset($_GET['Lugar']) ? urldecode($_GET['Lugar']) : '';
                $Clugar = $lugar ? "WHERE cLugar.nombre = '$lugar'" : '';

                $actividad = isset($_GET['Actividad']) ? urldecode($_GET['Actividad']) : '';
                $Cactividad = $actividad ? "WHERE cActividad.nombre = '$actividad'" : '';

                $evento = isset($_GET['Evento']) ? urldecode($_GET['Evento']) : '';
                $Cevento = $evento ? "WHERE cEvento.nombre = '$evento'" : '';

                $relevante = isset($_GET['Relevante']) ? urldecode($_GET['Relevante']) : '';
                $CRelevante = $relevante ? "WHERE ln.Relevante = 1" : '';


                // Consulta para obtener todas las noticias dependiendo los parametros que se le indiquen
                $query = "SELECT ln.id, ln.titulo, ln.subtitulo, ln.descripcion, ln.fecha, ln.internoExterno, 
                ln.img, ln.Relevante, GROUP_CONCAT(cMunicipio.nombre) AS cMunicipio
                FROM listanoticias ln

                LEFT JOIN noticia_cAreaGeografica ncAreaGeografica ON ln.id = ncAreaGeografica.noticia_id
                LEFT JOIN categoriaareaGeografica cAreaGeografica ON ncAreaGeografica.categoria_id = cAreaGeografica.id

                LEFT JOIN noticia_cMunicipio ncMunicipio ON ln.id = ncMunicipio.noticia_id
                LEFT JOIN categoriaMunicipio cMunicipio ON ncMunicipio.categoria_id = cMunicipio.id

                LEFT JOIN noticia_cLugar ncLugar ON ln.id = ncLugar.noticia_id
                LEFT JOIN categoriaLugar cLugar ON ncLugar.categoria_id = cLugar.id

                LEFT JOIN noticia_cActividad ncActividad ON ln.id = ncActividad.noticia_id
                LEFT JOIN categoriaActividad cActividad ON ncActividad.categoria_id = cActividad.id
                
                LEFT JOIN noticia_cEvento ncEvento ON ln.id = ncEvento.noticia_id
                LEFT JOIN categoriaEvento cEvento ON ncEvento.categoria_id = cEvento.id

                $cAreaGeografica 
                $Cmunicipio 
                $Canio
                $Clugar
                $Cactividad
                $Cevento
                $CRelevante

                GROUP BY ln.id
                ORDER BY ln.fecha DESC";

                $query .= " LIMIT $limiteResultadosPagina OFFSET $offset";
                $resultado = mysqli_query($conexion, $query);

                // Verifica si hubo errores en la consulta
                if (!$resultado) {
                    die("Error en la consulta: " . mysqli_error($conexion));
                }

                // Consulta para saber el total de noticias
                $query_total = "SELECT COUNT(DISTINCT ln.id) AS total
                FROM listanoticias ln

                LEFT JOIN noticia_cAreaGeografica ncAreaGeografica ON ln.id = ncAreaGeografica.noticia_id
                LEFT JOIN categoriaareaGeografica cAreaGeografica ON ncAreaGeografica.categoria_id = cAreaGeografica.id

                LEFT JOIN noticia_cMunicipio ncMunicipio ON ln.id = ncMunicipio.noticia_id
                LEFT JOIN categoriaMunicipio cMunicipio ON ncMunicipio.categoria_id = cMunicipio.id

                LEFT JOIN noticia_cLugar ncLugar ON ln.id = ncLugar.noticia_id
                LEFT JOIN categoriaLugar cLugar ON ncLugar.categoria_id = cLugar.id

                LEFT JOIN noticia_cActividad ncActividad ON ln.id = ncActividad.noticia_id
                LEFT JOIN categoriaActividad cActividad ON ncActividad.categoria_id = cActividad.id
                
                LEFT JOIN noticia_cEvento ncEvento ON ln.id = ncEvento.noticia_id
                LEFT JOIN categoriaEvento cEvento ON ncEvento.categoria_id = cEvento.id

                $cAreaGeografica 
                $Cmunicipio 
                $Canio
                $Clugar
                $Cactividad
                $Cevento
                $CRelevante";

                // Ejecuta la consulta para obtener el total de noticias
                $resultadoTotal = mysqli_query($conexion, $query_total);

                // Verifica si hubo errores en la consulta del total de noticias
                if (!$resultadoTotal) {
                    die("Error en la consulta del total de noticias: " . mysqli_error($conexion));
                }

                // Obtiene el total de noticias
                $totalNoticias = mysqli_fetch_assoc($resultadoTotal)['total'];


                while ($Noticia = $resultado->fetch_assoc()):
                    $fechaFormateada = date('d/m/Y', strtotime($Noticia['fecha'])); //dia mes año 
                    $categoriasArray = explode(',', $Noticia['cMunicipio']);
                    ?>

                    <div class="TarjetaNoticia <?= implode(' ', $categoriasArray) ?>">
                        <div class="cuerpoNoticia">

                            <div class="FechaNoticia">
                                <?= $fechaFormateada ?>
                            </div>

                            <div class="contenidoNoticia">


                                <div class="Funcionalidades">
                                    <i class="fa-solid fa-pen-to-square" onclick="editarNoticia(<?= $Noticia['id'] ?>)"></i>
                                    <i class="fa-solid fa-trash-can" data-id="<?= $Noticia['id'] ?>"></i>
                                    <i class="fa-solid fa-star <?php echo $Noticia['Relevante'] == 1 ? 'Relevante' : ''; ?>"
                                        onclick="marcarComoRelevante(<?= $Noticia['id'] ?>)"></i>
                                </div>

                                <div class="tituloyImagen">
                                    <div class="titulo">
                                        <?= $Noticia['titulo'] ?>
                                    </div>


                                    <img class="imagen" src="<?= $Noticia['img'] ?>"></img>


                                </div>

                                <div class="textoLargo">
                                    <div class="subtitulo">
                                        <?= $Noticia['subtitulo'] ?>
                                    </div>
                                    <div class="descricion">
                                        <?= $Noticia['descripcion'] ?>
                                    </div>
                                </div>

                                <div class="boton">
                                    <a class="cardboton" href="CompletaNoticia.php?id=<?= $Noticia['id'] ?>">Leer
                                        más</a>
                                </div>

                                <div class="categorias">
                                    <?php foreach ($categoriasArray as $categoria): ?>
                                        <div>
                                            <p>
                                                <?= $categoria ?>
                                            </p>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                            </div>


                            <img class="ImagenNoticia" src="<?= $Noticia['img'] ?>"></img>

                        </div>
                    </div>

                <?php endwhile; ?>

            </div>


            <div class="paginacion">
                <?php


                $total_pages = ceil($totalNoticias / $limiteResultadosPagina);

                // Obtener la página actual de la URL
                $pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

                for ($i = 1; $i <= $total_pages; $i++) {
                    $clase_active = ($i == $pagina_actual) ? 'active' : '';
                    echo "<a href='?pagina=$i' class='$clase_active'>$i</a> ";
                }
                ?>
            </div>


        </div>

    </div>


    <script src="Generales/MenuOptions.js"></script>
    <script src="Generales/desenfoqueTarjeta.js"></script>

    <script src="NoticiasPublicadas/js/MenuyFiltros.js"></script>
    <script src="NoticiasPublicadas/js/AccionDelFiltro.js"></script>
    <script src="NoticiasPublicadas/js/Crearboton.js"></script>
    <script src="NoticiasPublicadas/js/IrA.js"></script>

    <script src="CrudNoticia/js/buscarNoticia.js"></script>
    <script src="CrudNoticia/js/quitarfiltro.js"></script>

    <script src="CrudNoticia/js/EliminarNoticia.js"></script>
    <script src="CrudNoticia/js/EditarNoticia.js"></script>
    <script src="CrudNoticia/js/MarcarRelevante.js"></script>


</body>

</html>



<?php
$conexion->close();
?>