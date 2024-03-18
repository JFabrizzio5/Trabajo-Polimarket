<?php
session_start();
session_unset();  // Elimina todas las variables de sesión
session_destroy();  // Destruye la sesión
header("Location: index.html");  // Redirige a la página de inicio o a donde desees
exit();
?>
