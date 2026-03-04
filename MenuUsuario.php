<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Generales/Generales.css">
  <link rel="stylesheet" href="MenuUsuario/MenuUsuario.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <?php
  include 'conexionBD.php';
  session_start();

  // Verificar si el usuario está autenticado y obtener su nombre de usuario
  if (isset($_SESSION["usuario_nombre"]) && !empty($_SESSION["usuario_nombre"])) {
    $nombreusuario = $_SESSION["usuario_nombre"];
  } else {
    header("Location: index.html");
    exit();
  }

  // Verificar  el rol del usuario 
  if ($_SESSION["usuario_rol"] !== "Prensa" && $_SESSION["usuario_rol"] !== "Marketing" && $_SESSION["usuario_rol"] !== "Jefe de edicion Prensa" && $_SESSION["usuario_rol"] !== "Jefe de edicion Marketing" && $_SESSION["usuario_rol"] !== "Admin") {
    header("Location: index.html");
    exit();
  }
  // Obtener el rol del usuario
  $usuario_rol = $_SESSION["usuario_rol"];
  ?>

  <script>
    const usuarioRol = "<?php echo $usuario_rol; ?>";
    //alert("El rol del usuario es: " + usuarioRol);


    function mostrarOcultarDivs() {
      // Todos los divs que queremos controlar
      const divs = [
        { id: 'InsertarNoticia', roles: ['Prensa', 'Jefe de edicion Prensa', 'Admin'] },
        { id: 'EditarNoticia', roles: ['Jefe de edicion Prensa', 'Admin'] },
        { id: 'InsertarCategoriaNoticia', roles: ['Admin'] },
        { id: 'EditarCategoriaNoticia', roles: ['Admin'] },
        { id: 'VisibilidadCategoriaNoticia', roles: ['Admin'] },
        { id: 'InsertarEvento', roles: ['Jefe de edicion Marketing', 'Marketing', 'Admin'] },
        { id: 'EditarEvento', roles: ['Jefe de edicion Marketing', 'Admin'] },
        { id: 'InsertarDescubreHidalgo', roles: ['Admin'] },
        { id: 'EditarDescubreHidalgo', roles: ['Admin'] },
        { id: 'InsertarUsuario', roles: ['Admin'] },
        { id: 'EditarUsuario', roles: ['Admin'] },
      ];

      // Recorrer todos los divs y ajustar su visibilidad
      divs.forEach(div => {
        const element = document.getElementById(div.id);
        if (div.roles.includes(usuarioRol)) {
          element.style.display = 'flex'; // o el valor de display que necesites
        } else {
          element.style.display = 'none';
        }
      });
    }

    document.addEventListener('DOMContentLoaded', mostrarOcultarDivs);
  </script>


  <script>
    $(document).ready(function () {
      $('#InsertarNoticia').on('click', function () {
        window.location.href = 'CrudNoticia/php/PublicarNoticia.php';
      });
      $('#EditarNoticia').on('click', function () {
        window.location.href = 'CrudNoticia.php';
      });
      $('#InsertarCategoriaNoticia').on('click', function () {
        window.location.href = 'CrudCategoriaNoticia/insertarCategoria.php';
      });
      $('#EditarCategoriaNoticia').on('click', function () {
        window.location.href = 'CrudCategoriaNoticia/editarCategoria.php';
      });
      $('#VisibilidadCategoriaNoticia').on('click', function () {
        window.location.href = 'CrudCategoriaNoticia/visibilidadCategoria.php';
      });
      $('#InsertarEvento').on('click', function () {
        window.location.href = 'CrudEvento/php/PublicarEvento.php';
      });
      $('#EditarEvento').on('click', function () {
        window.location.href = 'CrudEvento.php';
      });
      $('#InsertarDescubreHidalgo').on('click', function () {
        window.location.href = 'CrudDescubreHidalgo/php/PublicarDescubreHidalgo.php';
      });
      $('#EditarDescubreHidalgo').on('click', function () {
        window.location.href = 'CrudDescubreHidalgo.php';
      });
      $('#InsertarUsuario').on('click', function () {
        window.location.href = 'CrudUsuarios/crearUsuario.php';
      });
      $('#EditarUsuario').on('click', function () {
        window.location.href = 'CrudUsuarios/editarUsuario.php';
      });


    });
  </script>

</head>

<body>

  <button class="regresarMenuOIndex" id="Index">Index</button>
  <script>const Index = document.getElementById('Index');
    Index.addEventListener('click', function () { window.location.href = 'index.html'; });
  </script>

  <div class="centrarTodo">

    <div class="fondo">
      <div class="rojizar">

        <div class="mitad-azul">

          <div class="funcion" id="InsertarNoticia">
            <div class="cuadrado"><i class="fa-solid fa-newspaper"></i></div>
            <div class="circulo Add">
              <i class="fa-solid fa-plus"></i>
            </div>
            <p>Insertar Noticia</p>
          </div>

          <div class="funcion" id="EditarNoticia">
            <div class="cuadrado"><i class="fa-solid fa-newspaper"></i></div>
            <div class="circulo edit">
              <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <p>Editar Noticia</p>
          </div>

        </div>

        <div class="mitad-azul">

          <div class="funcion" id="InsertarCategoriaNoticia">
            <div class="cuadrado"><i class="fa-solid fa-layer-group"></i></div>
            <div class="circulo Add">
              <i class="fa-solid fa-plus"></i>
            </div>
            <p>Insertar Categoria Noticia</p>
          </div>

          <div class="funcion" id="EditarCategoriaNoticia">
            <div class="cuadrado"><i class="fa-solid fa-layer-group"></i></div>
            <div class="circulo edit">
              <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <p>Editar Categoria Noticia</p>
          </div>

          <div class="funcion" id="VisibilidadCategoriaNoticia">
            <div class="cuadrado"><i class="fa-solid fa-layer-group"></i></div>
            <div class="circulo delate">
              <i class="fa-solid fa-eye"></i>
            </div>
            <p>Visibilidad Categoria Noticia</p>
          </div>

        </div>

        <div class="mitad-azul">

          <div class="funcion" id="InsertarEvento">
            <div class="cuadrado"><i class="fa-solid fa-calendar-days"></i></div>
            <div class="circulo Add">
              <i class="fa-solid fa-plus"></i>
            </div>
            <p>Insertar Evento</p>
          </div>

          <div class="funcion" id="EditarEvento">
            <div class="cuadrado"><i class="fa-solid fa-calendar-days"></i></div>
            <div class="circulo edit">
              <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <p>Editar Evento</p>
          </div>

        </div>



        <div class="mitad-azul">

          <div class="funcion" id="InsertarDescubreHidalgo">
            <div class="cuadrado"><i class="fa-solid fa-map-location"></i></div>
            <div class="circulo Add">
              <i class="fa-solid fa-plus"></i>
            </div>
            <p>Insertar Descubre Hidalgo</p>
          </div>

          <div class="funcion" id="EditarDescubreHidalgo">
            <div class="cuadrado"><i class="fa-solid fa-map-location"></i></div>
            <div class="circulo edit">
              <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <p>Editar Descubre Hidalgo</p>
          </div>

        </div>


        <div class="mitad-azul">

          <div class="funcion" id="InsertarUsuario">
            <div class="cuadrado"><i class="fa-solid fa-user"></i></div>
            <div class="circulo Add">
              <i class="fa-solid fa-plus"></i>
            </div>
            <p>Insertar Usuario</p>
          </div>

          <div class="funcion" id="EditarUsuario">
            <div class="cuadrado"><i class="fa-solid fa-user"></i></div>
            <div class="circulo edit">
              <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <p>Editar Usuario</p>
          </div>


        </div>

      </div>

    </div>
  </div>
</body>

</html>