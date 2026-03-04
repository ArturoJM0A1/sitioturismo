<?php
include '../../conexionBD.php';

$ConsultarNoticias = "SELECT * FROM listaeventos WHERE internoExterno = 2 ORDER BY fechaInicio DESC LIMIT 10";

$ResultadoConsultarNoticias = $conexion->query($ConsultarNoticias);

if ($ResultadoConsultarNoticias === false) {
    die("Error en la consulta: " . $conexion->error);
}

$ArrayNoticias = array();

while ($fila = $ResultadoConsultarNoticias->fetch_assoc()) {
    // Obtener el ID del evento
    $idEvento = $fila['id'];

    // Consulta para obtener la imagen principal del evento
    $consultaImagenPrincipal = "SELECT img FROM listaeventos_imagenes WHERE evento_id = $idEvento AND esprincipal = 1 LIMIT 1";
    $resultadoConsultaImagenPrincipal = $conexion->query($consultaImagenPrincipal);

    // Verificar si se encontró una imagen principal
    if ($resultadoConsultaImagenPrincipal->num_rows > 0) {
        // Obtener la ruta de la imagen principal
        $filaImagenPrincipal = $resultadoConsultaImagenPrincipal->fetch_assoc();
        $rutaImagenPrincipal = $filaImagenPrincipal['img'];
        // Añadir la ruta de la imagen principal al array del evento
        $fila['imagenPrincipal'] = $rutaImagenPrincipal;
    } else {
        // No se encontró ninguna imagen principal
        $fila['imagenPrincipal'] = null;
    }

    // Agregar el evento al array de noticias
    $ArrayNoticias[] = $fila;
}

// Convertir el array a formato JSON
$json_datosArrayNoticias = json_encode($ArrayNoticias);

// Limpiar el buffer de salida antes de imprimir el JSON
ob_clean();

echo $json_datosArrayNoticias;

$conexion->close();
?>
