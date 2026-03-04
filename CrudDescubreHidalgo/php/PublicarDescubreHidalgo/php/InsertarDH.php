<?php

include '../../../../conexionBD.php'; // Incluir archivo de conexión a la base de datos

// Recoger datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $lugar = $_POST["lugar"];
    $coordenadas = $_POST["coordenadas"];
    $enlace = $_POST["enlace"];

    // Obtener el nombre de usuario de la sesión
    session_start();
    $nombreusuario = $_SESSION["usuario_nombre"];

    // Procesar la imagen seleccionada
    $img = $_FILES["imgPrincipal"]["name"];

    $direcionGuardadoImagen = "../../../../ImagenesInsertadasDescubreHidalgo/";
    $direccionPublica = "ImagenesInsertadasDescubreHidalgo/";

    $nombreUnico = uniqid() . "_" . $img; // Generar un nombre único para la imagen    

    $rutaGuardarImagen = $direcionGuardadoImagen . $nombreUnico;
    $rutaPublicaImagen = $direccionPublica . $nombreUnico;

    move_uploaded_file($_FILES["imgPrincipal"]["tmp_name"], $rutaGuardarImagen);

    // Utilizar sentencia preparada para insertar los datos en la tabla DescubreHidalgo
    $insertar_descubre = $conexion->prepare("INSERT INTO DescubreHidalgo (TituloMarcador, Descripcion, lugar, coordenadas, img, enlace, nombreusuario) 
                         VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Vincular parámetros a la sentencia preparada
    $insertar_descubre->bind_param("sssssss", $titulo, $descripcion, $lugar, $coordenadas, $rutaPublicaImagen, $enlace, $nombreusuario);

    // Ejecutar la sentencia preparada
    if ($insertar_descubre->execute()) {
        
        $cssFilePath = '../../../../Generales/Generales.css';
        echo '<link rel="stylesheet" type="text/css" href="' . $cssFilePath . '">';

        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            var modal = document.createElement("div");
            modal.classList.add("modal");
            
            var modalContent = document.createElement("div");
            modalContent.classList.add("modal-content");
            
            var mensaje = document.createElement("p");
            mensaje.textContent = "Tu marcador se ha publicado.";
            
            var verMarcadorBtn = document.createElement("button");
            verMarcadorBtn.textContent = "Ver Marcador";
            verMarcadorBtn.classList.add("cardboton");
            verMarcadorBtn.onclick = function() {
                window.location.href = "../../../../DescubreHidalgo/index.html";
            };
            
            var irMenuBtn = document.createElement("button");
            irMenuBtn.textContent = "Ir al Menú";
            irMenuBtn.classList.add("cardboton");
            irMenuBtn.onclick = function() {
                window.location.href = "../../../../MenuUsuario.php";
            };
    
            var insertarOtraBtn = document.createElement("button");
            insertarOtraBtn.textContent = "Insertar otro marcador";
            insertarOtraBtn.classList.add("cardboton");
            insertarOtraBtn.onclick = function() {
                window.location.href = "../../../../CrudDescubreHidalgo/php/PublicarDescubreHidalgo.php";
            };
            
            modalContent.appendChild(mensaje);
            modalContent.appendChild(verMarcadorBtn);
            modalContent.appendChild(irMenuBtn);
            modalContent.appendChild(insertarOtraBtn); 
            
            modal.appendChild(modalContent);
            
            document.body.appendChild(modal);
        });
    </script>';

    } else {
        echo "Error al insertar el marcador: " . $insertar_descubre->error;
    }

    // Cerrar la sentencia preparada
    $insertar_descubre->close();
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
