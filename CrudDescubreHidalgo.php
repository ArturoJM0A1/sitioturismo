<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descubre Hidalgo</title>

    <link rel="stylesheet" href="Generales/Generales.css">
    <link rel="stylesheet" href="Generales/DivError.css">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link rel="stylesheet" href="Generales/MenuOptions.css">
    <link rel="stylesheet" href="Generales/subMenu.css">

    <link rel="stylesheet" href="NoticiasPublicadas/css/NoticiasPublicadas.css">

    <link rel="stylesheet" href="CrudNoticia/css/EditarNoticia.css">

    <?php
    include 'conexionBD.php';
    session_start();

    // Verificar si el usuario está autenticado y obtener su nombre de usuario
    if (isset($_SESSION["usuario_nombre"]) && !empty($_SESSION["usuario_nombre"])) {
        $nombreusuario = $_SESSION["usuario_nombre"];
    } else {
        header("Location: index.html");
        exit();
    }

    // Verificar  el rol del usuario 
    if ($_SESSION["usuario_rol"] !== "Admin") {
        header("Location: index.html");
        exit();
    }

    // Número de resultados por página
    $resultadosPorPagina = 36;

    // Página actual (obtenida desde la URL o por defecto)
    $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

    // Calcular el inicio del resultado para la consulta
    $inicio = ($paginaActual - 1) * $resultadosPorPagina;

    // Consulta SQL con LIMIT para la paginación
    $query = "SELECT dh.id, dh.TituloMarcador AS titulo, dh.Descripcion AS descripcion, dh.lugar, dh.coordenadas, 
             dh.img AS imagen_principal, dh.enlace, dh.nombreusuario
             FROM DescubreHidalgo dh
             ORDER BY dh.id DESC
             LIMIT $inicio, $resultadosPorPagina";

    $resultado = $conexion->query($query);

    if (!$resultado) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }

    // Contar el número total de Descubre Hidalgo
    $queryTotal = "SELECT COUNT(*) AS total FROM DescubreHidalgo";
    $resultadoTotal = $conexion->query($queryTotal);
    $filaTotal = $resultadoTotal->fetch_assoc();
    $totalDescubreHidalgo = $filaTotal['total'];
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

            <div class="tab pink" id="VerInicio">
                <i class="fas fa-home"></i>
                <p>Inicio</p>
            </div>
            <div class="tab pink" id="VerTodasLasNoticias">
                <i class="fa-solid fa-newspaper"></i>
                <p>Noticias</p>
            </div>
            <div class="tab pink" id="VerTodosLosEventosExternos">
                <i class="fa-solid fa-calendar-days"></i>
                <p>Eventos Externos</p>
            </div>
            <div class="tab pink" id="VerTodosLosEventosInternos">
                <i class="fa-solid fa-calendar-days"></i>
                <p>Eventos Internos</p>
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
        
        var  VerTodosLosEventosExternos = document.getElementById("VerTodosLosEventosExternos");
        VerTodosLosEventosExternos.addEventListener("click", function () {
            window.location.href = "CalendarioEventos.php?externo=true";
        });

        var VerTodosLosEventosInternos = document.getElementById("VerTodosLosEventosInternos");
        VerTodosLosEventosInternos.addEventListener("click", function () {
            window.location.href = "CalendarioEventos.php?interno=true";
        });

    </script>



    <div class="centrarTodo">
        <div class="fondo">
            <div class="todasNoticias">

                <?php while ($DescubreHidalgo = $resultado->fetch_assoc()): ?>
                    <div class="TarjetaNoticia">
                        <div class="cuerpoNoticia">



                            <div class="contenidoNoticia">

                                <div class="Funcionalidades">
                                    <i class="fa-solid fa-pen-to-square" onclick="editarDescubreHidalgo(<?= $DescubreHidalgo['id'] ?>)"></i>
                                    <i class="fa-solid fa-trash-can" data-id="<?= $DescubreHidalgo['id'] ?>"></i>
                                </div>

                                <div class="tituloyImagen">
                                    <div class="titulo">
                                        <?= $DescubreHidalgo['titulo'] ?>
                                    </div>
                                    <img class="imagen" src="<?= $DescubreHidalgo['imagen_principal'] ?>" alt="Imagen del marcador">
                                </div>

                                <div class="textoLargo">
                                    <div class="subtitulo">
                                        <?= $DescubreHidalgo['lugar'] ?>
                                    </div>
                                    <div class="descricion">
                                        <?= $DescubreHidalgo['descripcion'] ?>
                                    </div>
                                </div>

                                <div class="boton">
                                    <a class="cardboton" href="DescubreHidalgo/index.html">Leer más</a>
                                </div>

                            </div>

                            <img class="ImagenNoticia" src="<?= $DescubreHidalgo['imagen_principal'] ?>" alt="Imagen del marcador">

                        </div>
                    </div>
                <?php endwhile; ?>

                <!-- Paginación -->
                <div class="paginacion">
                    <?php
                    // Calcular el número total de páginas
                    $totalPaginas = ceil($totalDescubreHidalgo / $resultadosPorPagina);

                    // Mostrar enlaces de paginación
                    for ($i = 1; $i <= $totalPaginas; $i++) {
                        echo "<a href='?pagina=$i'>$i</a>";
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>


    <script src="Generales/MenuOptions.js"></script>
    <script src="Generales/desenfoqueTarjeta.js"></script>

    <script src="CrudDescubreHidalgo/js/EliminarDescubreHidalgo.js"></script>
    <script src="CrudDescubreHidalgo/js/EditarDescubreHidalgo.js"></script>

</body>

</html>

<?php
$conexion->close();
?>