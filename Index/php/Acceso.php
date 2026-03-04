<?php
include '../../conexionBD.php';

$usuario = $_POST["usuario"];
$contraseña = $_POST["pass"];

$sql = "SELECT id, nombre, rol FROM usuarios WHERE nombre = '$usuario' AND pass = '$contraseña'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    session_start();
    $_SESSION["usuario_id"] = $row["id"];
    $_SESSION["usuario_nombre"] = $row["nombre"];
    $_SESSION["usuario_rol"] = $row["rol"];

    // Imprimir mensajes específicos según el rol
    if ($row["rol"] == 'Admin') {
        echo "admin_success";
    } elseif ($row["rol"] == 'Prensa') {
        echo "Prensa_success";
    } elseif ($row["rol"] == 'Jefe de edicion Prensa') {
        echo "edicionP_success";
    } elseif ($row["rol"] == 'Jefe de edicion Marketing') {
        echo "edicionM_success";
    } elseif ($row["rol"] == 'Marketing') {
        echo "Marketing_success";
    }
} else {
    echo "error";
}

$conexion->close();
?>