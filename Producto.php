<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Detalle del Producto</title>
  <!-- Enlace a Bootstrap CSS en modo oscuro -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #343a40; /* Color de fondo oscuro */
      color: #fff; /* Color de texto claro */
    }
    .navbar {
      background-color: #6f42c1; /* Color morado claro para el header */
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
      background-color: #343a40; /* Color de fondo oscuro para la sección de bienvenida */
      margin-top: 56px; /* Ajustar la separación desde el navbar */
    }
    .card {
      background-color: #495057; /* Color de fondo oscuro para las tarjetas */
      border: 1px solid #343a40; /* Borde oscuro */
      margin-bottom: 20px;
    }
    .modal-content {
      background-color: #495057; /* Color de fondo oscuro para el modal */
      color: #fff; /* Color de texto claro para el modal */
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#">
      <h1>POLIMARKET</h1>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="Tienda.php" data-toggle="modal" data-target="#productoModal">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Chat.php" data-toggle="modal" data-target="#chatModal">Chat</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.html">Info</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<br>
<br>
<br>
<br>
<!-- Contenido de la página (Detalle del Producto) -->
<?php
// Incluir el archivo de conexión a la base de datos
include('conexion.php');
session_start();

// Almacenar el nombre del usuario en la sesión
if (isset($_SESSION['usuario'])) {
  echo "<p>Aquí está tu producto, {$_SESSION['usuario']}.</p>";
} // Asegúrate de tener esta variable definida en tu código
// Verificar si se proporciona el parámetro "producto" en la URL
if (isset($_GET['producto'])) {
    // Obtener el ID del producto desde la URL
    $idProducto = $_GET['producto'];

    // Aquí debes realizar la consulta a la base de datos para obtener los detalles del producto
    $queryProducto = "SELECT NombreProducto, Descripcion, Precio, IDVendedor, URLImagen FROM Productos WHERE IDProducto = $idProducto";
    $resultProducto = $conn->query($queryProducto);

    // Verificar si se obtuvieron resultados
    if ($resultProducto && $resultProducto->num_rows > 0) {
        $rowProducto = $resultProducto->fetch_assoc();

        // Obtener los detalles del producto
        $nombreProducto = $rowProducto['NombreProducto'];
        $descripcionProducto = $rowProducto['Descripcion'];
        $precioProducto = $rowProducto['Precio'];
        $idVendedor = $rowProducto['IDVendedor'];
        $urlImagen = $rowProducto['URLImagen'];

        // Consulta para obtener el correo electrónico del vendedor
        $queryVendedor = "SELECT CorreoElectronico FROM Usuarios WHERE IDUsuario = $idVendedor";
        $resultVendedor = $conn->query($queryVendedor);

        // Verificar si se obtuvieron resultados
        if ($resultVendedor && $resultVendedor->num_rows > 0) {
            $rowVendedor = $resultVendedor->fetch_assoc();
            $correoVendedor = $rowVendedor['CorreoElectronico'];

            // Ahora puedes mostrar el correo electrónico del vendedor en la página
        } else {
            // Manejar el caso en que no se obtenga el correo electrónico del vendedor
            $correoVendedor = "Correo no disponible";
        }
        ?>
        <div class="container mt-4">
          <div class="row">
            <div class="col-md-6">
              <!-- Mostrar la imagen del producto -->
              <img src="<?= $urlImagen ?>" class="img-fluid" alt="<?= $nombreProducto ?>">
            </div>
            <div class="col-md-6">
              <br>
              <!-- Mostrar los detalles del producto -->
              <h2><?= $nombreProducto ?></h2>
              <p><?= $descripcionProducto ?></p>
              <p><strong>Precio:</strong> $<?= $precioProducto ?></p>
              <!-- Mostrar el contacto del vendedor -->
              <p><strong>Contacta a:</strong> <a href="mailto:<?= $correoVendedor ?>"><?= $correoVendedor ?></a></p>
              <!-- Puedes agregar más detalles según sea necesario -->

              <!-- Botón para enviar correo al vendedor con mailto -->
              <a href="mailto:<?= $correoVendedor ?>?subject=Consulta%20sobre%20producto%20<?= $nombreProducto ?>&body=Hola,%20estoy%20interesado%20en%20tu%20producto%20<?= $nombreProducto ?>" class="btn btn-primary">Agregar al Carrito</a>

              <!-- Puedes mostrar el mensaje de confirmación aquí -->
              <p>Aquí está tu producto.</p>

              <!-- Puedes agregar más detalles según sea necesario -->
              <button class="btn btn-secondary" onclick="history.back()">Volver Atrás</button>
            </div>
          </div>
        </div>
        <?php
    } else {
        // Si no se obtuvieron resultados, muestra un mensaje de error o redirecciona
        echo "Producto no encontrado";
    }
} else {
    // Si no se proporciona el parámetro "producto" en la URL, mostrar un mensaje de error o redireccionar a la página de la tienda
    header("Location: Tienda.php");
    exit();
}
?>




<!-- Enlace a Bootstrap JS y Popper.js (necesarios para algunos componentes de Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.9/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
