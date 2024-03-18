<?php
// Archivo de configuración con las credenciales de la base de datos
require_once('conexion.php');

// Iniciar sesión
session_start();

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener credenciales del formulario
    $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';

    // Utiliza sentencias preparadas para evitar la inyección SQL
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE CorreoElectronico = ? AND contrasena = ?");
    $stmt->bind_param("ss", $correo, $contrasena);

    // Ejecuta la consulta
    $stmt->execute();

    // Obtiene el resultado de la consulta
    $result = $stmt->get_result();

    // Verificar si se encontró un usuario con las credenciales proporcionadas
    if ($result->num_rows > 0) {
        // Si se encontró un usuario, establecer la sesión
        $_SESSION['usuario'] = $correo;
        header("Location: Tienda.php");
        exit();
    } else {
        echo "Inicio de sesión fallido. Por favor, verifica tus credenciales.";
    }

    // Cerrar conexión
    $stmt->close();
    $conn->close();
}
?>
