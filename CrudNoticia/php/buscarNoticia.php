<?php
include '../../conexionBD.php';

if (isset($_POST['searchQuery'])) {
    $searchQuery = $_POST['searchQuery'];

    $query = "SELECT ln.id, ln.titulo, ln.subtitulo, ln.descripcion, ln.fecha, ln.internoExterno, 
    ln.img, ln.Relevante, GROUP_CONCAT(c.nombre) AS categorias
    FROM listanoticias ln
    LEFT JOIN noticia_cMunicipio nc ON ln.id = nc.noticia_id
    LEFT JOIN categoriaMunicipio c ON nc.categoria_id = c.id
    WHERE ln.titulo LIKE '%$searchQuery%' 
    OR ln.subtitulo LIKE '%$searchQuery%' 
    OR ln.descripcion LIKE '%$searchQuery%' 
    OR ln.fecha LIKE '%$searchQuery%' 
    OR c.nombre LIKE '%$searchQuery%'
    GROUP BY ln.id
    ORDER BY ln.fecha DESC";

    $resultado = $conexion->query($query);

    if ($resultado) {
        while ($Noticia = $resultado->fetch_assoc()) {
            $fechaFormateada = date('d/m/Y', strtotime($Noticia['fecha']));
            $categoriasArray = explode(',', $Noticia['categorias']);
            ?>
            <div class="TarjetaNoticia <?= implode(' ', $categoriasArray) ?>">
                <div class="cuerpoNoticia">
                    <div class="FechaNoticia">
                        <?= $fechaFormateada ?>
                    </div>
                    <div class="contenidoNoticia">

                        <div class="Funcionalidades">
                            <i class="fa-solid fa-pen-to-square" onclick="editarNoticia(<?= $Noticia['id'] ?>)"></i>
                            <i class="fa-solid fa-trash-can" data-id="<?= $Noticia['id'] ?>"></i>
                            <i class="fa-solid fa-star <?php echo $Noticia['Relevante'] == 1 ? 'Relevante' : ''; ?>"
                                onclick="marcarComoRelevante(<?= $Noticia['id'] ?>)"></i>
                        </div>

                        <div class="tituloyImagen">
                            <div class="titulo">
                                <?= $Noticia['titulo'] ?>
                            </div>
                            <img class="imagen" src="<?= $Noticia['img'] ?>" alt="Imagen de la noticia"></img>
                        </div>
                        <div class="textoLargo">
                            <div class="subtitulo">
                                <?= $Noticia['subtitulo'] ?>
                            </div>
                            <div class="descricion">
                                <?= $Noticia['descripcion'] ?>
                            </div>
                        </div>
                        <div class="boton">
                            <a class="cardboton" href="NoticiasPublicadas/php/noticiaCompleta.php?id=<?= $Noticia['id'] ?>">Leer
                                más</a>
                        </div>
                        <div class="categorias">
                            <?php foreach ($categoriasArray as $categoria): ?>
                                <div>
                                    <p><?= $categoria ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <img class="ImagenNoticia" src="<?= $Noticia['img'] ?>" alt="Imagen de la noticia"></img>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<script>console.log('No se encontraron noticias que coincidan con la búsqueda.');</script>";
    }
}
?>

<script src="CrudNoticia/js/EliminarNoticia.js"></script>
<script src="CrudNoticia/js/EditarNoticia.js"></script>
<script src="CrudNoticia/js/MarcarRelevante.js"></script>