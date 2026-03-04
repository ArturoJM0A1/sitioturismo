<?php

include '../../../../conexionBD.php'; // Incluir archivo de conexión a la base de datos

// Recoger datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $lugar = $_POST["lugar"];
    $coordenadas = $_POST["coordenadas"];
    $enlace = $_POST["enlace"];
    $img_actual = $_POST["img_actual"];

    // Procesar la nueva imagen si se ha subido una
    if (!empty($_FILES["img"]["name"])) {
        $img = $_FILES["img"]["name"];
        $direccionGuardadoImagen = "../../../../ImagenesInsertadasDescubreHidalgo/";
        $direccionPublica = "ImagenesInsertadasDescubreHidalgo/";
        $nombreUnico = uniqid() . "_" . $img; // Generar un nombre único para la imagen
        $rutaGuardarImagen = $direccionGuardadoImagen . $nombreUnico;
        $rutaPublicaImagen = $direccionPublica . $nombreUnico;

        // Mover el archivo subido a la ubicación deseada
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $rutaGuardarImagen)) {
            // Si la imagen se ha subido correctamente, eliminar la imagen anterior
            if (file_exists("../../../../" . $img_actual)) {
                unlink("../../../../" . $img_actual);
            }
        } else {
            echo "Error al subir la nueva imagen.";
            exit();
        }
    } else {
        // Si no se ha subido una nueva imagen, mantener la imagen actual
        $rutaPublicaImagen = $img_actual;
    }

    // Utilizar sentencia preparada para actualizar los datos en la tabla DescubreHidalgo
    $actualizar_descubre = $conexion->prepare("UPDATE DescubreHidalgo SET TituloMarcador = ?, Descripcion = ?, lugar = ?, coordenadas = ?, img = ?, enlace = ? WHERE id = ?");

    // Vincular parámetros a la sentencia preparada
    $actualizar_descubre->bind_param("ssssssi", $titulo, $descripcion, $lugar, $coordenadas, $rutaPublicaImagen, $enlace, $id);

    // Ejecutar la sentencia preparada
    if ($actualizar_descubre->execute()) {
        // Redirigir después de la actualización
        header("Location: ../../../../CrudDescubreHidalgo.php");
        exit();
    } else {
        echo "Error al actualizar el marcador: " . $actualizar_descubre->error;
    }

    // Cerrar la sentencia preparada
    $actualizar_descubre->close();
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
