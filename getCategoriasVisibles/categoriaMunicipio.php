<?php

include '../conexionBD.php';
$consulta = $conexion->query("SELECT id, nombre FROM categoriamunicipio WHERE visible = 1");
$opciones = array();
while ($fila = $consulta->fetch_assoc()) {
    $opciones[] = $fila;
}
echo json_encode($opciones);

$conexion->close();

?>
