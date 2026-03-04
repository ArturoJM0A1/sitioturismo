<?php
// Incluir archivo de conexión a la base de datos
include '../../../../conexionBD.php';

// Verificar si se ha recibido un parámetro ID válido
if (isset($_POST['idImagen'])) {
    // Obtener el ID de la imagen desde la solicitud AJAX
    $idImagen = $_POST['idImagen'];

    // Consulta SQL para obtener la ruta de la imagen antes de eliminarla
    $query_select = "SELECT img FROM listaeventos_imagenes WHERE id = $idImagen";
    $result_select = $conexion->query($query_select);

    if ($result_select->num_rows > 0) {
        $row = $result_select->fetch_assoc();
        $rutaImagen = realpath('../../../../' . $row['img']); // Obtener la ruta real de la imagen

        // Verificar si la ruta es válida y si el archivo existe
        if ($rutaImagen && file_exists($rutaImagen)) {
            // Consulta SQL para eliminar la imagen de la base de datos
            $query_delete = "DELETE FROM listaeventos_imagenes WHERE id = $idImagen";
            if ($conexion->query($query_delete) === TRUE) {
                // Eliminar la imagen del sistema de archivos
                if (unlink($rutaImagen)) {
                    echo "Imagen eliminada correctamente.";
                } else {
                    echo "Error al eliminar el archivo de imagen.";
                }
            } else {
                echo "Error al eliminar la imagen de la base de datos: " . $conexion->error;
            }
        } else {
            echo "Archivo de imagen no encontrado.";
        }
    } else {
        echo "Imagen no encontrada en la base de datos.";
    }
} else {
    echo "ID de imagen no válido.";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
