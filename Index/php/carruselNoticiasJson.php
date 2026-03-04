<?php
include '../../conexionBD.php';

$ConsultarNoticias = "SELECT * FROM listanoticias order by fecha DESC limit 10"; //Aqui indico el limite de resultados
$ResultadoConsultarNoticias = $conexion->query($ConsultarNoticias);

if ($ResultadoConsultarNoticias === false) {
    die("Error en la consulta: " . $conexion->error);
}

$ArrayNoticias = array();

while ($fila = $ResultadoConsultarNoticias->fetch_assoc()) {
    $ArrayNoticias[] = $fila;
}

// Convertir el array a formato JSON
$json_datosArrayNoticias = json_encode($ArrayNoticias);

// Limpiar el buffer de salida antes de imprimir el JSON
ob_clean();

echo $json_datosArrayNoticias;

$conexion->close();
?>
