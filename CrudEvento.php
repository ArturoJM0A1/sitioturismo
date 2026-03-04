<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos</title>

    <link rel="stylesheet" href="Generales/Generales.css">
    <link rel="stylesheet" href="Generales/DivError.css">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link rel="stylesheet" href="Generales/MenuOptions.css">
    <link rel="stylesheet" href="Generales/subMenu.css">

    <link rel="stylesheet" href="NoticiasPublicadas/css/NoticiasPublicadas.css">

    <link rel="stylesheet" href="NoticiasPublicadas/css/filtrosNoticias.css">

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
    if ($_SESSION["usuario_rol"] !== "Jefe de edicion Marketing" && $_SESSION["usuario_rol"] !== "Admin") {
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
    $query = "SELECT le.id, le.titulo, le.descripcion, le.fechaInicio, le.fechaFin, le.horario, le.lugar, le.coordenadas, 
             le.video, le.internoExterno, le.nombreusuario, le.categoria, li.img AS imagen_principal
             FROM listaeventos le
             LEFT JOIN listaeventos_imagenes li ON le.id = li.evento_id AND li.esprincipal = 1
             ORDER BY le.fechaInicio DESC
             LIMIT $inicio, $resultadosPorPagina";

    $resultado = $conexion->query($query);

    if (!$resultado) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }

    // Contar el número total de eventos
    $queryTotal = "SELECT COUNT(*) AS total FROM listaeventos";
    $resultadoTotal = $conexion->query($queryTotal);
    $filaTotal = $resultadoTotal->fetch_assoc();
    $totalEventos = $filaTotal['total'];
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

    <div class="centrarTodo">
        <div class="fondo">
            <div class="todasNoticias">

                <?php while ($evento = $resultado->fetch_assoc()): ?>
                    <div class="TarjetaNoticia">
                        <div class="cuerpoNoticia">

                            <div class="FechaNoticia">
                                <?= date('d/m/Y', strtotime($evento['fechaInicio'])) ?>
                            </div>

                            <div class="contenidoNoticia">

                                <div class="Funcionalidades">
                                    <i class="fa-solid fa-pen-to-square" onclick="editarEvento(<?= $evento['id'] ?>)"></i>
                                    <i class="fa-solid fa-trash-can" data-id="<?= $evento['id'] ?>"></i>
                                </div>

                                <div class="tituloyImagen">
                                    <div class="titulo">
                                        <?= $evento['titulo'] ?>
                                    </div>
                                    <img class="imagen" src="<?= $evento['imagen_principal'] ?>" alt="Imagen del evento">
                                </div>

                                <div class="textoLargo">
                                    <div class="subtitulo">
                                    </div>
                                    <div class="descricion">
                                        <?= $evento['descripcion'] ?>
                                    </div>
                                </div>

                                <div class="boton">
                                    <a class="cardboton" href="CompletoEvento.php?id=<?= $evento['id'] ?>">Leer más</a>
                                </div>

                                <div class="categorias">
                                    <?php
                                    // Arreglo asociativo para mapear números de categoría a textos
                                    $categoriasTextuales = [
                                        1 => 'Cultural',
                                        2 => 'Deportivo / Recreativo',
                                        3 => 'Gastronomía',
                                        4 => 'Educativo / Conferencias',
                                        5 => 'Festivos'
                                    ];

                                    $categoriasArray = explode(',', $evento['categoria']);

                                    foreach ($categoriasArray as $categoria): ?>
                                        <div>
                                            <p>
                                                <?= isset($categoriasTextuales[$categoria]) ? $categoriasTextuales[$categoria] : 'Otro' ?>
                                            </p>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                            </div>

                            <img class="ImagenNoticia" src="<?= $evento['imagen_principal'] ?>" alt="Imagen del evento">

                        </div>
                    </div>
                <?php endwhile; ?>

                <!-- Paginación -->
                <div class="paginacion">
                    <?php
                    // Calcular el número total de páginas
                    $totalPaginas = ceil($totalEventos / $resultadosPorPagina);

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

    <script src="CrudEvento/js/EliminarEvento.js"></script>
    <script src="CrudEvento/js/EditarEvento.js"></script>

</body>

</html>

<?php
$conexion->close();
?>