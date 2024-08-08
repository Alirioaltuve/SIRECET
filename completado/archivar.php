<?php
// Verificar si se ha recibido el parámetro id_reporte en la solicitud GET
if(isset($_GET['id_reporte'])) {
    // Obtener el id_reporte de la solicitud GET
    $id_reporte = $_GET['id_reporte'];
    
    // Conectar a la base de datos (asegúrate de actualizar estos valores según tu configuración)
    $conexion = mysqli_connect("localhost", "root", "", "sirecet-cebm");

    // Verificar la conexión
    if($conexion === false){
        die("ERROR: No se pudo conectar. " . mysqli_connect_error());
    }

    // Preparar la consulta para actualizar el campo "archivado" a "Si" para el reporte con el id_reporte dado
    $consulta = "UPDATE reportes SET archivado='Si' WHERE id_reporte=$id_reporte";

    // Ejecutar la consulta
    if(mysqli_query($conexion, $consulta)){
        echo "El reporte ha sido archivado correctamente.";
    } else{
        echo "ERROR: No se pudo ejecutar la consulta. " . mysqli_error($conexion);
    }

    // Cerrar la conexión
    mysqli_close($conexion);
} else {
    echo "ERROR: No se ha proporcionado el parámetro id_reporte.";
}
?>
