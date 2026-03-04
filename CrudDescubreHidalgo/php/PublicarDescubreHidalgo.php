<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width,height=device-height,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
    <title>Publicar Descubre Hidalgo</title>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link rel="stylesheet" href="../../Generales/Generales.css">
    <link rel="stylesheet" href="../../Generales/Formulario.css">
    <link rel="stylesheet" href="./PublicarDescubreHidalgo/css/mapaMarcador.css">
    <link rel="stylesheet" href="../../Generales/ExplorarLugar.css">

    <script async src="PublicarDescubreHidalgo/js/iniciarMapa.js"></script>

    <?php
    session_start();

    // Verificar si el usuario está autenticado y obtener su nombre de usuario
    if (isset($_SESSION["usuario_nombre"]) && !empty($_SESSION["usuario_nombre"])) {
        $nombreusuario = $_SESSION["usuario_nombre"];
    } else {
        header("Location: ../../index.html");
        exit();
    }

    // Verificar  el rol del usuario 
    if ($_SESSION["usuario_rol"] !== "Admin") {
        header("Location: ../../index.html");
        exit();
    }
    ?>

</head>

<body>
    
<button class="regresarMenuOIndex" id="MenuUsuario">Menu</button>
    <script>const MenuUsuario = document.getElementById('MenuUsuario');
        MenuUsuario.addEventListener('click', function () { window.location.href = '../../MenuUsuario.php'; });
    </script>

    <div class="fondo">
        <div class="todoform">
            <form action="PublicarDescubreHidalgo/php/InsertarDH.php" method="post" enctype="multipart/form-data"
                onsubmit="return validarFormulario()">
                <h2>Publicar Descubre Hidalgo</h2>

                <label for="titulo">Título del Marcador:</label>
                <input type="text" id="titulo" name="titulo" required>
                <br>

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" rows="4" class="DesEvento" required></textarea>
                <br>

                <label for="lugar">Lugar <i class="fa-solid fa-info" id="InfoSeleccionarLugar"></i> :</label>
                <input id="lugar" type="text" name="lugar" placeholder="Escribe el lugar del evento" required>

                <div id="map"></div>
                <div id="infowindow-content">
                    <img src="" width="16" height="16" id="place-icon">
                    <span id="place-name" class="title"></span><br>
                    <span id="place-address"></span>
                </div>

                <div id="ventanaExplorarLugar">
                    <div class="barraTop">
                        <i class="fa-solid fa-rectangle-xmark" id="CerrarExplorarLugar"></i>
                    </div>
                    <div id="ExplorarLugar"></div>
                </div>

                <label for="coordenadas">Coordenadas:</label>
                <input type="text" id="coordenadas" name="coordenadas" readonly required>

                <input type="button" id="explore-button" class="cardboton" value="Explorar Lugar">
                <br>
                
                <label for="imgPrincipal" class="seleccionarImagen">Selecciona una imagen</label>
                <input type="file" name="imgPrincipal" id="imgPrincipal" accept="image/*" onchange="cargarImagen(this);">
                <img class="imagenColocada" src="../../Index/imagenes/Seleccionatuimagen.png" alt="Tu imagen" />
                <br>

                <label for="enlace">Enlace:</label>
                <input type="text" id="enlace" name="enlace">
                <br>

                <div class="ContentbtnEnviar">
                    <input class="cardboton" type="submit" value="Enviar">
                </div>

            </form>
        </div>
    </div>

    <script src="PublicarDescubreHidalgo/js/PublicarDescubreHidalgo.js"></script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZa9NjPPh3NGFnLsZis0j14pxYlPMGw40&callback=initMap&libraries=places"
        type="text/javascript"></script>

    <script defer src="../../Generales/disenoEstilosMapa.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</body>

</html>