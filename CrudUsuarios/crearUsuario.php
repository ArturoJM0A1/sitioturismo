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

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recibir datos del formulario
    $nombre = $_POST["nombre"];
    $rol = $_POST["rol"];

    // Obtener la contraseña del formulario
    $contrasena = $_POST["contrasena"];

    // Query para verificar si el usuario ya existe
    $sql_verificar = "SELECT COUNT(*) FROM usuarios WHERE nombre = ?";
    
    // Preparar la declaración
    $stmt_verificar = $conexion->prepare($sql_verificar);
    $stmt_verificar->bind_param("s", $nombre);
    $stmt_verificar->execute();
    $stmt_verificar->bind_result($count);
    $stmt_verificar->fetch();
    $stmt_verificar->close();

    if ($count > 0) {
        echo "<b>ERROR: EL NOMBRE DE USUARIO YA EXISTE.</b>";
    } else {
        // Query para insertar un nuevo usuario
        $sql_insertar = "INSERT INTO usuarios (nombre, rol, pass) VALUES (?, ?, ?)";
        
        // Preparar la declaración
        $stmt_insertar = $conexion->prepare($sql_insertar);
        
        // Vincular parámetros y ejecutar la declaración
        $stmt_insertar->bind_param("sss", $nombre, $rol, $contrasena);

        if ($stmt_insertar->execute()) {
            echo "<b>USUARIO CREADO EXITOSAMENTE.</b>";
        } else {
            echo "<b>ERROR AL CREAR EL USUARIO: " . $stmt_insertar->error . "</b>";
        }

        // Cerrar la declaración
        $stmt_insertar->close();
    }

    // Cerrar la conexión
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="stylesheet" href="../Generales/Generales.css">
    <link rel="stylesheet" href="../Generales/tabla.css">
</head>
<body>
<button class="regresarMenuOIndex" id="MenuUsuario">Menu</button>
    <script>const MenuUsuario = document.getElementById('MenuUsuario');
        MenuUsuario.addEventListener('click', function () { window.location.href = '../MenuUsuario.php'; });
    </script>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="formcenter">
        <h2>Registro de Usuario</h2>
        <br>
        <h6 style="text-align: center;">Se recomienda no repetir nombres, ni contraseñas</h6>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" placeholder="Nombre" class="separdorBottom" required>
        <label for="rol">Rol:</label>
        <select name="rol" class="separdorBottom" required>
            <option value="Prensa">Prensa</option>
            <option value="Jefe Edicion Prensa">Jefe de edicion Prensa</option>
            <option value="Jefe Edicion Marketing">Jefe de edicion Marketing</option>
            <option value="Marketing">Marketing</option>
            <option value="Admin">Admin</option>
        </select>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" placeholder="Contraseña" class="separdorBottom" required>
        <input type="submit" value="Registrar" class="cardboton separdorBottom">
    </form>

</body>
</html>
