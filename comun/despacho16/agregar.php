<?php
include_once("../../conexion.php");

// Obtener los valores de los campos del formulario
$equipo = $_POST['txtequipo'];
$numero = $_POST['txtnumero'];
$servicio = $_POST['txtservicio'];
$dependencia = $_POST['txtdependencia'];
$descripcion = $_POST['txtdescripcion'];

// Preparar la consulta SQL con una sentencia preparada
$stmt = $conn->prepare("INSERT INTO reportes (equipo, numero, servicio, dependencia, descripcion) VALUES (?, ?, ?, ?, ?)");

// Vincular los parámetros a los valores de las variables
$stmt->bind_param("sssss", $equipo, $numero, $servicio, $dependencia, $descripcion);

// Ejecutar la consulta preparada
$stmt->execute();

// Redirigir a la página index.php después de la inserción
header("Location: index.php");

// Cerrar la conexión y la declaración preparada
$stmt->close();
$conn->close();
?>
