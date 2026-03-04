<?php
// Incluir archivo de conexión a la base de datos
include '../../../../conexionBD.php';

// Verificar si se ha recibido el formulario por el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Aquí procesaremos los datos recibidos del formulario
    // Puedes empezar obteniendo los valores de los campos del formulario
    $id_evento = $_POST['id_evento'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $correos = $_POST['correos'];
    $telefonos = $_POST['telefonos'];
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];
    $horario = $_POST['horario'];
    $lugar = $_POST['lugar'];
    $coordenadas = $_POST['coordenadas'];
    $video = $_POST['video'];
    $internoExterno = $_POST['internoExterno'];
    $categoria = $_POST['categoria'];

    // Preparar la consulta SQL para actualizar los datos
    $query = "UPDATE listaeventos SET
              titulo = ?,
              descripcion = ?,
              correos = ?,
              telefonos = ?,
              fechaInicio = ?,
              fechaFin = ?,
              horario = ?,
              lugar = ?,
              coordenadas = ?,
              video = ?,
              internoExterno = ?,
              categoria = ?
              WHERE id = ?";

    // Preparar la declaración
    if ($stmt = $conexion->prepare($query)) {
        // Vincular los parámetros
        $stmt->bind_param(
            "ssssssssssssi", 
            $titulo, 
            $descripcion, 
            $correos, 
            $telefonos, 
            $fechaInicio, 
            $fechaFin, 
            $horario, 
            $lugar, 
            $coordenadas, 
            $video, 
            $internoExterno, 
            $categoria, 
            $id_evento
        );

        // Ejecutar la declaración
        if ($stmt->execute()) {
            // Actualización exitosa
            header("Location: exito.php");
            header("Location: ../../../../CrudEvento.php");
            exit();
        } else {
            // Error en la ejecución
            echo "Error: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        // Error en la preparación de la declaración
        echo "Error: " . $conexion->error;
    }
}
?>
