<?php
// Incluir el archivo de conexión a la base de datos
include '../../conexionBD.php';

// Verificar si se recibió el parámetro searchQueryEventos
if (isset($_POST['searchQueryEventos'])) {
    // Obtener el término de búsqueda
    $searchQueryEventos = $_POST['searchQueryEventos'];

    // Consulta SQL para buscar eventos que coincidan con el término de búsqueda
    $query = "SELECT * FROM listaeventos WHERE titulo LIKE '%$searchQueryEventos%'";

    // Ejecutar la consulta
    $result = mysqli_query($conexion, $query);

    // Verificar si la consulta fue exitosa
    if ($result) {
        // Verificar si se obtuvieron resultados
        if (mysqli_num_rows($result) > 0) {
            // Iniciar la variable para almacenar el HTML de los resultados
            $output = '';

            // Iterar sobre los resultados y construir el HTML de salida
            while ($row = mysqli_fetch_assoc($result)) {
                $output .= '<div class="eventoEnBuscar">';
                $output .= '<h3>' . $row['titulo'] . '</h3>';
                $output .= '<p>Fecha de inicio: ' . $row['fechaInicio'] . ' - Fecha de fin: ' . $row['fechaFin'] . '</p>';
                $output .= '<p class="descripcion">' . $row['descripcion'] . '</p>';
                $output .= '<a class="verEvento" href="CompletoEvento.php?id=' . $row['id'] . '">Leer más</a>';
                // Agregar más información del evento según sea necesario
                $output .= '</div>';
            }

            // Imprimir los resultados
            echo $output;
        } else {
            // Si no se encontraron resultados
            echo '<p><b style="color: var(--vino)">No se encontraron eventos que coincidan con la búsqueda.</b></p>';
        }
    } else {
        // Si la consulta falló
        echo '<p>Error al realizar la búsqueda de eventos.</p>';
    }
} else {
    // Si no se recibió el parámetro searchQueryEventos
    echo '<p>No se recibió ningún término de búsqueda.</p>';
}
?>
