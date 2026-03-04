<?php
include '../../../../conexionBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idImagen = $_POST['idImagen'];
    $idEvento = $_POST['idEvento'];

    // Iniciar una transacción para asegurar la integridad de la base de datos
    $conexion->begin_transaction();

    try {
        // Establecer todas las imágenes del evento como no principales (esprincipal = 0)
        $query_reset = "UPDATE listaeventos_imagenes SET esprincipal = 0 WHERE evento_id = ?";
        $stmt_reset = $conexion->prepare($query_reset);
        $stmt_reset->bind_param("i", $idEvento);
        $stmt_reset->execute();

        // Establecer la imagen seleccionada como principal (esprincipal = 1)
        $query_set = "UPDATE listaeventos_imagenes SET esprincipal = 1 WHERE id = ?";
        $stmt_set = $conexion->prepare($query_set);
        $stmt_set->bind_param("i", $idImagen);
        $stmt_set->execute();

        // Confirmar la transacción
        $conexion->commit();
        echo json_encode(["exito" => true]);
    } catch (Exception $e) {
        // En caso de error, revertir la transacción
        $conexion->rollback();
        echo json_encode(["exito" => false, "mensaje" => $e->getMessage()]);
    }
} else {
    echo json_encode(["exito" => false, "mensaje" => "Solicitud no válida"]);
}
?>
