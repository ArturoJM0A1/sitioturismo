<?php
include '../../../../conexionBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Datos del formulario
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $correos = $_POST["correos"];
    $telefonos = $_POST["telefonos"];
    $fechaInicio = $_POST["fechaInicio"];
    $fechaFin = $_POST["fechaFin"];
    $horario = $_POST["horario"];
    $lugar = $_POST["lugar"];
    $coordenadas = $_POST["coordenadas"];
    $video = $_POST["video"];
    $internoExterno = $_POST["internoExterno"];
    $categoria = $_POST["categoria"];
    $imgPrincipalName = $_POST["imgPrincipalName"]; // Obtener el nombre de la imagen principal

    // Obtener el nombre de usuario de la sesión
    session_start();
    $nombreusuario = $_SESSION["usuario_nombre"];

    // Procesar las imágenes seleccionadas
    if (!empty($_FILES["imagenes"]["name"][0])) {
        $images = array();
        $image_errors = array();

        // Utilizar sentencia preparada para insertar el evento
        $insertar_evento = $conexion->prepare("INSERT INTO listaeventos (titulo, descripcion, correos, telefonos, fechaInicio, fechaFin, horario, lugar, coordenadas, video, internoExterno, categoria, nombreusuario) 
                             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$insertar_evento) {
            die("Error al preparar la consulta: " . $conexion->error);
        }

        // Bind parameters
        $insertar_evento->bind_param("ssssssssssiss", $titulo, $descripcion, $correos, $telefonos, $fechaInicio, $fechaFin, $horario, $lugar, $coordenadas, $video, $internoExterno, $categoria, $nombreusuario);

        // Execute query
        if ($insertar_evento->execute()) {
            $id_evento = $conexion->insert_id;

            // Iterar sobre cada imagen
            foreach ($_FILES["imagenes"]["tmp_name"] as $key => $tmp_name) {
                $image_name = $_FILES["imagenes"]["name"][$key];
                $image_temp = $_FILES["imagenes"]["tmp_name"][$key];

                // Obtener la extensión del archivo original
                $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);

                // Generar un nombre único para la imagen
                $uniqueName = 'imagen_' . uniqid() . '_' . rand(100, 999) . '.' . $image_extension;
                $image_path = "ImagenesInsertadasEventos/" . $uniqueName;

                // Mover la imagen a su ubicación final con el nombre único
                if (move_uploaded_file($image_temp, "../../../../" . $image_path)) {
                    $images[] = $image_path;

                    // Determinar si esta imagen es la principal
                    if ($image_name === $imgPrincipalName) {
                        $es_principal = 1; // Esta es la imagen principal
                    } else {
                        $es_principal = 0; // No es la imagen principal
                    }

                    // Insertar la imagen en la base de datos
                    $insertar_imagen = $conexion->prepare("INSERT INTO listaeventos_imagenes (evento_id, img, esprincipal) VALUES (?, ?, ?)");
                    $insertar_imagen->bind_param("iss", $id_evento, $image_path, $es_principal);
                    $insertar_imagen->execute();
                    $insertar_imagen->close();
                } else {
                    $image_errors[] = $image_name;
                }
            }

            if (!empty($image_errors)) {
                echo "Error al cargar las siguientes imágenes: " . implode(", ", $image_errors);
                exit();
            }

            $cssFilePath = '../../../../Generales/Generales.css';
            echo '<link rel="stylesheet" type="text/css" href="' . $cssFilePath . '">';

            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var modal = document.createElement("div");
                modal.classList.add("modal");
                
                var modalContent = document.createElement("div");
                modalContent.classList.add("modal-content");
                
                var mensaje = document.createElement("p");
                mensaje.textContent = "Tu evento se ha publicado.";
                
                var verEventoBtn = document.createElement("button");
                verEventoBtn.textContent = "Ver Evento";
                verEventoBtn.classList.add("cardboton"); // Agregar clase cardboton
                verEventoBtn.onclick = function() {
                    window.location.href = "../../../../CompletoEvento.php?id=' . $id_evento . '";
                };
                
                var irMenuBtn = document.createElement("button");
                irMenuBtn.textContent = "Ir al Menú";
                irMenuBtn.classList.add("cardboton"); // Agregar clase cardboton
                irMenuBtn.onclick = function() {
                    window.location.href = "../../../../MenuUsuario.php";
                };


            var insertarOtraBtn = document.createElement("button");
            insertarOtraBtn.textContent = "Insertar otro evento";
            insertarOtraBtn.classList.add("cardboton");
            insertarOtraBtn.onclick = function() {
                window.location.href = "../../../../CrudEvento/php/PublicarEvento.php";
            };
                
                modalContent.appendChild(mensaje);
                modalContent.appendChild(verEventoBtn);
                modalContent.appendChild(irMenuBtn);
                modalContent.appendChild(insertarOtraBtn); 

                
                modal.appendChild(modalContent);
                
                document.body.appendChild(modal);
            });
            </script>';
        } else {
            echo "Error al insertar el evento: " . $conexion->error;
        }

        $insertar_evento->close();
    } else {
        echo "Debes subir al menos una imagen.";
        exit();
    }
}
?>