<?php

include '../conexionBD.php';
$consulta = $conexion->query("SELECT DISTINCT YEAR(fecha) AS año FROM listanoticias");
$opciones = array();
while ($fila = $consulta->fetch_assoc()) {
    $opciones[] = $fila;
}
echo json_encode($opciones);

$conexion->close();

?>
