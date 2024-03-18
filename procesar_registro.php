<?php
// Archivo de configuración con las credenciales de la base de datos
require_once('conexion.php');

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';

    // Conectar a la base de datos
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Consulta SQL para insertar un nuevo usuario
    $sql = "INSERT INTO Usuarios (Nombre, CorreoElectronico, Contrasena) 
            VALUES ('$nombre', '$correo', '$contrasena')";

    if ($conn->query($sql) === TRUE) {
        echo "Usuario registrado correctamente.";
        header("Location: Tienda.php");
    } else {
        echo "Error al registrar el usuario: " . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
}
?>
