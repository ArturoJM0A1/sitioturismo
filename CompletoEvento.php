<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width,height=device-height,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">

  <title>Evento</title>
  <link rel="stylesheet" href="Generales/Generales.css">
  <link rel="stylesheet" href="EventosPublicados/CompletoEvento/EventoCompleto.css">
  <link rel="stylesheet" href="EventosPublicados/CompletoEvento/sliderGaleria/css/slider.css">
  <link rel="stylesheet" href="Generales/ExplorarLugar.css">

  <link rel="stylesheet" href="Generales/DivError.css">

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <link rel="stylesheet" href="./Generales/MenuOptions.css">
  <link rel="stylesheet" href="./Generales/subMenu.css">
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

      <div class="tab pink" id="VerInicio">
        <i class="fas fa-home"></i>
        <p>Inicio</p>
      </div>
      <div class="tab pink" id="VerTodasLasNoticias">
        <i class="fa-solid fa-newspaper"></i>
        <p>Noticias</p>
      </div>
      <div class="tab pink" id="VerTodosLosEventosExternos">
        <i class="fa-solid fa-calendar-days"></i>
        <p>Eventos Externos</p>
      </div>
      <div class="tab pink" id="VerTodosLosEventosInternos">
        <i class="fa-solid fa-calendar-days"></i>
        <p>Eventos Internos</p>
      </div>
      <div class="tab pink" id="VerTodosDescrubreHidalgo">
        <i class="fa-solid fa-map-location"></i>
        <p>Descubre Hidalgo</p>
      </div>
    </div>
  </div>

  <script>
    var VerInicio = document.getElementById("VerInicio");
    VerInicio.addEventListener("click", function () {
      window.location.href = "index.html";
    });

    var VerTodasLasNoticias = document.getElementById("VerTodasLasNoticias");
    VerTodasLasNoticias.addEventListener("click", function () {
      window.location.href = "NoticiasPublicadas.php";
    });

    var VerTodosLosEventosExternos = document.getElementById("VerTodosLosEventosExternos");
    VerTodosLosEventosExternos.addEventListener("click", function () {
      window.location.href = "CalendarioEventos.php?externo=true";
    });

    var VerTodosLosEventosInternos = document.getElementById("VerTodosLosEventosInternos");
    VerTodosLosEventosInternos.addEventListener("click", function () {
      window.location.href = "CalendarioEventos.php?interno=true";
    });

    var VerTodosDescrubreHidalgo = document.getElementById("VerTodosDescrubreHidalgo");
    VerTodosDescrubreHidalgo.addEventListener("click", function () {
      window.location.href = "DescubreHidalgo/index.html";
    });

  </script>


  <div class="contenedor">
    <?php
    include 'conexionBD.php';

    $eventoId = $_GET['id'];

    // Consulta SQL para obtener el evento con ID 3
    $query = "SELECT * FROM listaeventos WHERE id = $eventoId";
    $resultado = $conexion->query($query);


    if ($resultado && $resultado->num_rows > 0) {
      $evento = $resultado->fetch_assoc();
      echo "<script>const eventoId = {$evento['id']};</script>"; // Pasar el ID del evento al script JavaScript
      echo "<script>console.log('ID del evento:', {$evento['id']});</script>";
      ?>
      <p class="titulo"><?= $evento['titulo'] ?></p>

      <p><?= $evento['descripcion'] ?></p>

      <div class="linea-de-tiempo">
        <div class="circulo"></div>
        <div class="linea"></div>
        <div class="circulo"></div>
        <div class="linea"></div>
        <div class="circulo"></div>
      </div>

      <div class="detalle-contacto">
        <div class="contacto">
          <p class="subtitulo">Contacto</p>
          <p class="textolargo">Correo(s): <?= $evento['correos'] ?></p>
          <p class="textolargo">Teléfono(s): <?= $evento['telefonos'] ?></p>
        </div>

        <div class="detalles">
          <p class="subtitulo">Detalles</p>
          <p class="textolargo">Fecha inicio: <?= $evento['fechaInicio'] ?></p>
          <p class="textolargo">Fecha fin: <?= $evento['fechaFin'] ?></p>
          <p class="textolargo">Horario: <?= $evento['horario'] ?></p>
          <p class="textolargo">Lugar: <?= $evento['lugar'] ?></p>
        </div>
      </div>

      <div class="linea-de-tiempo">
        <div class="circulo"></div>
        <div class="linea"></div>
        <div class="circulo"></div>
        <div class="linea"></div>
        <div class="circulo"></div>
      </div>

      <?php
      function getYouTubeEmbedUrl($url)
      {
        // Regex para coincidir con varias formas de URL de YouTube
        $pattern = '/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/i';

        // Verificar si la URL coincide con el patrón
        if (preg_match($pattern, $url)) {
          // Parsear la URL
          $urlParts = parse_url($url);

          // Si el host es youtu.be, cambiar a youtube.com y usar /embed/
          if ($urlParts['host'] == 'youtu.be') {
            $videoId = ltrim($urlParts['path'], '/');
            return 'https://www.youtube.com/embed/' . $videoId;
          }

          // Si el host es youtube.com, obtener el ID del video de los parámetros de consulta
          parse_str($urlParts['query'], $queryParts);
          if (isset($queryParts['v'])) {
            return 'https://www.youtube.com/embed/' . $queryParts['v'];
          }
        }

        // Devolver la URL original si no coincide con el patrón
        return $url;
      }

      if (!empty($evento['video'])):
        $embedUrl = getYouTubeEmbedUrl($evento['video']);
        ?>
        <p class="subtitulo">Video</p>
        <div class="video-container">
          <div class="video-wrapper">
            <iframe src="<?= $embedUrl ?>" frameborder="0" allowfullscreen></iframe>
          </div>
        </div>
      <?php endif; ?>

      <p class="subtitulo">Galeria</p>
      <div class="container-Galeria">
        <div class="slider">
        </div>
      </div>

      <div class="linea-de-tiempo">
        <div class="circulo"></div>
        <div class="linea"></div>
        <div class="circulo"></div>
        <div class="linea"></div>
        <div class="circulo"></div>
      </div>

      <p class="subtitulo">Trazar ruta</p>
      <p id="cordenadasEvento"> <?= $evento['coordenadas'] ?></p>
      <div id="map"></div>
      <div id="info"></div>

      <div id="ventanaExplorarLugar">
        <div class="barraTop">
          <i class="fa-solid fa-rectangle-xmark" id="CerrarExplorarLugar"></i>
        </div>
        <div id="ExplorarLugar"></div>
      </div>

      <button id="explore-button" class="cardboton">Explorar Lugar</button>

      <?php
    } else {
      echo "El evento no existe.";
    }

    $conexion->close();
    ?>
  </div>



  <script src="EventosPublicados/CompletoEvento/sliderGaleria/js/slide.js"></script>

  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZa9NjPPh3NGFnLsZis0j14pxYlPMGw40&callback=initMap&libraries=places"
    type="text/javascript"></script>

  <script src="EventosPublicados/CompletoEvento/Ruta/Ruta.js"></script>
  <script src="Generales/disenoEstilosMapa.js"></script>


</body>

</html>