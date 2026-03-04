<?php
include '../conexionBD.php';
session_start();

// Verificar si el usuario está autenticado y obtener su nombre de usuario
if (isset($_SESSION["usuario_nombre"]) && !empty($_SESSION["usuario_nombre"])) {
    $nombreusuario = $_SESSION["usuario_nombre"];
} else {
    header("Location: ../index.html");
    exit();
}

// Verificar  el rol del usuario 
if ($_SESSION["usuario_rol"] !== "Admin") {
    header("Location: ../index.html");
    exit(); 
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["categoria"]) && isset($_POST["nueva_subcategoria"]) && !empty($_POST["nueva_subcategoria"]) && isset($_POST["visibilidad"])) {
        $categoria = $_POST["categoria"];
        $nueva_subcategoria = $_POST["nueva_subcategoria"];
        $visibilidad = $_POST["visibilidad"];

        switch ($categoria) {
            case "municipio":
                $tabla = "categoriaMunicipio";
                $nombre_categoria = "Municipio";
                break;
            case "lugar":
                $tabla = "categoriaLugar";
                $nombre_categoria = "Lugar";
                break;
            case "actividad":
                $tabla = "categoriaActividad";
                $nombre_categoria = "Actividad";
                break;
            case "evento":
                $tabla = "categoriaEvento";
                $nombre_categoria = "Evento";
                break;
            default:
                echo "Categoría no válida";
                exit();
        }

        $sql = "INSERT INTO $tabla (nombre, visible) VALUES ('$nueva_subcategoria', $visibilidad)";
        if ($conexion->query($sql) === TRUE) {
            echo "Nueva subcategoría '$nueva_subcategoria' para '$nombre_categoria' insertada exitosamente como " . ($visibilidad ? "visible" : "no visible") . ".";
        } else {
            echo "Error al insertar la nueva subcategoría para $nombre_categoria: " . $conexion->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar nuevas subcategorías</title>
    <link rel="stylesheet" href="../Generales/Generales.css">
    <link rel="stylesheet" href="../Generales/tabla.css">
</head>

<body>
<button class="regresarMenuOIndex" id="MenuUsuario">Menu</button>
    <script>const MenuUsuario = document.getElementById('MenuUsuario');
        MenuUsuario.addEventListener('click', function () { window.location.href = '../MenuUsuario.php'; });
    </script>

    <h2 class="tituloactividad">Insertar nuevas subcategorías</h2>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="categoria">Selecciona la categoría:</label>
        <select name="categoria" id="categoria">
            <option value="">Selecciona una opción</option>
            <option value="municipio">Municipio</option>
            <option value="lugar">Lugar</option>
            <option value="actividad">Actividad</option>
            <option value="evento">Evento</option>
        </select>

        <label for="nueva_subcategoria">Nueva Subcategoría:</label>
        <input type="text" id="nueva_subcategoria" name="nueva_subcategoria" required>

        <label for="visibilidad">Selecciona la visibilidad:</label>
        <select name="visibilidad" id="visibilidad">
            <option value="1">Visible</option>
            <option value="0">No visible</option>
        </select>

        <input type="submit" value="Insertar" class="cardboton">
    </form>
</body>

</html>
