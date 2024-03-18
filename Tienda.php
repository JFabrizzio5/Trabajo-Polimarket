<?php
// Iniciar sesión
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Tienda Online</title>
  <!-- Enlace a Bootstrap CSS en modo oscuro -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #343a40;
      color: #fff;
    }
    .navbar {
      background-color: #6f42c1;
    }
    .navbar-dark .navbar-toggler-icon {
      background-color: #fff;
    }
    .navbar-dark .navbar-brand {
      color: #fff;
    }
    .navbar-dark .navbar-nav .nav-link {
      color: #fff;
    }
    .jumbotron {
      background-color: #343a40;
      margin-top: 56px;
    }
    .card {
      background-color: #495057;
      border: 1px solid #343a40;
      margin-bottom: 20px;
    }
    .modal-content {
      background-color: #495057;
      color: #fff;
    }
    .form-inline {
      margin-left: auto;
      margin-right: auto;
    }
    @media (max-width: 576px) {
      .navbar-toggler {
        border-color: #fff;
      }
    }
  </style>
</head>
<body>
<!-- Enlace a jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Enlace a Bootstrap JS y Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.9/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#">
      <H1>POLIMARKET</H1>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#chatModal">Chat</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Carrito</a>
        </li>
      </ul>
      <?php
    if (isset($_SESSION['usuario'])) {
      echo '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalProducto">Registrar Producto</button>';
    } else {
        
      echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalLogin">Iniciar Sesión</button>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalRegistro">Registrarse</button>';
    }
    ?><?php
    if (isset($_SESSION['usuario'])) {
      echo '<div class="text-center">
              <a href="cerrar_sesion.php" class="btn btn-danger">Cerrar Sesión</a>
            </div>';
    }
    ?>
    </div>
  </div>
</nav>

<!-- Bienvenida -->
<div class="jumbotron text-center">
  <h1 class="display-4">¡Bienvenido a nuestra Tienda Online!</h1>
</div>

<!-- Contenido de la página -->
<div class="container mt-3">
  <div class="row">
    <!-- Barra de filtros (lado izquierdo) -->
    <div class="col-md-3 mb-4" method="get" action="Tienda.php">
      <h5>Buscar</h5>
      <form class="form-inline">
        <div class="form-group">
          <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar" name="q">
        </div>
    
        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Buscar</button>
      </form>
    </div>
  <div class="col-md-9">
      <!-- Aquí va tu código PHP para mostrar productos -->
   <!-- Aquí va tu código PHP para mostrar productos -->
<?php
// Incluir el archivo de conexión a la base de datos
include('conexion.php');

// Verificar la conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

// Número de productos por página
$productosPorPagina = 9;

// Página actual
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

// Calcular el inicio de la fila para la consulta LIMIT
$inicio = ($pagina - 1) * $productosPorPagina;

// Realizar la consulta a la base de datos con la paginación
if (isset($_GET['q'])) {
  $search_query = $_GET['q'];
  $query = "SELECT IDProducto, NombreProducto, Descripcion, Precio, URLImagen FROM Productos WHERE NombreProducto LIKE '%$search_query%' LIMIT $inicio, $productosPorPagina";
} else {
  $query = "SELECT IDProducto, NombreProducto, Descripcion, Precio, URLImagen FROM Productos LIMIT $inicio, $productosPorPagina";
}

$result = mysqli_query($conn, $query);

// Verificar si hay errores al ejecutar la consulta
if (!$result) {
  die('Error en la consulta: ' . mysqli_error($conn));
}
?>

<!-- Estructura del bucle para mostrar productos en un diseño de 3x3 -->
<div class="row">
  <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <?php if ($count % 3 == 0): ?>
      </div><div class="row">
    <?php endif; ?>
    <div class="col-md-4 mb-4">
      <div class="card">
        <a href="Producto.php?id=<?= $row['IDProducto'] ?>">
          <img src="<?= $row['URLImagen'] ?>" class="card-img-top img-fluid rounded" alt="Producto" style="max-width: 250px; max-height: 250px;">
        </a>
        <div class="card-body">
          <h5 class="card-title"><?= $row['NombreProducto'] ?></h5>
          <p class="card-text"><?= $row['Descripcion'] ?></p>
          <a href="Producto.php?id=<?= $row['IDProducto'] ?>" class="btn btn-primary">Ver Detalles</a>
        </div>
      </div>
    </div>
    <?php $count++; ?>
  <?php endwhile; ?>
</div>

<!-- Paginación -->
<div class="row">
  <div class="col-md-12 text-center">
    <?php
    // Calcular el número total de páginas
    $totalPaginas = ceil($totalProductos / $productosPorPagina);

    // Mostrar enlaces de paginación
    for ($i = 1; $i <= $totalPaginas; $i++) {
      echo '<a href="?pagina=' . $i . '" class="btn btn-outline-primary">' . $i . '</a>';
    }
    ?>
  </div>
</div>

<!-- Modal para detalles del producto (fuera del bucle) -->
<?php mysqli_data_seek($result, 0); // Reiniciar el puntero del resultado para volver a recorrer ?>
<?php while ($row = mysqli_fetch_assoc($result)): ?>
  <div class="modal fade" id="productoModal<?= $row['IDProducto'] ?>" tabindex="-1" role="dialog" aria-labelledby="productoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <!-- ... (resto del código del modal) ... -->
      </div>
    </div>
  </div>
<?php endwhile; ?>

</div>
</div>
</div>

<!-- Cierre de la etiqueta form fuera del bucle -->




      <!-- Modal para detalles del producto (fuera del bucle) -->
      <?php mysqli_data_seek($result, 0); // Reiniciar el puntero del resultado para volver a recorrer ?>
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="modal fade" id="productoModal<?= $row['IDProducto'] ?>" tabindex="-1" role="dialog" aria-labelledby="productoModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <!-- ... (resto del código del modal) ... -->
            </div>
          </div>
        </div>
      <?php endwhile; ?>

    </div>
  </div>
</div><!-- Estructura del bucle para mostrar productos en un diseño de 3x3 -->
<div class="row">
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <a href="Producto.php?id=<?= $row['IDProducto'] ?>"> <!-- Enlace a la página de detalle del producto -->
                    <img src="<?= $row['URLImagen'] ?>" class="card-img-top" alt="Producto">
                </a>
                <div class="card-body">
                    <h5 class="card-title"><?= $row['NombreProducto'] ?></h5>
                    <p class="card-text"><?= $row['Descripcion'] ?></p>
                    <a href="Producto.php?id=<?= $row['IDProducto'] ?>" class="btn btn-primary">Ver Detalles</a>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<!-- Chat Modal -->
<div class="modal fade" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="chatModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="chatModalLabel">Mensajes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs" id="myTabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="chat1-tab" data-toggle="tab" href="#chat1" role="tab" aria-controls="chat1" aria-selected="true">Chat 1</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chat2-tab" data-toggle="tab" href="#chat2" role="tab" aria-controls="chat2" aria-selected="false">Chat 2</a>
          </li>
          <!-- Agregar más pestañas de chat según sea necesario -->
        </ul>
        <div class="tab-content mt-2">
          <div class="tab-pane fade show active" id="chat1" role="tabpanel" aria-labelledby="chat1-tab">
            <!-- Contenido del primer chat -->
          </div>
          <div class="tab-pane fade" id="chat2" role="tabpanel" aria-labelledby="chat2-tab">
            <!-- Contenido del segundo chat -->
          </div>
          <!-- Agregar más paneles de chat según sea necesario -->
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Verificar si hay una sesión activa -->


<!-- Contenido -->
<main>
  <div class="mb-3">
    <!-- Verificar si hay una sesión activa -->
  
  </div>

  <!-- MODALES -->

  <!-- Modal de Iniciar Sesión -->
  <div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Iniciar Sesión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario de Iniciar Sesión -->
                <form action="login.php" method="post">
                    <div class="mb-3">
                        <label for="loginUsuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="loginUsuario" name="correo" required>
                    </div>
                    <div class="mb-3">
                        <label for="loginContraseña" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="loginContraseña" name="contrasena" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                </form>
            </div>
        </div>
    </div>
</div>


  <!-- Modal de Registro -->
  <div class="modal fade" id="modalRegistro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario de Registro -->
                <form action="procesar_registro.php" method="post">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo Electrónico:</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>
                    <div class="form-group">
                        <label for="contrasena">Contraseña:</label>
                        <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>


  <!-- Modal de Registrar Producto -->
  <!-- Modal de Registrar Producto -->
<div class="modal fade" id="modalProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario de Registro de Producto -->
                <form id="formRegistrarProducto" action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nombreProducto" class="form-label">Nombre del Producto</label>
                        <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcionProducto" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcionProducto" name="descripcionProducto" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="precioProducto" class="form-label">Precio</label>
                        <input type="number" class="form-control" id="precioProducto" name="precioProducto" required>
                    </div>
                    <div class="mb-3">
                        <?php
                        // Obtener el ID del usuario actual
                        require_once('conexion.php');

                        // Resto de tu código aquí...

                        // Obtener el ID del usuario actual
                        if (isset($_SESSION['usuario'])) {
                            $correoUsuario = $_SESSION['usuario'];
                            $consultaUsuario = "SELECT IDUsuario FROM Usuarios WHERE CorreoElectronico = '$correoUsuario'";
                            $resultadoUsuario = $conn->query($consultaUsuario);

                            if ($resultadoUsuario->num_rows > 0) {
                                $filaUsuario = $resultadoUsuario->fetch_assoc();
                                $idVendedor = $filaUsuario['IDUsuario'];

                                echo '<input type="hidden" name="idVendedor" value="' . $idVendedor . '">';
                            }
                        }
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="imagenProducto" class="form-label">Seleccionar Imagen:</label>
                        <input type="file" name="imagenProducto" id="imagenProducto" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-success">Registrar Producto</button>
                </form>
            </div>
        </div>
    </div>
</div>


            <!-- ... (tu código existente) ... -->
          </form>
        </div>
      </div>
    </div>
  </div>

</main>

<!-- Enlace a Bootstrap JS y Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.9/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  // Agregar este script para manejar el cierre del modal en Bootstrap 4.5.2
  $(document).ready(function(){
      // Manejar el evento de clic en el botón de cierre de cada modal
      $(".btn-close").click(function(){
          // Buscar el modal padre y cerrarlo
          $(this).closest('.modal').modal('hide');
      });
  });
</script>
<script>
  $(document).ready(function() {
    // Agregar un log para verificar si el botón se está clicando
    $('#modalProducto').on('show.bs.modal', function () {
      console.log('Botón Registrar Producto clicado');
    });
  });
</script>

</body>
</html>
