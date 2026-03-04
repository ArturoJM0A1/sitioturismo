<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="../Generales/Generales.css">
    <link rel="stylesheet" href="../Generales/tabla.css">

</head>

<body>
<button class="regresarMenuOIndex" id="MenuUsuario">Menu</button>
    <script>const MenuUsuario = document.getElementById('MenuUsuario');
        MenuUsuario.addEventListener('click', function () { window.location.href = '../MenuUsuario.php'; });
    </script>


    <h1>Lista de Usuarios</h1>

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

    // Mensaje de bienvenida
    $mensajeBienvenida = "Bienvenido Admin";

    // Verificar si se ha enviado la solicitud de actualización
    if (isset($_POST['actualizar']) && isset($_POST['id'])) {
        // Obtener los datos del formulario
        $idUsuarioActualizar = $_POST['id'];
        $nuevoNombre = $_POST['nuevoNombre'];
        $nuevoRol = $_POST['nuevoRol'];
        $nuevaContraseña = $_POST['nuevaContraseña'];

        // Query para obtener los datos actuales del usuario
        $sqlDatosActuales = "SELECT nombre, rol, pass FROM usuarios WHERE id = ?";
        $stmtDatosActuales = $conexion->prepare($sqlDatosActuales);
        $stmtDatosActuales->bind_param("i", $idUsuarioActualizar);
        $stmtDatosActuales->execute();
        $stmtDatosActuales->bind_result($nombreActual, $rolActual, $passActual);
        $stmtDatosActuales->fetch();
        $stmtDatosActuales->close();

        // Query para actualizar el nombre, rol y contraseña del usuario
        $sqlActualizar = "UPDATE usuarios SET ";
        $params = array();

        // Verificar si se proporcionó un nuevo nombre
        if (!empty($nuevoNombre)) {
            $sqlActualizar .= "nombre = ?";
            $params[] = $nuevoNombre;
        } else {
            $sqlActualizar .= "nombre = nombre"; // Conservar el nombre actual
        }


        // Verificar si se proporcionó un nuevo rol
        if (!empty($nuevoRol) && $nuevoRol != 'noaseleccionado') {
            $sqlActualizar .= ", rol = ?";
            $params[] = $nuevoRol;
        } else {
            $sqlActualizar .= ", rol = ?"; // Conservar el rol actual
            $params[] = $rolActual;
        }

        // Verificar si se proporcionó una nueva contraseña
        if (!empty($nuevaContraseña)) {
            $sqlActualizar .= ", pass = ?";
            $params[] = $nuevaContraseña;
        }

        $sqlActualizar .= " WHERE id = ?";
        $params[] = $idUsuarioActualizar;

        $stmtActualizar = $conexion->prepare($sqlActualizar);
        $stmtActualizar->bind_param(str_repeat("s", count($params)), ...$params);

        if ($stmtActualizar->execute()) {
            echo "<p class='success'>Usuario actualizado correctamente.";

            // Verificar si se actualizó el nombre
            if ($nuevoNombre != $nombreActual) {
                echo " Se actualizó el nombre de '$nombreActual' a '$nuevoNombre'.";
            }

            // Verificar si se actualizó el rol
            if ($nuevoRol != $rolActual) {
                echo " Se actualizó el rol de '$rolActual' a '$nuevoRol'.";
            }

            // Verificar si se actualizó la contraseña
            if ($nuevaContraseña != $passActual) {
                echo " Se actualizó la contraseña.";
            }
            echo "</p>";
        } else {
            echo "<p class='error'>Error al actualizar el usuario: " . $stmtActualizar->error . "</p>";
        }

        $stmtActualizar->close();
    }

    // Verificar si se ha enviado la solicitud de eliminación
    if (isset($_POST['eliminar']) && isset($_POST['id'])) {
        $idUsuarioEliminar = $_POST['id'];

        // Query para eliminar el usuario
        $sqlEliminar = "DELETE FROM usuarios WHERE id = ?";
        $stmtEliminar = $conexion->prepare($sqlEliminar);
        $stmtEliminar->bind_param("i", $idUsuarioEliminar);

        if ($stmtEliminar->execute()) {
            echo "<p class='success'>Usuario eliminado correctamente.</p>";
        } else {
            echo "<p class='error'>Error al eliminar el usuario: " . $stmtEliminar->error . "</p>";
        }

        $stmtEliminar->close();
    }


    // Query para obtener todos los usuarios
    $sql = "SELECT * FROM usuarios";
    $resultado = $conexion->query($sql);

    // Verificar si hay resultados
    if ($resultado->num_rows > 0) {
        // Mostrar los datos de cada usuario junto con un formulario para actualizar
        echo "<table class='tablatotal'>";
        echo "<tr><th>ID</th><th>Nombre actual</th><th>Rol actual</th><th>Contraseña actual</th><th>Acciones</th></tr>";
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila["id"] . "</td>";
            echo "<td>" . $fila["nombre"] . "</td>";
            echo "<td>" . $fila["rol"] . "</td>";
            echo "<td>" . $fila["pass"] . "</td>";
            echo "<td class='usuario-actions'>";

            // Formulario para actualizar (solo si el rol no es Admin)
            if ($fila['rol'] != 'Admin') {
                echo '<form method="post" action="?">';
                echo '<input type="hidden" name="id" value="' . $fila['id'] . '">';
                echo '<input type="text" name="nuevoNombre" placeholder="Nuevo Nombre" class="separdorBottom"><br>'; // Cambiamos el input y añadimos un salto de línea
                // Selección de Rol
    
                // Selección de Rol
                echo '<select name="nuevoRol" class="separdorBottom">';
                echo '<option disabled value="" selected>Selecciona una opción</option>'; // Opción predeterminada no seleccionable
                echo '<option value="Prensa"' . ($fila['rol'] == 'Prensa' ? ' selected' : '') . '>Prensa</option>';
                echo '<option value="Marketing"' . ($fila['rol'] == 'Marketing' ? ' selected' : '') . '>Marketing</option>';
                echo '<option value="Jefe de edicion Prensa"' . ($fila['rol'] == 'Jefe de edicion Prensa' ? ' selected' : '') . '>Jefe de edicion Prensa</option>';
                echo '<option value="Jefe de edicion Marketing"' . ($fila['rol'] == 'Jefe de edicion Marketing' ? ' selected' : '') . '>Jefe de edicion Marketing</option>';
                echo '</select><br>'; // Añadimos un salto de línea
    
                echo '<input type="password" name="nuevaContraseña" placeholder="Nueva Contraseña" class="separdorBottom"><br>'; // Cambiamos el input y añadimos un salto de línea
                echo '<button type="submit" class="cardboton separdorBottom" name="actualizar">Actualizar Usuario</button>';
                echo '<button type="submit" class="cardboton separdorBottom" name="eliminar">Eliminar Usuario</button>';
                echo '</form>';
            } else {
                echo "<p class='error'>No se puede editar al Admin.</p>";
            }

            echo "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p class='error'>No se encontraron usuarios.</p>";
    }

    // Cerrar la conexión
    $conexion->close();
    ?>

</body>

</html>