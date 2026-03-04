<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Edición de Noticias</title>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link rel="stylesheet" href="../../Generales/Generales.css">
    <link rel="stylesheet" href="../../Generales/Formulario.css">
    
</head>

<body>
    <div class="fondo">
        <div class="todoform">
            <?php
            include '../../conexionBD.php';
            $idNoticia = $_GET['id'];

            // Obtener la información actual de la noticia
            $query = "SELECT * FROM listanoticias WHERE id = $idNoticia";
            $resultado = $conexion->query($query);

            $query2 = "SELECT categoria_id FROM noticia_cmunicipio WHERE noticia_id = $idNoticia";
            $resultado2 = $conexion->query($query2);

            $query3 = "SELECT categoria_id FROM noticia_cLugar WHERE noticia_id = $idNoticia";
            $resultado3 = $conexion->query($query3);

            $query4 = "SELECT categoria_id FROM noticia_cActividad WHERE noticia_id = $idNoticia";
            $resultado4 = $conexion->query($query4);

            $query5 = "SELECT categoria_id FROM noticia_cevento WHERE noticia_id = $idNoticia";
            $resultado5 = $conexion->query($query5);

            $query6 = "SELECT categoria_id FROM noticia_careageografica WHERE noticia_id = $idNoticia";
            $resultado6 = $conexion->query($query6);

            // Inicializar las variables $nombrelugar, $nombreactividad y $nombreevento con una cadena vacía
            $nombrelugar = $nombreactividad = $nombreevento = '';

            if ($resultado && $resultado->num_rows > 0) {
                $noticia = $resultado->fetch_assoc();

                $rutaImagenActual = $noticia['img'];

                $filalugar = $resultado3->fetch_assoc();
                $categorialugarId = $filalugar ? $filalugar['categoria_id'] : null;

                $filaactividad = $resultado4->fetch_assoc();
                $categoriaactividadId = $filaactividad ? $filaactividad['categoria_id'] : null;

                $filaEvento = $resultado5->fetch_assoc();
                $categorieventoId = $filaEvento ? $filaEvento['categoria_id'] : null;

                $filaAreaGeografica = $resultado6->fetch_assoc();
                $categoriaAreaGeografica = $filaAreaGeografica ? $filaAreaGeografica['categoria_id'] : null;


                $municipiosSeleccionados = [];

                if ($resultado2 && $resultado2->num_rows > 0) {
                    // Iterar sobre los resultados para obtener los nombres de los municipios seleccionados
                    while ($filaMunicipio = $resultado2->fetch_assoc()) {
                        $categoriaMunicipioId = $filaMunicipio['categoria_id'];
                        // Consultar el nombre del municipio
                        $consultaMunicipio = $conexion->query("SELECT id, nombre FROM categoriaMunicipio WHERE id = $categoriaMunicipioId");
                        if ($consultaMunicipio && $consultaMunicipio->num_rows > 0) {
                            $infoMunicipio = $consultaMunicipio->fetch_assoc();
                            // Agregar el nombre del municipio al array de municipios seleccionados
                            $municipiosSeleccionados[] = $infoMunicipio['nombre'];
                        }
                    }
                }



                if ($categorialugarId) {
                    $consultalugar = $conexion->query("SELECT id, nombre FROM categoriaLugar WHERE id = $categorialugarId");
                    if ($consultalugar && $consultalugar->num_rows > 0) {
                        $infolugar = $consultalugar->fetch_assoc();
                        $idlugar = $infolugar['id'];
                        $nombrelugar = $infolugar['nombre'];
                    } else {
                        // Establecer valores predeterminados o mostrar mensaje de categoría no definida
                        $nombrelugar = 'Ninguno'; // Si no se encuentra el lugar, se establece como 'Ninguno'
                    }
                } else {
                    // Establecer valores predeterminados o mostrar mensaje de categoría no definida
                    $nombrelugar = 'Ninguno'; // Si no hay categoría de lugar, se establece como 'Ninguno'
                }


                if ($categoriaactividadId) {
                    $consultaactividad = $conexion->query("SELECT id, nombre FROM categoriaactividad WHERE id = $categoriaactividadId");
                    if ($consultaactividad && $consultaactividad->num_rows > 0) {
                        $infoactividad = $consultaactividad->fetch_assoc();
                        $idactividad = $infoactividad['id'];
                        $nombreactividad = $infoactividad['nombre'];
                    } else {
                        // Establecer valores predeterminados o mostrar mensaje de categoría no definida
                        $nombreactividad = 'Ninguno'; // Si no se encuentra la actividad, se establece como 'Ninguno'
                    }
                } else {
                    // Establecer valores predeterminados o mostrar mensaje de categoría no definida
                    $nombreactividad = 'Ninguno'; // Si no hay categoría de actividad, se establece como 'Ninguno'
                }


                if ($categorieventoId) {
                    $consultaevento = $conexion->query("SELECT id, nombre FROM categoriaevento WHERE id = $categorieventoId");
                    if ($consultaevento && $consultaevento->num_rows > 0) {
                        $infoevento = $consultaevento->fetch_assoc();
                        $idevento = $infoevento['id'];
                        $nombreevento = $infoevento['nombre'];
                    } else {
                        // Establecer valores predeterminados o mostrar mensaje de categoría no definida
                        $nombreevento = 'Ninguno'; // Si no se encuentra el evento, se establece como 'Ninguno'
                    }
                } else {
                    // Establecer valores predeterminados o mostrar mensaje de categoría no definida
                    $nombreevento = 'Ninguno'; // Si no hay categoría de evento, se establece como 'Ninguno'
                }


                $nombreAreaGeografica = '';
                if ($categoriaAreaGeografica) {
                    $consultaAreaGeografica = $conexion->query("SELECT id, nombre FROM categoriaareageografica WHERE id = $categoriaAreaGeografica");
                    if ($consultaAreaGeografica && $consultaAreaGeografica->num_rows > 0) {
                        $infoAreaGeografica = $consultaAreaGeografica->fetch_assoc();
                        $idAreaGeografica = $infoAreaGeografica['id'];
                        $nombreAreaGeografica = $infoAreaGeografica['nombre'];
                    }
                }
                ?>
                <form action="EditarNoticia/php/Actualizar.php" method="post" enctype="multipart/form-data"
                    onsubmit="return ActualizaFormulario()">
                    <h2>Editar Noticia</h2>

                    <input type="hidden" name="idNoticia" value="<?= $noticia['id'] ?>">
                    <label for="titulo">Título:</label>
                    <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($noticia['titulo']) ?>"
                        required>
                    <br>

                    <label for="subtitulo">Subtítulo:</label>
                    <input type="text" id="subtitulo" name="subtitulo"
                        value="<?= htmlspecialchars($noticia['subtitulo']) ?>">
                    <br>

                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" rows="4"
                        required><?= htmlspecialchars($noticia['descripcion']) ?></textarea>
                    <br>

                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" name="fecha" value="<?= $noticia['fecha'] ?>" required>
                    <br>

                    <label for="internoExterno">Tipo de Noticia:</label>
                    <select id="internoExterno" name="internoExterno" required>
                        <option value="0" disabled selected>Selecciona una opción</option>
                        <option value="1" <?= ($noticia['internoExterno'] == 1) ? 'selected' : '' ?>>Interna</option>
                        <option value="2" <?= ($noticia['internoExterno'] == 2) ? 'selected' : '' ?>>Externa</option>
                    </select>
                    <br>

                    <label for="img" class="seleccionarImagen">Selecciona una imagen</label>
                    <input type="file" name="img" id="img" accept="image/*" onchange="cargarImagen(this);">
                    <input type="hidden" name="img_actual" value="<?= $noticia['img'] ?>">

                    <!-- Mostrar la imagen actual del usuario -->
                    <img class="imagenColocada"
                        src="<?php echo $rutaImagenActual ? '../../' . $rutaImagenActual : '../../Index/imagenes/Seleccionatuimagen.png'; ?>"
                        alt="Tu imagen" />
                    <br> 

                    <label for="cAreaGeografica">Área Geográfica actual:
                        <?= $nombreAreaGeografica ?>
                    </label>
                    <select id="cAreaGeografica" name="cAreaGeografica" required>
                        <option value="0" disabled selected>Selecciona una opción</option>
                        <?php
                        // Consulta para obtener todas las opciones de eventos
                        $queryAreaGeografica = "SELECT id, nombre FROM categoriaareageografica WHERE visible = 1";
                        $resultadoAreaGeografica = $conexion->query($queryAreaGeografica);

                        // Iterar sobre los resultados y mostrar las opciones
                        while ($AreaGeografica = $resultadoAreaGeografica->fetch_assoc()) {
                            $selected = ($AreaGeografica['id'] == $idAreaGeografica) ? 'selected' : '';
                            echo "<option value='{$AreaGeografica['id']}' $selected>{$AreaGeografica['nombre']}</option>";
                        }
                        ?>

                    </select>
                    <br>



                    <label for="cMunicipio">Municipio actual:
                        <?php
                        if (count($municipiosSeleccionados) > 0) {
                            // Unir los nombres de los municipios con comas
                            echo implode(', ', $municipiosSeleccionados);
                        } else {
                            // Si no se han seleccionado municipios, mostrar el mensaje predeterminado
                            echo 'Ninguno';
                        }
                        ?>
                    </label>
                    <div id="cMunicipio">
                        <?php
                        // Consulta para obtener los municipios seleccionados por la noticia
                        $querySelectedMunicipios = "SELECT categoria_id FROM noticia_cMunicipio WHERE noticia_id = $idNoticia";
                        $resultadoSelectedMunicipios = $conexion->query($querySelectedMunicipios);
                        // Obtener los IDs de los municipios seleccionados
                        $selectedMunicipios = [];
                        while ($row = $resultadoSelectedMunicipios->fetch_assoc()) {
                            $selectedMunicipios[] = $row['categoria_id'];
                        }

                        // Consulta para obtener todas las opciones de municipios
                        $queryMunicipios = "SELECT id, nombre FROM categoriaMunicipio WHERE visible = 1";
                        $resultadoMunicipios = $conexion->query($queryMunicipios);
                        // Iterar sobre los resultados y mostrar las opciones como checkboxes
                        while ($municipio = $resultadoMunicipios->fetch_assoc()) {
                            $checked = in_array($municipio['id'], $selectedMunicipios) ? 'checked' : '';
                            echo "<div><input type='checkbox' id='municipio{$municipio['id']}' name='cMunicipio[]' value='{$municipio['id']}' $checked>";
                            echo "<label for='municipio{$municipio['id']}'>{$municipio['nombre']}</label></div>";
                        }
                        ?>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            <?php
                            foreach ($selectedMunicipios as $municipioId) {
                                echo "document.getElementById('municipio{$municipioId}').checked = true;";
                            }
                            ?>
                        });
                    </script>



                    <br>

                    <label for="cLugar">Lugar actual:
                        <?php echo isset($nombrelugar) ? $nombrelugar : 'Ninguno'; ?>
                    </label>
                    <select id="cLugar" name="cLugar" required>
                        <option class="opcionNinguno" value="0" selected>Ninguno</option>
                        <?php
                        // Consulta para obtener todas las opciones de lugares
                        $queryLugares = "SELECT id, nombre FROM categoriaLugar WHERE visible = 1";
                        $resultadoLugares = $conexion->query($queryLugares);

                        // Iterar sobre los resultados y mostrar las opciones
                        while ($lugar = $resultadoLugares->fetch_assoc()) {
                            $selected = isset($idlugar) && $lugar['id'] == $idlugar ? 'selected' : '';
                            echo "<option value='{$lugar['id']}' $selected>{$lugar['nombre']}</option>";
                        }
                        ?>
                    </select>
                    <br>

                    <label for="cActividad">Actividad actual:
                        <?php echo isset($nombreactividad) ? $nombreactividad : 'Ninguno'; ?>
                    </label>
                    <select id="cActividad" name="cActividad" required>
                        <option class="opcionNinguno" value="0" selected>Ninguno</option>
                        <?php
                        // Consulta para obtener todas las opciones de actividades
                        $queryActividades = "SELECT id, nombre FROM categoriaactividad WHERE visible = 1";
                        $resultadoActividades = $conexion->query($queryActividades);

                        // Iterar sobre los resultados y mostrar las opciones
                        while ($actividad = $resultadoActividades->fetch_assoc()) {
                            $selected = isset($idactividad) && $actividad['id'] == $idactividad ? 'selected' : '';
                            echo "<option value='{$actividad['id']}' $selected>{$actividad['nombre']}</option>";
                        }
                        ?>
                    </select>
                    <br>

                    <label for="cEvento">Evento actual:
                        <?php echo isset($nombreevento) ? $nombreevento : 'Ninguno'; ?>
                    </label>
                    <select id="cEvento" name="cEvento" required>
                        <option class="opcionNinguno" value="0" selected>Ninguno</option>
                        <?php
                        // Consulta para obtener todas las opciones de eventos
                        $queryEventos = "SELECT id, nombre FROM categoriaevento WHERE visible = 1";
                        $resultadoEventos = $conexion->query($queryEventos);

                        // Iterar sobre los resultados y mostrar las opciones
                        while ($evento = $resultadoEventos->fetch_assoc()) {
                            $selected = isset($idevento) && $evento['id'] == $idevento ? 'selected' : '';
                            echo "<option value='{$evento['id']}' $selected>{$evento['nombre']}</option>";
                        }
                        ?>
                    </select>
                    <br>


                    <label for="Alineacion">Alineación del texto</label>
                    <select id="Alineacion" name="Alineacion" required>
                        <option value="0" disabled selected>Selecciona una opción</option>
                        <option value="1" <?= ($noticia['alineacion'] == 1) ? 'selected' : '' ?>>Alinear a la izquierda
                        </option>
                        <option value="2" <?= ($noticia['alineacion'] == 2) ? 'selected' : '' ?>>Alinear al centro</option>
                        <option value="3" <?= ($noticia['alineacion'] == 3) ? 'selected' : '' ?>>Alinear a la derecha</option>
                        <option value="4" <?= ($noticia['alineacion'] == 4) ? 'selected' : '' ?>>Justificado</option>
                    </select>
                    <br>

                    <label for="autor">Autor:</label>
                    <input type="text" id="autor" name="autor"
                        value="<?= isset($noticia['autor']) ? htmlspecialchars($noticia['autor']) : '' ?>"
                        placeholder="Nombre ApellidoPaterno ApellidoMaterno">
                    <br>

                    <label for="enlace">Enlace:</label>
                    <input type="text" id="enlace" name="enlace"
                        value="<?= isset($noticia['enlace']) ? htmlspecialchars($noticia['enlace']) : '' ?>">
                    <br>


                    <div class="ContentbtnEnviar">

                        <input class="cardboton" type="submit" value="Actualizar">

                    </div>

                </form>
                <?php
            } else {
                echo "No se encontró la noticia." . $idNoticia;
            }
            ?>
        </div>
    </div>

    <script src="EditarNoticia/js/Actualizar.js"></script>
    <script src="PublicarNoticia/js/PublicarNoticia.js"></script>
</body>



<!-- <script src="../../getCategoriasVisibles/getCategoriasFormulario.js"></script> -->

</html>