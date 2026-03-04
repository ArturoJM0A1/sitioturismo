<?php
// Incluir el archivo de conexión a la base de datos
include '../../../../conexionBD.php';

// Verificar si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el ID de la noticia a eliminar desde los datos POST
    $noticiaId = $_POST['id'];

    // Preparar y ejecutar una consulta para verificar si la noticia existe en la base de datos
    $stmtVerificarExistencia = $conexion->prepare("SELECT id, img FROM listanoticias WHERE id = ?");
    $stmtVerificarExistencia->bind_param("i", $noticiaId);
    $stmtVerificarExistencia->execute();
    $stmtVerificarExistencia->store_result();

    // Verificar si la noticia existe en la base de datos
    if ($stmtVerificarExistencia->num_rows > 0) {
        // Obtener el ID y el nombre de la imagen asociada a la noticia
        $stmtVerificarExistencia->bind_result($id, $img);
        $stmtVerificarExistencia->fetch();

        // Iniciar una transacción en la base de datos
        $conexion->begin_transaction();

        try {
            // Eliminar la imagen asociada a la noticia si existe
            // Eliminar la imagen asociada a la noticia si existe, excepto si es "Index/imagenes/logohgo2019color.jpg"
            if (!empty ($img) && $img !== "Index/imagenes/logohgo2019color.jpg") {
                $rutaImagen = "../../../../" . $img;
                // Verificar si el archivo de la imagen existe en el servidor y eliminarlo
                if (file_exists($rutaImagen)) {
                    unlink($rutaImagen); // Eliminar la imagen del servidor
                }
            }

            // Eliminar relaciones de la noticia con otras entidades (tablas relacionadas)
            $queryEliminarRelaciones = "DELETE FROM noticia_cMunicipio WHERE noticia_id = ?";
            $stmtEliminarRelaciones = $conexion->prepare($queryEliminarRelaciones);
            $stmtEliminarRelaciones->bind_param("i", $noticiaId);
            $stmtEliminarRelaciones->execute();

            $queryEliminarRelaciones2 = "DELETE FROM noticia_cLugar WHERE noticia_id = ?";
            $stmtEliminarRelaciones2 = $conexion->prepare($queryEliminarRelaciones2);
            $stmtEliminarRelaciones2->bind_param("i", $noticiaId);
            $stmtEliminarRelaciones2->execute();

            $queryEliminarRelaciones3 = "DELETE FROM noticia_cActividad WHERE noticia_id = ?";
            $stmtEliminarRelaciones3 = $conexion->prepare($queryEliminarRelaciones3);
            $stmtEliminarRelaciones3->bind_param("i", $noticiaId);
            $stmtEliminarRelaciones3->execute();

            $queryEliminarRelaciones4 = "DELETE FROM noticia_cEvento WHERE noticia_id = ?";
            $stmtEliminarRelaciones4 = $conexion->prepare($queryEliminarRelaciones4);
            $stmtEliminarRelaciones4->bind_param("i", $noticiaId);
            $stmtEliminarRelaciones4->execute();

            $queryEliminarRelaciones5 = "DELETE FROM noticia_careageografica WHERE noticia_id = ?";
            $stmtEliminarRelaciones5 = $conexion->prepare($queryEliminarRelaciones5);
            $stmtEliminarRelaciones5->bind_param("i", $noticiaId);
            $stmtEliminarRelaciones5->execute();

            // Eliminar la noticia de la tabla 'listanoticias'
            $queryEliminarNoticia = "DELETE FROM listanoticias WHERE id = ?";
            $stmtEliminarNoticia = $conexion->prepare($queryEliminarNoticia);
            $stmtEliminarNoticia->bind_param("i", $noticiaId);
            $stmtEliminarNoticia->execute();

            // Confirmar la transacción
            $conexion->commit();
            // Imprimir mensaje de éxito
            echo 'success_delate';
        } catch (Exception $e) {
            // En caso de error, revertir la transacción
            $conexion->rollback();
            // Imprimir mensaje de error junto con el mensaje de la excepción
            echo 'error :(' . $e->getMessage();
        } finally {
            // Cerrar las declaraciones preparadas
            $stmtEliminarRelaciones->close();
            // Cerrar el resto de las declaraciones preparadas...
            $stmtEliminarNoticia->close();
            // Cerrar la conexión a la base de datos
            $conexion->close();
        }
    } else {
        // Si la noticia no existe en la base de datos, imprimir un mensaje de error
        echo 'error :(' . ' La noticia no existe';
    }
}
?>