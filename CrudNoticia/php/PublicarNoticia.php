<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Noticias</title>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <link rel="stylesheet" href="../../Generales/Generales.css">
    <link rel="stylesheet" href="../../Generales/Formulario.css">

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
    if ($_SESSION["usuario_rol"] !== "Prensa" && $_SESSION["usuario_rol"] !== "Jefe de edicion Prensa" && $_SESSION["usuario_rol"] !== "Admin") {
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
            <form action="PublicarNoticia/php/InsertarN.php" method="post" enctype="multipart/form-data"
                onsubmit="return validarFormulario()">
                <h2>Publicar Noticia</h2>

                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>
                <br>

                <label for="subtitulo">Subtítulo:</label>
                <input type="text" id="subtitulo" name="subtitulo">
                <br>

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" rows="4" required></textarea>
                <br>

                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>
                <br>

                <label for="internoExterno">Tipo de Noticia:</label>
                <select id="internoExterno" name="internoExterno" required>
                    <option value="0" disabled selected>Selecciona una opción</option>
                    <option value="1">Noticia Interna</option>
                    <option value="2">Noticia Externa</option>
                </select>
                <br>

                <label for="img" class="seleccionarImagen">Selecciona una imagen</label>
                <input type="file" name="img" id="img" accept="image/*" onchange="cargarImagen(this);">
                <img class="imagenColocada" src="../../Index/imagenes/Seleccionatuimagen.png" alt="Tu imagen" />
                <br>

                <label for="cAreaGeografica">Area Geografica:</label>
                <select id="cAreaGeografica" name="cAreaGeografica" required>
                    <option value="0" disabled selected>Selecciona una opción</option>
                </select>
                <br>

                <script>
                    var cAreaGeografica = document.getElementById("cAreaGeografica");
                    cAreaGeografica.value = "1"; // Establecer el valor

                    setTimeout(function () {
                        var changeEvent = new Event('change', { bubbles: true });
                        cAreaGeografica.dispatchEvent(changeEvent);
                    }, 900); 
                </script>


                <label for="cMunicipio">Municipio:</label>
                <div id="cMunicipio" name="cMunicipio">
                    <option value="0" disabled selected>Selecciona una o mas opciónes</option>
                </div>
                <br>

                <label for="cLugar">Lugar:</label>
                <select id="cLugar" name="cLugar">
                    <option class="opcionNinguno" value="0" selected>Ninguno</option>
                </select>
                <br>

                <label for="cActividad">Actividad:</label>
                <select id="cActividad" name="cActividad">
                    <option class="opcionNinguno" value="0" selected>Ninguno</option>
                </select>
                <br>

                <label for="cEvento">Evento:</label>
                <select id="cEvento" name="cEvento">
                    <option class="opcionNinguno" value="0" selected>Ninguno</option>
                </select>
                <br>

                <label for="Alineacion">Alineación del texto</label>
                <select id="Alineacion" name="Alineacion" required>
                    <option value="0" disabled selected>Selecciona una opción</option>
                    <option value="1">Alinear a la izquierda</option>
                    <option value="2">Alinear al centro</option>
                    <option value="3">Alinear a la derecha</option>
                    <option value="4">Justificado</option>
                </select>
                <br>

                <label for="autor">Autor:</label>
                <input type="text" id="autor" name="autor" placeholder="Nombre ApellidoPaterno ApellidoMaterno">
                <br>

                <label for="enlace">Enlace original:</label>
                <input type="text" id="enlace" name="enlace">
                <br>


                <div class="ContentbtnEnviar">

                    <input class="cardboton" type="submit" value="Enviar">

                </div>

            </form>
        </div>


    </div>




    <script src="../../getCategoriasVisibles/getCategoriasFormulario.js"></script>
    <script src="PublicarNoticia/js/PublicarNoticia.js"></script>

</body>

</html>