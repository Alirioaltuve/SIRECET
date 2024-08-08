<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login/index.html');
    exit();
}

include_once("../conexion.php");

if(isset($_POST['btn_actualizar_estado'])) {
    $id_reporte = $_POST['id_reporte'];
    $nuevo_estado = $_POST['nuevo_estado'];
    $fecha_actual = $_POST['fecha_actual'];

    // Aquí puedes agregar la lógica para actualizar el estado en la base de datos
    // Por ejemplo, podrías hacer algo como esto:
    $query_actualizar_estado = "UPDATE reportes SET estado = '$nuevo_estado', fecha_actualizacion_estado  = NOW() WHERE id_reporte = $id_reporte";
    mysqli_query($conn, $query_actualizar_estado);
    header('Location: index.php'); // Redirige a la página de reportes después de actualizar el estado
    exit();
}
?>
