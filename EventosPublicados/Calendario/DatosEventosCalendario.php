<?php
include '../../conexionBD.php';

// Verificar si el parámetro 'categoria' está presente en la solicitud GET
if (isset($_GET['categoria']) && isset($_GET['internoExterno'])) {
    $categoria = $_GET['categoria'];
    $internoExterno = $_GET['internoExterno'];
    
    // Si ambos parámetros están presentes, aplicar ambos filtros
    if ($categoria === "todas" && $internoExterno === "todos") {
        $sql = "SELECT fechaInicio, fechaFin, titulo, id, categoria, internoExterno FROM listaeventos";
    } elseif ($categoria === "todas") {
        // Si la categoría es "todas", seleccionar todos los eventos sin filtrar por categoría
        $sql = "SELECT fechaInicio, fechaFin, titulo, id, categoria, internoExterno FROM listaeventos WHERE internoExterno = $internoExterno";
    } elseif ($internoExterno === "todos") {
        // Si el interno/externo es "todos", seleccionar todos los eventos sin filtrar por interno/externo
        $sql = "SELECT fechaInicio, fechaFin, titulo, id, categoria, internoExterno FROM listaeventos WHERE categoria = $categoria";
    } else {
        // Si ambos parámetros tienen valores específicos, aplicar ambos filtros
        $sql = "SELECT fechaInicio, fechaFin, titulo, id, categoria, internoExterno FROM listaeventos WHERE categoria = $categoria AND internoExterno = $internoExterno";
    }
} elseif (isset($_GET['categoria'])) {
    $categoria = $_GET['categoria'];
    if ($categoria === "todas") {
        // Si la categoría es "todas", seleccionar todos los eventos sin filtrar por categoría
        $sql = "SELECT fechaInicio, fechaFin, titulo, id, categoria, internoExterno FROM listaeventos";
    } else {
        // Si 'categoria' no es "todas", seleccionar eventos solo de esa categoría
        $sql = "SELECT fechaInicio, fechaFin, titulo, id, categoria, internoExterno FROM listaeventos WHERE categoria = $categoria";
    }
} elseif (isset($_GET['internoExterno'])) {
    $internoExterno = $_GET['internoExterno'];
    if ($internoExterno === "todos") {
        $sql = "SELECT fechaInicio, fechaFin, titulo, id, categoria, internoExterno FROM listaeventos";
    } else {
        $sql = "SELECT fechaInicio, fechaFin, titulo, id, categoria, internoExterno FROM listaeventos WHERE internoExterno = $internoExterno";
    }
} else {
    $sql = "SELECT fechaInicio, fechaFin, titulo, id, categoria, internoExterno FROM listaeventos";
}

$result = $conexion->query($sql);

$eventos = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $fecha = date('m-d-Y', strtotime($row['fechaInicio']));
        $fechainicio = date('d-m-Y', strtotime($row['fechaInicio']));
        $fechaFin = date('d-m-Y', strtotime($row['fechaFin']));

        $titulo = $row['titulo'];
        $id = $row['id'];

        if (!isset($eventos[$fecha])) {
            $eventos[$fecha] = '';
        }

        $eventos[$fecha] .= "<span id=\"spanEvento\">
        Del: $fechainicio Hasta: $fechaFin <br>
        <b>$titulo</b> 
        <a class=\"verEvento\" href=\"CompletoEvento.php?id=$id\">Leer más</a>

        </span>";
    }
}

echo json_encode($eventos);

$conexion->close();
?>