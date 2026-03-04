<?php
include '../../conexionBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idNoticia = $_POST["idNoticia"];
    
    $query = "SELECT Relevante FROM listanoticias WHERE id = $idNoticia";
    $result = $conexion->query($query);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $relevante = $row["Relevante"];
        if ($relevante == 1) {
            $query_update = "UPDATE listanoticias SET Relevante = 0 WHERE id = $idNoticia";
        } else {
            $query_update = "UPDATE listanoticias SET Relevante = 1 WHERE id = $idNoticia";
        }
        
        if ($conexion->query($query_update) === TRUE) {
            echo "Noticia marcada como relevante correctamente.";
        } else {
            echo "Error al marcar la noticia como relevante: " . $conexion->error;
        }
    } else {
        echo "No se encontró la noticia.";
    }
}

$conexion->close();
?>
