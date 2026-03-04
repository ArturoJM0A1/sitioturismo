<?php
// Incluir el archivo de conexión a la base de datos
include '../../../../conexionBD.php';

// Verificar si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el ID del evento a eliminar desde los datos POST
    $eventoId = $_POST['id'];

    // Verificar si $eventoId es un entero
    if (!is_numeric($eventoId)) {
        die('error :(' . ' El ID del evento no es válido');
    }

    // Iniciar una transacción en la base de datos
    $conexion->begin_transaction();

    try {
        // Obtener las imágenes asociadas al evento desde la base de datos
        $stmtObtenerImagenes = $conexion->prepare("SELECT img FROM listaeventos_imagenes WHERE evento_id = ?");
        if (!$stmtObtenerImagenes) {
            throw new Exception('Error al preparar la consulta para obtener las imágenes del evento: ' . $conexion->error);
        }
        $stmtObtenerImagenes->bind_param("i", $eventoId);
        $stmtObtenerImagenes->execute();
        $stmtObtenerImagenes->store_result();

        // Iterar sobre las imágenes encontradas y eliminarlas físicamente del servidor
        $stmtObtenerImagenes->bind_result($img);
        while ($stmtObtenerImagenes->fetch()) {
            $rutaImagen = "../../../../" . $img;
            if (file_exists($rutaImagen)) {
                unlink($rutaImagen); // Eliminar la imagen del servidor
            }
        }
        $stmtObtenerImagenes->close(); // Cerrar la consulta de obtener imágenes

        // Eliminar las relaciones de imágenes del evento en la tabla 'listaeventos_imagenes'
        $queryEliminarImagenes = "DELETE FROM listaeventos_imagenes WHERE evento_id = ?";
        $stmtEliminarImagenes = $conexion->prepare($queryEliminarImagenes);
        if (!$stmtEliminarImagenes) {
            throw new Exception('Error al preparar la consulta para eliminar las imágenes del evento: ' . $conexion->error);
        }
        $stmtEliminarImagenes->bind_param("i", $eventoId);
        $stmtEliminarImagenes->execute();
        $stmtEliminarImagenes->close(); // Cerrar la consulta de eliminar imágenes

        // Eliminar el evento de la tabla 'listaeventos'
        $queryEliminarEvento = "DELETE FROM listaeventos WHERE id = ?";
        $stmtEliminarEvento = $conexion->prepare($queryEliminarEvento);
        if (!$stmtEliminarEvento) {
            throw new Exception('Error al preparar la consulta para eliminar el evento: ' . $conexion->error);
        }
        $stmtEliminarEvento->bind_param("i", $eventoId);
        $stmtEliminarEvento->execute();
        $stmtEliminarEvento->close(); // Cerrar la consulta de eliminar evento

        // Confirmar la transacción
        $conexion->commit();
        // Imprimir mensaje de éxito
        echo 'success_delete';
    } catch (Exception $e) {
        // En caso de error, revertir la transacción
        $conexion->rollback();
        // Imprimir mensaje de error junto con el mensaje de la excepción
        echo 'error :(' . $e->getMessage();
    } finally {
        // Cerrar la conexión a la base de datos
        $conexion->close();
    }
}
?>
