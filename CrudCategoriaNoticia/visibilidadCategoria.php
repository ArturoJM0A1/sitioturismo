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
    function actualizarVisibilidad($conexion, $tabla, $campo_id, $campo_visibilidad, $nombre_tabla)
    {
        if (isset ($_POST["editar_visibilidad_$nombre_tabla"]) && !empty ($_POST["editar_visibilidad_$nombre_tabla"]) && isset ($_POST["nueva_visibilidad_$nombre_tabla"])) {
            $subcategoria_id = $_POST["editar_visibilidad_$nombre_tabla"];
            $nueva_visibilidad = $_POST["nueva_visibilidad_$nombre_tabla"];
            $nombre_subcategoria = obtenerNombreSubcategoria($conexion, $tabla, $campo_id, $subcategoria_id);
            $sql = "UPDATE $tabla SET $campo_visibilidad='$nueva_visibilidad' WHERE $campo_id='$subcategoria_id'";
            if ($conexion->query($sql) === TRUE) {
                echo "Visibilidad de la subcategoría '$nombre_subcategoria' actualizada a ";
                echo $nueva_visibilidad == 1 ? "Visible." : "No Visible.";
            } else {
                echo "Error al actualizar la visibilidad de la subcategoría de $nombre_tabla: " . $conexion->error;
            }
        }
    }

    function obtenerNombreSubcategoria($conexion, $tabla, $campo_id, $id)
    {
        $sql = "SELECT nombre FROM $tabla WHERE $campo_id='$id'";
        $result = $conexion->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['nombre'];
        } else {
            return "";
        }
    }

    actualizarVisibilidad($conexion, "categoriaMunicipio", "id", "visible", "municipio");
    actualizarVisibilidad($conexion, "categoriaLugar", "id", "visible", "lugar");
    actualizarVisibilidad($conexion, "categoriaActividad", "id", "visible", "actividad");
    actualizarVisibilidad($conexion, "categoriaEvento", "id", "visible", "evento");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar visibilidad de subcategorías</title>
    <link rel="stylesheet" href="../Generales/Generales.css">
    <link rel="stylesheet" href="../Generales/tabla.css">
</head>

<body>
<button class="regresarMenuOIndex" id="MenuUsuario">Menu</button>
    <script>const MenuUsuario = document.getElementById('MenuUsuario');
        MenuUsuario.addEventListener('click', function () { window.location.href = '../MenuUsuario.php'; });
    </script>

    <h2 class="tituloactividad">Editar visibilidad de subcategorías</h2>

    <!-- Formulario para editar la visibilidad de subcategorías de municipio -->
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="editar_visibilidad_municipio">Seleccionar Subcategoría de Municipio:</label>
        <select id="editar_visibilidad_municipio" name="editar_visibilidad_municipio" required
            onchange="showStatus('municipio')">
            <option value="">Selecciona una opción</option>
            <?php
            $sql = "SELECT id, nombre, visible FROM categoriaMunicipio";
            $result = $conexion->query($sql);
            while ($row = $result->fetch_assoc()) {
                $visibility = $row['visible'] == 1 ? "Visible" : "No Visible";
                echo "<option value='" . $row['id'] . "'>$visibility - " . $row['nombre'] . "</option>";
            }
            ?>
        </select>
        <label for="nueva_visibilidad_municipio">Nueva Visibilidad:</label>
        <select id="nueva_visibilidad_municipio" name="nueva_visibilidad_municipio" required>
            <option value="1">Visible</option>
            <option value="0">No Visible</option>
        </select>
        <br>
        <div id="status_municipio" class="statusCategoria"></div>
        <input type="submit" value="Actualizar" class="cardboton">
    </form>


    <br>


    <!-- Formulario para editar la visibilidad de subcategorías de lugar -->
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="editar_visibilidad_lugar">Seleccionar Subcategoría de Lugar:</label>
        <select id="editar_visibilidad_lugar" name="editar_visibilidad_lugar" required onchange="showStatus('lugar')">
            <option value="">Selecciona una opción</option>
            <?php
            $sql = "SELECT id, nombre, visible FROM categoriaLugar";
            $result = $conexion->query($sql);
            while ($row = $result->fetch_assoc()) {
                $visibility = $row['visible'] == 1 ? "Visible" : "No Visible";
                echo "<option value='" . $row['id'] . "'>$visibility - " . $row['nombre'] . "</option>";
            }
            ?>
        </select>
        <label for="nueva_visibilidad_lugar">Nueva Visibilidad:</label>
        <select id="nueva_visibilidad_lugar" name="nueva_visibilidad_lugar" required>
            <option value="1">Visible</option>
            <option value="0">No Visible</option>
        </select>
        <br>
        <div id="status_lugar" class="statusCategoria"></div>
        <input type="submit" value="Actualizar" class="cardboton">
    </form>

    <br>

    <!-- Formulario para editar la visibilidad de subcategorías de actividad -->
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="editar_visibilidad_actividad">Seleccionar Subcategoría de Actividad:</label>
        <select id="editar_visibilidad_actividad" name="editar_visibilidad_actividad" required
            onchange="showStatus('actividad')">
            <option value="">Selecciona una opción</option>
            <?php
            $sql = "SELECT id, nombre, visible FROM categoriaActividad";
            $result = $conexion->query($sql);
            while ($row = $result->fetch_assoc()) {
                $visibility = $row['visible'] == 1 ? "Visible" : "No Visible";
                echo "<option value='" . $row['id'] . "'>$visibility - " . $row['nombre'] . "</option>";
            }
            ?>
        </select>
        <label for="nueva_visibilidad_actividad">Nueva Visibilidad:</label>
        <select id="nueva_visibilidad_actividad" name="nueva_visibilidad_actividad" required>
            <option value="1">Visible</option>
            <option value="0">No Visible</option>
        </select>
        <br>
        <div id="status_actividad" class="statusCategoria"></div>
        <input type="submit" value="Actualizar" class="cardboton">
    </form>

    <br>

    <!-- Formulario para editar la visibilidad de subcategorías de evento -->
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="editar_visibilidad_evento">Seleccionar Subcategoría de Evento:</label>
        <select id="editar_visibilidad_evento" name="editar_visibilidad_evento" required
            onchange="showStatus('evento')">
            <option value="">Selecciona una opción</option>
            <?php
            $sql = "SELECT id, nombre, visible FROM categoriaEvento";
            $result = $conexion->query($sql);
            while ($row = $result->fetch_assoc()) {
                $visibility = $row['visible'] == 1 ? "Visible" : "No Visible";
                echo "<option value='" . $row['id'] . "'>$visibility - " . $row['nombre'] . "</option>";
            }
            ?>
        </select>
        <label for="nueva_visibilidad_evento">Nueva Visibilidad:</label>
        <select id="nueva_visibilidad_evento" name="nueva_visibilidad_evento" required>
            <option value="1">Visible</option>
            <option value="0">No Visible</option>
        </select>
        <br>
        <div id="status_evento" class="statusCategoria"></div>
        <input type="submit" value="Actualizar" class="cardboton">
    </form>

    <script>
        function showStatus(nombre_tabla) {
            var selector = document.getElementById("editar_visibilidad_" + nombre_tabla);
            var statusDiv = document.getElementById("status_" + nombre_tabla);
            var selectedOption = selector.options[selector.selectedIndex].text;
            statusDiv.textContent = selectedOption;
        }
    </script>
</body>

</html>