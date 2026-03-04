<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar subcategorías</title>
    <link rel="stylesheet" href="../Generales/Generales.css">
    <link rel="stylesheet" href="../Generales/tabla.css">
</head>
<body>
<button class="regresarMenuOIndex" id="MenuUsuario">Menu</button>
    <script>const MenuUsuario = document.getElementById('MenuUsuario');
        MenuUsuario.addEventListener('click', function () { window.location.href = '../MenuUsuario.php'; });
    </script>
    
<?php
// Incluir el archivo de conexión a la base de datos
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

// Función para actualizar el nombre de la categoría
function actualizarNombreCategoria($id, $nuevoNombre, $tabla)
{
    global $conexion;

    $nuevoNombre = mysqli_real_escape_string($conexion, $nuevoNombre);
    $query = "UPDATE $tabla SET nombre = '$nuevoNombre' WHERE id = $id";
    mysqli_query($conexion, $query);
}

// Obtener todas las categorías disponibles
$categorias = [
    'categoriaareageografica' => 'Área geográfica',    
    'categoriamunicipio' => 'Municipio',
    'categorialugar' => 'Lugares',
    'categoriaactividad' => 'Actividades',
    'categoriaevento' => 'Eventos',
];

?>

<!-- Formulario de selección de categoría -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="categoria">Seleccione la categoría:</label>
    <select name="categoria" id="categoria">
        <?php
        foreach ($categorias as $clave => $valor) {
            echo "<option value='$clave'>$valor</option>";
        }
        ?>
    </select>
    <input type="submit" value="Seleccionar" class="cardboton">
</form>

<?php
// Verificar si se ha enviado el formulario de selección
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categoria'])) {
    $categoriaSeleccionada = $_POST['categoria'];

    if (array_key_exists($categoriaSeleccionada, $categorias)) {
        // Realizar acciones según la categoría seleccionada
        $categoria = $categoriaSeleccionada;
        $query = "SELECT * FROM $categoria";
        $tabla = "$categoria";

        $result = mysqli_query($conexion, $query);

        // Mostrar los resultados y formulario de modificación
        echo "<h2 class='tituloactividad'>Editar subcategorías</h2>";
        while ($row = mysqli_fetch_assoc($result)) {
            $idCategoria = $row['id'];
            $nombreCategoria = $row['nombre'];

            echo "$nombreCategoria 
                  <form method='post' action='{$_SERVER['PHP_SELF']}'>
                      <input type='hidden' name='idCategoria' value='$idCategoria'>
                      <input type='hidden' name='tablaCategoria' value='$tabla'>
                      <input type='text' name='nuevoNombre' placeholder='Nuevo nombre'>
                      <input type='submit' value='Cambiar Nombre' class='cardboton'>
                  </form><br>";
        }
    } else {
        // Manejar un caso por defecto o mostrar un mensaje de error
        echo "Categoría no válida";
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>

</body>
</html>
