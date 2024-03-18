<?php
include 'conexion.php';

// Verificar si se ha enviado un archivo y también datos del formulario
if (isset($_FILES['imagenProducto']) && isset($_POST['nombreProducto']) && isset($_POST['descripcionProducto']) && isset($_POST['precioProducto']) && isset($_POST['idVendedor'])) {
    // Datos del formulario
    $nombreProducto = $_POST['nombreProducto'];
    $descripcionProducto = $_POST['descripcionProducto'];
    $precioProducto = $_POST['precioProducto'];
    $idVendedor = $_POST['idVendedor'];

    // Ruta donde se guardará la imagen
    $directorioDestino = 'productos/';
    
    // Información del archivo
    $archivo = $_FILES['imagenProducto'];
    $nombreArchivo = $archivo['name'];
    $rutaCompleta = $directorioDestino . $nombreArchivo;

    // Mover el archivo al directorio de destino
    if (move_uploaded_file($archivo['tmp_name'], $rutaCompleta)) {
        // URL de la imagen (almacenada como "rutadelaimagen/nombreimagen.xxx")
        $urlImagen = $directorioDestino . $nombreArchivo;
        
        // Insertar en la base de datos
        $sql = "INSERT INTO Productos (NombreProducto, Descripcion, Precio, IDVendedor, URLImagen) VALUES ('$nombreProducto', '$descripcionProducto', $precioProducto, $idVendedor, '$urlImagen')";

        if ($conn->query($sql) === TRUE) {
            echo "Producto registrado con éxito.";
        } else {
            echo "Error al registrar el producto: " . $conn->error;
        }

        echo "La imagen se ha subido correctamente.";
    } else {
        echo "Error al subir la imagen.";
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
