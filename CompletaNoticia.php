<?php
include 'conexionBD.php';

if (isset($_GET['id'])) {
    $noticiaId = $_GET['id'];

    $query = "SELECT * FROM listanoticias WHERE id = $noticiaId";
    $resultado = $conexion->query($query);

    if ($resultado && $resultado->num_rows > 0) {
        $noticia = $resultado->fetch_assoc();

        ?>
        <!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Ver Noticia</title>
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


            <link rel="stylesheet" href="Generales/Generales.css">
            <link rel="stylesheet" href="Generales/MenuOptions.css">
            <link rel="stylesheet" href="Generales/subMenu.css">

            <link rel="stylesheet" href="CompletaNoticia/CompletaNoticia.css">
        </head>

        <body>


            <div class="Menu">
                <div class="tab-nav-container">
                    <div class="TABmenu">
                        <i class="fa-solid fa-bars abrirmenu"></i>
                        <i class="fa-solid fa-xmark cerrarMenu"></i>
                        <p class="abrirTexto">Menu</p>
                        <p class="cerrarTexto">Cerrar</p>
                    </div>


                    <div class="tab pink" id="Inicio">
                        <i class="fas fa-home"></i>
                        <p>Inicio</p>
                    </div>
                    <div class="tab pink" id="Noticias">
                        <i class="fa-solid fa-newspaper"></i>
                        <p>Noticias</p>
                    </div>
                    <div class="tab pink" id="Eventos">
                        <i class="fa-solid fa-calendar-days"></i>
                        <p>Eventos</p>
                    </div>
                    <div class="tab pink" id="copiarNoticia">
                        <i class="fa-solid fa-copy"></i>
                        <p>Copiar</p>
                    </div>


                    <div class="tab pink" id="Menumedialsocial">
                        <i class="fa-solid fa-share-from-square"></i>
                        <p>Compartir</p>
                        <div class="contenedorListaOpciones">
                            <div class="listaOpciones">
                                <div class="filtros maximotamanofiltro">
                                    <div id="filtroMedialSocial">

                                        <button class="optionList" id="Facebook">
                                            <i class="fa-brands fa-facebook"></i>
                                            Facebook
                                        </button>

                                        <button class="optionList" id="Twitter">
                                            <i class="fa-brands fa-x-twitter"></i>
                                            Twitter
                                        </button>

                                        <button class="optionList" id="WhatsApp">
                                            <i class="fa-brands fa-whatsapp"></i>
                                            WhatsApp
                                        </button>

                                        <button class="optionList" id="Instagram">
                                            <i class="fa-brands fa-instagram"></i>
                                            Instagram
                                        </button>

                                        <button class="optionList" id="Telegram">
                                            <i class="fa-brands fa-telegram"></i>
                                            Telegram
                                        </button>


                                    </div>
                                </div>
                                <i class="fa-solid fa-xmark cerrarfiltro" id="XfiltroMedialSocial"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="fondo">
                <div class="todaNoticia" id="todaNoticia">
                    <div class="contenedorTarjeta">
                        <div class="TarjetaNoticia">

                            <p style="display:none" id="alineacionTexto">
                                <?= $noticia['alineacion'] ?>
                            </p>

                            <div class="caracteristicasTarjeta">
                                <div class="tituloyImagen">
                                    <div class="titulo">
                                        <?= $noticia['titulo'] ?>
                                    </div>
                                    <img class="Imagen" src="<?= $noticia['img'] ?>" alt="Imagen de la noticia">
                                    <div class="FechaNoticia">
                                        <?= date('d/m/Y', strtotime($noticia['fecha'])) ?>
                                    </div>
                                </div>
                                <div class="textoLargo">
                                    <div class="subtitulo">
                                        <?= $noticia['subtitulo'] ?>
                                    </div>
                                    <div class="descricion">
                                        <?= $noticia['descripcion'] ?>
                                    </div>

                                    <hr>

                                    <div class="autorenlace">
                                        <p>
                                            <b>Autor:</b>
                                            <?= $noticia['autor'] ?>
                                        </p>

                                        <?php if (!empty($noticia['enlace'])): ?>
                                            <!-- Verifica si el enlace no está vacío -->
                                            <a href="<?= $noticia['enlace'] ?>" class="enlace" target="_blank">
                                                <p class="enlaceCompleto" id="enlaceCompleto">
                                                    <?= $noticia['enlace'] ?>
                                                </p>
                                                Enlace
                                                <i class="fa-solid fa-hand-pointer"></i>
                                            </a>
                                        <?php endif; ?>

                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="Generales/MenuOptions.js"></script>
            <script src="CompletaNoticia/CompletaNoticia.js"></script>


        </body>

        </html>
        <?php
    } else {
        echo "La noticia no existe.";
    }
} else {
    echo "ID de noticia no especificado.";
}

$conexion->close();
?>