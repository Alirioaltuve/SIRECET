<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el año seleccionado
    $anio = $_POST['anio'];
    // Obtener la dependencia seleccionada (si está presente)
    $dependencia = isset($_POST['dependencia']) ? $_POST['dependencia'] : '';

    // Incluir conexión a la base de datos
    include_once("../conexion.php");

    // Consulta SQL para seleccionar los reportes completados dentro del año seleccionado
    $query = "SELECT * FROM reportes WHERE estado = 'completado' AND archivado = 'Si' AND YEAR(fecha) = $anio";

    // Si se seleccionó una dependencia, agregarla a la consulta
    if (!empty($dependencia)) {
        $query .= " AND dependencia = '$dependencia'";
    }

    $query .= " ORDER BY fecha DESC";

    $queryusuarios = mysqli_query($conn, $query);

    // Generar el contenido HTML para el PDF
    ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reportes: <?php echo $dependencia. " - " .$anio; ?></title>
    <style>
        /* Agregar estilos CSS aquí si es necesario */
    </style>
</head>
<body>
    <table border="1">
        <tr>
            <th colspan="6"><h1>REPORTES: <?php echo $dependencia. " - " .$anio; ?></h1></th>
        </tr>
        <thead>
            <tr>
                <th>Equipo</th>
                <th>Servicio</th>
                <th>Dependencia</th>
                <th>Fecha-I</th>
                <th>Descripción</th>
                <th>Fecha-C</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(mysqli_num_rows($queryusuarios) === 0) {
                echo "<tr><td colspan='6'>No hay reportes completados disponibles para este año.</td></tr>";
            } else {
                while($mostrar = mysqli_fetch_array($queryusuarios)) {      
                    echo "<tr>";    
                    echo "<td>".$mostrar['equipo']."</td>";
                    echo "<td>".$mostrar['servicio']."</td>";  
                    echo "<td>".$mostrar['dependencia']."</td>"; 
                    echo "<td>".$mostrar['fecha']."</td>";
                    echo "<td style='width:26%; max-width: 300px; word-wrap: break-word;'>".$mostrar['descripcion']."</td>";
                    echo "<td>".$mostrar['fecha_actualizacion_estado']."</td>";   
                }
            }
            ?>
        </tbody>
    </table>
</body>
</html>
<?php
    $html = ob_get_clean();

    $html .= '
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
    }

    th, td {
        border: 1px solid #dddddd;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    thead {
        display: table-header-group;
    }
    
</style>
';

    // Incluir la biblioteca Dompdf
    require_once 'libreria/dompdf/autoload.inc.php';

    // Inicializar Dompdf
    $dompdf = new Dompdf\Dompdf();

    // Cargar el contenido HTML en Dompdf
    $dompdf->loadHTML($html);
    $dompdf->setPaper('A4', 'landscape');

    // Renderizar el contenido
    $dompdf->render();

    // Generar el PDF
    $nombre_archivo = "reportes_$dependencia - $anio.pdf";
    $dompdf->stream($nombre_archivo, array("Attachment" => false));
}
?>
