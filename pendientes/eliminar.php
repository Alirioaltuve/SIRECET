<?php
include_once("../conexion.php");

// Obtener el número de la URL y escaparlo correctamente
$id_reporte = mysqli_real_escape_string($conn, $_GET['id_reporte']);

// Realizar la consulta SQL utilizando la variable escapada
mysqli_query($conn, "DELETE FROM reportes WHERE id_reporte='$id_reporte'");

// Redireccionar al usuario de vuelta a la página index.php después de eliminar el registro
header("Location: index.php");
exit(); // Se recomienda agregar exit() después de header() para asegurar que el script se detenga después de la redirección
?>
