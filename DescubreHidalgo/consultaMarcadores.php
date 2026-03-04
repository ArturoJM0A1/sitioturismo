<?php
include '../conexionBD.php'; // Incluye el archivo de conexión

// Consulta SQL para obtener los datos de la tabla DescubreHidalgo
$sql = "SELECT TituloMarcador, Descripcion, coordenadas, img, enlace FROM DescubreHidalgo";
$result = $conexion->query($sql); // Usa el objeto de conexión $conexion

// Array para almacenar los resultados
$rows = array();

// Verificar si hay resultados y guardarlos en el array
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
}

// Convertir el array a formato JSON
echo json_encode($rows);

// Cerrar resultado y conexión
$result->close();
$conexion->close();
?>
 