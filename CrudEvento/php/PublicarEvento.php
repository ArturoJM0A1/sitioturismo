<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width,height=device-height,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">

    <title>Formulario de Eventos</title>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link rel="stylesheet" href="../../Generales/Generales.css">
    <link rel="stylesheet" href="../../Generales/Formulario.css">
    <link rel="stylesheet" href="./PublicarEvento/css/mapaMarcador.css">
    <link rel="stylesheet" href="./PublicarEvento/css/multiplesImagenesEvento.css">
    <link rel="stylesheet" href="../../Generales/ExplorarLugar.css">

    <script async src="PublicarEvento/js/iniciarMapa.js"></script>

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
    if ($_SESSION["usuario_rol"] !== "Jefe de edicion Marketing" && $_SESSION["usuario_rol"] !== "Marketing" && $_SESSION["usuario_rol"] !== "Admin") {
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
            <form action="PublicarEvento/php/InsertarE.php" method="post" enctype="multipart/form-data"
                onsubmit="return validarFormulario()">
                <h2>Publicar Evento</h2>

                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>
                <br>

                <label for="descripcion">¿De qué trata?:</label>
                <textarea id="descripcion" name="descripcion" rows="4" class="DesEvento" required></textarea>
                <br>

                <label for="correos">Correos de Contacto:</label>
                <input type="text" id="correos" name="correos">
                <br>

                <label for="telefonos">Teléfonos de Contacto:</label>
                <input type="text" id="telefonos" name="telefonos">
                <br>

                <label for="fechaInicio">Fecha de Inicio:</label>
                <input type="date" id="fechaInicio" name="fechaInicio" required>
                <br>

                <label for="fechaFin">Fecha de Fin:</label>
                <input type="date" id="fechaFin" name="fechaFin" required>
                <br>

                <label for="horario">Horario:</label>
                <input type="text" id="horario" name="horario">
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
                <input type="text" id="coordenadas" name="coordenadas" readonly required>

                <input type="button" id="explore-button" class="cardboton" value="Explorar Lugar">
                <br>

                <label for="video">URL video de Youtube:</label>
                <input type="text" id="video" name="video">
                <br>

                <label for="internoExterno">Tipo de Evento:</label>
                <select id="internoExterno" name="internoExterno" required>
                    <option value="" disabled selected>Selecciona una opción</option>
                    <option value="1">Evento Interno</option>
                    <option value="2">Evento Externo</option>
                </select>
                <br>

                <label for="imagenes" class="seleccionarImagen">Imágenes</label>
                <p>Maximo 8 imagenes<br>Da click en una imagen para que sea la principal</p>
                <input type="file" id="imagenes" name="imagenes[]" accept="image/*" multiple
                    onchange="mostrarImagenesSeleccionadas(this)">
                <div id="imagenPreview"></div>
                <br>

                <input id="imgPrincipalName" name="imgPrincipalName" placeholder="Selecciona la imagen principal"
                    required readonly>

                <label for="categoria">Categoría:</label>
                <select id="categoria" name="categoria" required>
                    <option value="" disabled selected>Selecciona una opción</option>
                    <option value="1">Cultural</option>
                    <option value="2">Deportivo / Recreativo</option>
                    <option value="3">Gastronomía</option>
                    <option value="4">Educativo / Conferencias</option>
                    <option value="5">Festivos</option>
                </select>
                <br>

                <div class="ContentbtnEnviar">
                    <input class="cardboton" type="submit" value="Enviar">
                </div>

            </form>
        </div>
    </div>

    <script src="PublicarEvento/js/PublicarEvento.js"></script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZa9NjPPh3NGFnLsZis0j14pxYlPMGw40&callback=initMap&libraries=places"
        type="text/javascript"></script>

    <script defer src="../../Generales/disenoEstilosMapa.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!--Para el Alert de Lugar -->

</body>

</html>