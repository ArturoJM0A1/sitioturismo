 <?php
// Incluir el archivo de conexión a la base de datos
include '../../../../conexionBD.php';

// Verificar si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el ID de la noticia a eliminar desde los datos POST
    $noticiaId = $_POST['id'];

    // Preparar y ejecutar una consulta para verificar si el marcador DescubreHidalgo existe en la base de datos
    $stmtVerificarExistencia = $conexion->prepare("SELECT id, img FROM DescubreHidalgo WHERE id = ?");
    $stmtVerificarExistencia->bind_param("i", $noticiaId);
    $stmtVerificarExistencia->execute();
    $stmtVerificarExistencia->store_result();

    // Verificar si el marcador DescubreHidalgo existe en la base de datos
    if ($stmtVerificarExistencia->num_rows > 0) {
        // Obtener el ID y el nombre de la imagen asociada al marcador
        $stmtVerificarExistencia->bind_result($id, $img);
        $stmtVerificarExistencia->fetch();

        // Iniciar una transacción en la base de datos
        $conexion->begin_transaction();

        try {
            // Eliminar la imagen asociada al marcador si existe
            // Eliminar la imagen asociada al marcador si existe excepto si es "Index/imagenes/logohgo2019color.jpg"
            if (!empty ($img) && $img !== "Index/imagenes/logohgo2019color.jpg") {
                $rutaImagen = "../../../../" . $img;
                // Verificar si el archivo de la imagen existe en el servidor y eliminarlo
                if (file_exists($rutaImagen)) {
                    unlink($rutaImagen); // Eliminar la imagen del servidor
                }
            }

            // Eliminar la noticia de la tabla 'listanoticias'
            $queryEliminarDescubreHidalgo = "DELETE FROM DescubreHidalgo WHERE id = ?";
            $stmtEliminarDescubreHidalgo = $conexion->prepare($queryEliminarDescubreHidalgo);
            $stmtEliminarDescubreHidalgo->bind_param("i", $noticiaId);
            $stmtEliminarDescubreHidalgo->execute();

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
            $stmtEliminarDescubreHidalgo->close();
            $conexion->close();
        }
    } else {
        echo 'error :(' . ' El marcador no existe';
    }
}
?>




