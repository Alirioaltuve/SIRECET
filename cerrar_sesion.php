<?php

session_start();

// Destruir la sesión solo si existe una sesión de usuario activa
if (isset($_SESSION['usuario'])) {
    unset($_SESSION['usuario']);
}

// Redirigir al usuario a la página de inicio de sesión
header("Location: login/index.html");
exit();

?>
