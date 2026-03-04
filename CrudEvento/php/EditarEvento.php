<?php
// Incluir archivo de conexión a la base de datos
include '../../conexionBD.php';

// Verificar si se ha recibido un parámetro ID válido
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Obtener el ID del evento desde la URL
    $idEvento = $_GET['id'];

    // Consulta SQL para obtener los datos del evento específico y sus imágenes asociadas
    $query = "SELECT e.*, i.img AS imgPrincipal 
              FROM listaeventos e 
              LEFT JOIN listaeventos_imagenes i ON e.id = i.evento_id AND i.esprincipal = 1
              WHERE e.id = $idEvento";
    $resultado = $conexion->query($query);

    // Verificar si se encontró el evento
    if ($resultado->num_rows > 0) {
        // Obtener los datos del evento y la imagen principal
        $evento = $resultado->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Editar Evento</title>
            <link rel="stylesheet" href="../../Generales/Generales.css">
            <link rel="stylesheet" href="../../Generales/Formulario.css">
            <link rel="stylesheet" href="./PublicarEvento/css/mapaMarcador.css">
            <link rel="stylesheet" href="./PublicarEvento/css/multiplesImagenesEvento.css">
            <link rel="stylesheet" href="../../Generales/ExplorarLugar.css">
            <link rel="stylesheet" href="./EditarEvento/css/imagenEditar.css">
            <script async src="PublicarEvento/js/iniciarMapa.js"></script>
        </head>

        <body>
            <div class="fondo">
                <div class="todoform">
                    <form action="EditarEvento/php/ActualizarEvento.php" method="post" enctype="multipart/form-data"
                        onsubmit="return validarFormulario()">
                        <h2>Editar Evento</h2>
                        <input type="hidden" name="id_evento" value="<?php echo $evento['id']; ?>">
                        <label for="titulo">Título:</label>
                        <input type="text" id="titulo" name="titulo" value="<?php echo $evento['titulo']; ?>" required><br>
                        <label for="descripcion">¿De qué trata?:</label>
                        <textarea id="descripcion" name="descripcion" rows="4"
                            required><?php echo $evento['descripcion']; ?></textarea><br>
                        <label for="correos">Correos de Contacto:</label>
                        <input type="text" id="correos" name="correos" value="<?php echo $evento['correos']; ?>"><br>
                        <label for="telefonos">Teléfonos de Contacto:</label>
                        <input type="text" id="telefonos" name="telefonos" value="<?php echo $evento['telefonos']; ?>"><br>
                        <label for="fechaInicio">Fecha de Inicio:</label>
                        <input type="date" id="fechaInicio" name="fechaInicio" value="<?php echo $evento['fechaInicio']; ?>"
                            required><br>
                        <label for="fechaFin">Fecha de Fin:</label>
                        <input type="date" id="fechaFin" name="fechaFin" value="<?php echo $evento['fechaFin']; ?>"
                            required><br>
                        <label for="horario">Horario:</label>
                        <input type="text" id="horario" name="horario" value="<?php echo $evento['horario']; ?>"><br>
                        <label for="lugar">Lugar <i class="fa-solid fa-info" id="InfoSeleccionarLugar"></i> :</label>
                        <input id="lugar" type="text" name="lugar" value="<?php echo $evento['lugar']; ?>" required><br>
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
                        <input type="text" id="coordenadas" name="coordenadas" value="<?php echo $evento['coordenadas']; ?>"
                            required readonly>

                        <input type="button" id="explore-button" class="cardboton" value="Explorar Lugar">
                        <br>

                        <label for="video">URL video de Youtube:</label>
                        <input type="text" id="video" name="video" value="<?php echo $evento['video']; ?>"><br>
                        <label for="internoExterno">Tipo de Evento:</label>
                        <select id="internoExterno" name="internoExterno" required>
                            <option value="1" <?php if ($evento['internoExterno'] == 1)
                                echo "selected"; ?>>Evento Interno
                            </option>
                            <option value="2" <?php if ($evento['internoExterno'] == 2)
                                echo "selected"; ?>>Evento Externo
                            </option>
                        </select><br>
                        <label for="imagenes" class="seleccionarImagen">Imágenes colocadas:</label>
                        <p>Maximo 8 imagenes<br>Da click en una imagen para que sea la principal</p>
                        <div id="imagenesColocadas">



                            <?php
                            $ruta_base_imagenes = '../../';
                            // Consulta SQL para obtener todas las imágenes del evento
                            $query_imagenes = "SELECT * FROM listaeventos_imagenes WHERE evento_id = $idEvento";
                            $resultado_imagenes = $conexion->query($query_imagenes);
                            // Verificar si se encontraron imágenes
                            if ($resultado_imagenes->num_rows > 0) {
                                $div_principal_encontrado = false;
                                while ($imagen = $resultado_imagenes->fetch_assoc()) {
                                    $imagen_url = $ruta_base_imagenes . $imagen['img'];
                                    $es_principal = $imagen['esprincipal'];
                                    $imagen_id = $imagen['id']; // ID único de la imagen
                                    $clase_principal = ($es_principal == 1) ? 'imagen-principal' : '';

                                    // Configurar el ID y clase del div
                                    $div_id = '';
                                    if ($es_principal == 1) {
                                        if ($div_principal_encontrado) {
                                            // Si ya se encontró un divimagenprincipal, no se imprime este div
                                            continue;
                                        }
                                        $div_id = 'id="divimagenprincipal"';
                                        $div_principal_encontrado = true;
                                    }

                                    echo '<div ' . $div_id . ' data-id="' . $imagen_id . '">';
                                    echo '<img src="' . $imagen_url . '" class="imagen-evento ' . $clase_principal . '" data-id="' . $imagen_id . '"/>';
                                    echo '<button type="button" class="cardboton" onclick="cambiarImagenPrincipal(' . $imagen_id . ', ' . $idEvento . ')">Hacer Principal</button>';
                                    echo '<button type="button" class="cardboton" onclick="eliminarImagen(' . $imagen_id . ', this)">Eliminar</button>';
                                    echo '</div>';
                                }
                            } else {
                                echo "No se encontraron imágenes para este evento.";
                            }
                            ?>

                        </div>
                        <br>
                        <input type="hidden" id="imgPrincipalName" name="imgPrincipalName"
                            placeholder="Selecciona la imagen principal"
                            value="<?php echo isset($evento['imgPrincipal']) ? $evento['imgPrincipal'] : ''; ?>" required
                            readonly>

                        <br>
                        <label for="categoria">Categoría:</label>
                        <select id="categoria" name="categoria" required>
                            <option value="1" <?php if ($evento['categoria'] == 1)
                                echo "selected"; ?>>Cultural</option>
                            <option value="2" <?php if ($evento['categoria'] == 2)
                                echo "selected"; ?>>Deportivo / Recreativo
                            </option>
                            <option value="3" <?php if ($evento['categoria'] == 3)
                                echo "selected"; ?>>Gastronomía</option>
                            <option value="4" <?php if ($evento['categoria'] == 4)
                                echo "selected"; ?>>Educativo / Conferencias
                            </option>
                            <option value="5" <?php if ($evento['categoria'] == 5)
                                echo "selected"; ?>>Festivos</option>
                        </select><br>
                        <div class="ContentbtnEnviar">
                            <input class="cardboton" type="submit" value="Actualizar">
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


            <script src="EditarEvento/js/cambiarImagenPrincipal.js"></script>
            <script src="EditarEvento/js/eliminarImagen.js"></script>

        </body>

        </html>
        <?php
    } else {
        echo "No se encontró ningún evento con el ID proporcionado.";
    }
} else {
    echo "ID de evento no válido.";
}
?>