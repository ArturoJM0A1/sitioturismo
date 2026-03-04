<?php
// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../../../../conexionBD.php';

    $idNoticia = $_POST['idNoticia'];
    $titulo = $_POST['titulo'];
    $subtitulo = $_POST['subtitulo'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];
    $internoExterno = $_POST['internoExterno'];
    $Alineacion = isset($_POST['Alineacion']) ? $_POST['Alineacion'] : null; // Verificar si se proporciona la alineación
    $autor = isset($_POST['autor']) ? $_POST['autor'] : null; // Verificar si se proporciona el autor
    $enlace = isset($_POST['enlace']) ? $_POST['enlace'] : null; // Verificar si se proporciona el enlace

    // Verificar si se proporcionaron las categorías y obtener sus valores
    $cAreaGeografica = isset($_POST['cAreaGeografica']) ? $_POST['cAreaGeografica'] : null;
    $cMunicipios = isset($_POST['cMunicipio']) ? $_POST['cMunicipio'] : array();
    $cLugar = isset($_POST['cLugar']) ? $_POST['cLugar'] : null;
    $cActividad = isset($_POST['cActividad']) ? $_POST['cActividad'] : null;
    $cEvento = isset($_POST['cEvento']) ? $_POST['cEvento'] : null;

    if ($_FILES['img']['size'] > 0) {
        // NUEVA imagen 
        $rutaGuardarImagen = '../../../../ImagenesInsertadasNoticias/' . $_FILES['img']['name'];
        $rutaPublicaImagen = 'ImagenesInsertadasNoticias/' . $_FILES['img']['name'];
        move_uploaded_file($_FILES['img']['tmp_name'], $rutaGuardarImagen);

        // Eliminar la imagen del servidor si es que hay una nueva
        $EliminarImagenSiHayNueva = "../../../../" . $_POST['img_actual'];
        if (file_exists($EliminarImagenSiHayNueva)) {
            unlink($EliminarImagenSiHayNueva);
        }
    } else {
        // Conservar la imagen actual si no se carga una nueva
        $rutaImagenActual = $_POST['img_actual'];
        $rutaGuardarImagen = '../../../../ImagenesInsertadasNoticias/' . $rutaImagenActual;
        $rutaPublicaImagen = 'ImagenesInsertadasNoticias/' . basename($rutaImagenActual); // Conservar solo el nombre del archivo en la ruta pública
    }

    // Preparar la consulta de actualización
    $query = "UPDATE listanoticias SET
                titulo = ?,
                subtitulo = ?,
                descripcion = ?,
                fecha = ?,
                internoExterno = ?,
                img = ?,
                alineacion = ?,
                autor = ?,
                enlace = ?
              WHERE id = ?";

    // Preparar la sentencia
    $stmt = $conexion->prepare($query);

    // Vincular los parámetros
    $stmt->bind_param("ssssdssssi", $titulo, $subtitulo, $descripcion, $fecha, $internoExterno, $rutaPublicaImagen, $Alineacion, $autor, $enlace, $idNoticia);

    if ($stmt->execute()) {
        if ($cAreaGeografica) {
            $queryCheckAreaGeografica = "SELECT * FROM noticia_cAreaGeografica WHERE noticia_id = ?";
            $stmtCheckAreaGeografica = $conexion->prepare($queryCheckAreaGeografica);
            $stmtCheckAreaGeografica->bind_param("i", $idNoticia);
            $stmtCheckAreaGeografica->execute();
            $resultCheckAreaGeografica = $stmtCheckAreaGeografica->get_result();

            if ($resultCheckAreaGeografica->num_rows > 0) {
                $queryUpdateAreaGeografica = "UPDATE noticia_cAreaGeografica SET categoria_id = ? WHERE noticia_id = ?";
                $stmtUpdateAreaGeografica = $conexion->prepare($queryUpdateAreaGeografica);
                $stmtUpdateAreaGeografica->bind_param("ii", $cAreaGeografica, $idNoticia);
                $stmtUpdateAreaGeografica->execute();
                $stmtUpdateAreaGeografica->close();
            } else {
                $queryInsertAreaGeografica = "INSERT INTO noticia_cAreaGeografica (noticia_id, categoria_id) VALUES (?, ?)";
                $stmtInsertAreaGeografica = $conexion->prepare($queryInsertAreaGeografica);
                $stmtInsertAreaGeografica->bind_param("ii", $idNoticia, $cAreaGeografica);
                $stmtInsertAreaGeografica->execute();
                $stmtInsertAreaGeografica->close();
            }

            $stmtCheckAreaGeografica->close();
        }


        // Consulta para obtener los municipios asociados a esta noticia antes de la actualización
        $queryMunicipiosActuales = "SELECT categoria_id FROM noticia_cMunicipio WHERE noticia_id = ?";
        $stmtMunicipiosActuales = $conexion->prepare($queryMunicipiosActuales);
        $stmtMunicipiosActuales->bind_param("i", $idNoticia);
        $stmtMunicipiosActuales->execute();
        $resultMunicipiosActuales = $stmtMunicipiosActuales->get_result();

        $municipiosActuales = array();
        while ($row = $resultMunicipiosActuales->fetch_assoc()) {
            $municipiosActuales[] = $row['categoria_id'];
        }

        $stmtMunicipiosActuales->close();

        // Identificar municipios a eliminar
        $municipiosEliminar = array_diff($municipiosActuales, $cMunicipios);

        // Identificar nuevos municipios a agregar
        $municipiosAgregar = array_diff($cMunicipios, $municipiosActuales);

        // Eliminar municipios deseleccionados
        if (!empty($municipiosEliminar)) {
            $queryEliminarMunicipios = "DELETE FROM noticia_cMunicipio WHERE noticia_id = ? AND categoria_id IN (" . implode(",", $municipiosEliminar) . ")";
            $stmtEliminarMunicipios = $conexion->prepare($queryEliminarMunicipios);
            $stmtEliminarMunicipios->bind_param("i", $idNoticia);
            $stmtEliminarMunicipios->execute();
            $stmtEliminarMunicipios->close();
        }

        // Insertar nuevos municipios seleccionados
        if (!empty($municipiosAgregar)) {
            $queryInsertarMunicipio = "INSERT INTO noticia_cMunicipio (noticia_id, categoria_id) VALUES (?, ?)";
            $stmtInsertarMunicipio = $conexion->prepare($queryInsertarMunicipio);

            foreach ($municipiosAgregar as $municipio) {
                $stmtInsertarMunicipio->bind_param("ii", $idNoticia, $municipio);
                $stmtInsertarMunicipio->execute();
            }

            $stmtInsertarMunicipio->close();
        }


        // Verificar si se proporcionó una categoría y si es una inserción o actualización
        if ($cLugar === "0") {
            // Si se seleccionó "Ninguno" para el lugar, eliminar la categoría de la base de datos
            $queryDeleteLugar = "DELETE FROM noticia_cLugar WHERE noticia_id = ?";
            $stmtDeleteLugar = $conexion->prepare($queryDeleteLugar);
            $stmtDeleteLugar->bind_param("i", $idNoticia);
            $stmtDeleteLugar->execute();
            $stmtDeleteLugar->close();
        } elseif ($cLugar) {
            // Si se seleccionó una categoría distinta de "Ninguno", realizar la inserción o actualización normalmente
            $queryCheckLugar = "SELECT * FROM noticia_cLugar WHERE noticia_id = ?";
            $stmtCheckLugar = $conexion->prepare($queryCheckLugar);
            $stmtCheckLugar->bind_param("i", $idNoticia);
            $stmtCheckLugar->execute();
            $resultCheckLugar = $stmtCheckLugar->get_result();

            if ($resultCheckLugar->num_rows > 0) {
                // La categoría ya existe, actualizarla
                $queryUpdateLugar = "UPDATE noticia_cLugar SET categoria_id = ? WHERE noticia_id = ?";
                $stmtUpdateLugar = $conexion->prepare($queryUpdateLugar);
                $stmtUpdateLugar->bind_param("ii", $cLugar, $idNoticia);
                $stmtUpdateLugar->execute();
                $stmtUpdateLugar->close();
            } else {
                // La categoría no existe, insertarla
                $queryInsertLugar = "INSERT INTO noticia_cLugar (noticia_id, categoria_id) VALUES (?, ?)";
                $stmtInsertLugar = $conexion->prepare($queryInsertLugar);
                $stmtInsertLugar->bind_param("ii", $idNoticia, $cLugar);
                $stmtInsertLugar->execute();
                $stmtInsertLugar->close();
            }

            $stmtCheckLugar->close();
        }

        // Verificar si se proporcionó una categoría y si es una inserción o actualización
        if ($cActividad === "0") {
            // Si se seleccionó "Ninguno" para la actividad, eliminar la categoría de la base de datos
            $queryDeleteActividad = "DELETE FROM noticia_cActividad WHERE noticia_id = ?";
            $stmtDeleteActividad = $conexion->prepare($queryDeleteActividad);
            $stmtDeleteActividad->bind_param("i", $idNoticia);
            $stmtDeleteActividad->execute();
            $stmtDeleteActividad->close();
        } elseif ($cActividad) {
            // Si se seleccionó una categoría distinta de "Ninguno", realizar la inserción o actualización normalmente
            $queryCheckActividad = "SELECT * FROM noticia_cActividad WHERE noticia_id = ?";
            $stmtCheckActividad = $conexion->prepare($queryCheckActividad);
            $stmtCheckActividad->bind_param("i", $idNoticia);
            $stmtCheckActividad->execute();
            $resultCheckActividad = $stmtCheckActividad->get_result();

            if ($resultCheckActividad->num_rows > 0) {
                // La categoría ya existe, actualizarla
                $queryUpdateActividad = "UPDATE noticia_cActividad SET categoria_id = ? WHERE noticia_id = ?";
                $stmtUpdateActividad = $conexion->prepare($queryUpdateActividad);
                $stmtUpdateActividad->bind_param("ii", $cActividad, $idNoticia);
                $stmtUpdateActividad->execute();
                $stmtUpdateActividad->close();
            } else {
                // La categoría no existe, insertarla
                $queryInsertActividad = "INSERT INTO noticia_cActividad (noticia_id, categoria_id) VALUES (?, ?)";
                $stmtInsertActividad = $conexion->prepare($queryInsertActividad);
                $stmtInsertActividad->bind_param("ii", $idNoticia, $cActividad);
                $stmtInsertActividad->execute();
                $stmtInsertActividad->close();
            }

            $stmtCheckActividad->close();
        }


        // Verificar si se proporcionó una categoría y si es una inserción o actualización
        if ($cEvento === "0") {
            // Si se seleccionó "Ninguno" para el evento, eliminar la categoría de la base de datos
            $queryDeleteEvento = "DELETE FROM noticia_cEvento WHERE noticia_id = ?";
            $stmtDeleteEvento = $conexion->prepare($queryDeleteEvento);
            $stmtDeleteEvento->bind_param("i", $idNoticia);
            $stmtDeleteEvento->execute();
            $stmtDeleteEvento->close();
        } elseif ($cEvento) {
            // Si se seleccionó una categoría distinta de "Ninguno", realizar la inserción o actualización normalmente
            $queryCheckEvento = "SELECT * FROM noticia_cEvento WHERE noticia_id = ?";
            $stmtCheckEvento = $conexion->prepare($queryCheckEvento);
            $stmtCheckEvento->bind_param("i", $idNoticia);
            $stmtCheckEvento->execute();
            $resultCheckEvento = $stmtCheckEvento->get_result();

            if ($resultCheckEvento->num_rows > 0) {
                // La categoría ya existe, actualizarla
                $queryUpdateEvento = "UPDATE noticia_cEvento SET categoria_id = ? WHERE noticia_id = ?";
                $stmtUpdateEvento = $conexion->prepare($queryUpdateEvento);
                $stmtUpdateEvento->bind_param("ii", $cEvento, $idNoticia);
                $stmtUpdateEvento->execute();
                $stmtUpdateEvento->close();
            } else {
                // La categoría no existe, insertarla
                $queryInsertEvento = "INSERT INTO noticia_cEvento (noticia_id, categoria_id) VALUES (?, ?)";
                $stmtInsertEvento = $conexion->prepare($queryInsertEvento);
                $stmtInsertEvento->bind_param("ii", $idNoticia, $cEvento);
                $stmtInsertEvento->execute();
                $stmtInsertEvento->close();
            }

            $stmtCheckEvento->close();
        }

        // Redirigir después de la actualización
        header("Location: ../../../../CrudNoticia.php");
        exit();
    } else {
        echo "Error al actualizar la noticia: " . $conexion->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $conexion->close();
} else {
    header("Location: ../../../../CrudNoticia.php");
    exit();
}
?>