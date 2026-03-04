<?php
include '../../../../conexionBD.php';

//Por ejemplo ponerle un valor de un ID evento 5
$eventoId = $_GET['id'];

$query = "SELECT img FROM listaeventos_imagenes WHERE evento_id = $eventoId";
$resultado = $conexion->query($query);

// Array para almacenar las imágenes
$imagenes = array();

if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $rutaImagen = $fila['img'];
        $imagenes[] = array("img" => $rutaImagen);
    }
}

$conexion->close();

$json = json_encode($imagenes, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

header('Content-Type: application/json');

echo $json;
?>