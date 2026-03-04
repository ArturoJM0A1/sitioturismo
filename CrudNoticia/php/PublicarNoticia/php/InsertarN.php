<?php
include '../../../../conexionBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Datos del formulario
    $titulo = $_POST["titulo"];
    $subtitulo = $_POST["subtitulo"];
    $descripcion = $_POST["descripcion"];
    $fecha = $_POST["fecha"];
    $internoExterno = $_POST["internoExterno"];
    $Alineacion = $_POST["Alineacion"];
    $autor = $_POST["autor"];
    $enlace = $_POST["enlace"];
    $Relevante = 0; // Valor por defecto

    // Obtener el nombre de usuario de la sesión
    session_start();
    $nombreusuario = $_SESSION["usuario_nombre"];

    $cAreaGeografica = $_POST["cAreaGeografica"];
    $cMunicipios = isset($_POST["municipio"]) ? $_POST["municipio"] : []; // Asignar un array vacío si no se selecciona ningún municipio
    $cLugar = $_POST["cLugar"];
    $cActividad = $_POST["cActividad"];
    $cEvento = $_POST["cEvento"];

    // Si no se ha seleccionado ninguna imagen, usar la imagen por defecto
    if ($_FILES["img"]["size"] == 0) {
        $rutaPublicaImagen = "Index/imagenes/logohgo2019color.png"; // Ruta de la imagen por defecto
    } else {
        // Procesar la imagen seleccionada
        $img = $_FILES["img"]["name"];

        $direcionGuardadoImagen = "../../../../ImagenesInsertadasNoticias/";
        $direccionPublica = "ImagenesInsertadasNoticias/";

        $nombreUnico = uniqid() . "_" . $img; // Generar un nombre único para la imagen    

        $rutaGuardarImagen = $direcionGuardadoImagen . $nombreUnico;
        $rutaPublicaImagen = $direccionPublica . $nombreUnico;

        move_uploaded_file($_FILES["img"]["tmp_name"], $rutaGuardarImagen);
    }

    // Utilizar sentencia preparada para insertar la noticia
    $insertar_noticia = $conexion->prepare("INSERT INTO listanoticias (titulo, subtitulo, descripcion, fecha, internoExterno, img, alineacion, autor, enlace, Relevante, nombreusuario) 
                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Indicar que todos los datos son cadenas de texto excepto Relevante que es un entero
    $insertar_noticia->bind_param("sssssssssis", $titulo, $subtitulo, $descripcion, $fecha, $internoExterno, $rutaPublicaImagen, $Alineacion, $autor, $enlace, $Relevante, $nombreusuario);

    if ($insertar_noticia->execute()) {
        $id_noticia = $conexion->insert_id;

        // Insertar categorías con sentencias preparadas
        $insertar_cAreaGeografica = $conexion->prepare("INSERT INTO noticia_cAreaGeografica (noticia_id, categoria_id) VALUES (?, ?)");
        $insertar_cAreaGeografica->bind_param("ii", $id_noticia, $cAreaGeografica);
        $insertar_cAreaGeografica->execute();
        $insertar_cAreaGeografica->close();

        // Insertar múltiples municipios
        $insertar_cMunicipio = $conexion->prepare("INSERT INTO noticia_cMunicipio (noticia_id, categoria_id) VALUES (?, ?)");
        if (!empty($cMunicipios)) {
            foreach ($cMunicipios as $municipio) {
                $insertar_cMunicipio->bind_param("ii", $id_noticia, $municipio);
                $insertar_cMunicipio->execute();
            }
        } else {
            $categoria_id = 0; // Valor por defecto si no se selecciona ningún municipio
            $insertar_cMunicipio->bind_param("ii", $id_noticia, $categoria_id);
            $insertar_cMunicipio->execute();
        }
        $insertar_cMunicipio->close();

        $insertar_cLugar = $conexion->prepare("INSERT INTO noticia_cLugar (noticia_id, categoria_id) VALUES (?, ?)");
        $insertar_cLugar->bind_param("ii", $id_noticia, $cLugar);
        $insertar_cLugar->execute();
        $insertar_cLugar->close();

        $insertar_cActividad = $conexion->prepare("INSERT INTO noticia_cActividad (noticia_id, categoria_id) VALUES (?, ?)");
        $insertar_cActividad->bind_param("ii", $id_noticia, $cActividad);
        $insertar_cActividad->execute();
        $insertar_cActividad->close();

        $insertar_cEvento = $conexion->prepare("INSERT INTO noticia_cEvento (noticia_id, categoria_id) VALUES (?, ?)");
        $insertar_cEvento->bind_param("ii", $id_noticia, $cEvento);
        $insertar_cEvento->execute();
        $insertar_cEvento->close();


        $cssFilePath = '../../../../Generales/Generales.css';
        echo '<link rel="stylesheet" type="text/css" href="' . $cssFilePath . '">';

        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            var modal = document.createElement("div");
            modal.classList.add("modal");
            
            var modalContent = document.createElement("div");
            modalContent.classList.add("modal-content");
            
            var mensaje = document.createElement("p");
            mensaje.textContent = "Tu noticia se ha publicado.";
            
            var verNoticiaBtn = document.createElement("button");
            verNoticiaBtn.textContent = "Ver Noticia";
            verNoticiaBtn.classList.add("cardboton");
            verNoticiaBtn.onclick = function() {
                window.location.href = "../../../../CompletaNoticia.php?id=' . $id_noticia . '";
            };
            
            var irMenuBtn = document.createElement("button");
            irMenuBtn.textContent = "Ir al Menú";
            irMenuBtn.classList.add("cardboton");
            irMenuBtn.onclick = function() {
                window.location.href = "../../../../MenuUsuario.php";
            };
    
            var insertarOtraBtn = document.createElement("button");
            insertarOtraBtn.textContent = "Insertar otra noticia";
            insertarOtraBtn.classList.add("cardboton");
            insertarOtraBtn.onclick = function() {
                window.location.href = "../../../../CrudNoticia/php/PublicarNoticia.php";
            };
            
            modalContent.appendChild(mensaje);
            modalContent.appendChild(verNoticiaBtn);
            modalContent.appendChild(irMenuBtn);
            modalContent.appendChild(insertarOtraBtn); 
            
            modal.appendChild(modalContent);
            
            document.body.appendChild(modal);
        });
    </script>';


    } else {
        echo "Error al insertar la noticia: " . $conexion->error;
    }

    $insertar_noticia->close();
}
?>