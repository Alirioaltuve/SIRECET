<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el mes y el año seleccionados
    $mes = $_POST['mes'];
    $anio = $_POST['anio'];

    // Incluir conexión a la base de datos
    include_once("../../conexion.php");

    // Consulta SQL para seleccionar los reportes completados dentro del mes y año seleccionados
    $queryusuarios = mysqli_query($conn, "SELECT * FROM reportes WHERE dependencia = 'Dirección Planificación y Presupuesto' AND MONTH(fecha) = $mes AND YEAR(fecha) = $anio ORDER BY fecha DESC");

    // Generar el contenido HTML para el PDF
    ob_start();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Reportes de D.P.P: <?php echo $mes."/".$anio;?></title>
        <style>
            /* Agregar estilos CSS aquí si es necesario */
        </style>
    </head>
    <body>
        
        <table border="1">
            <tr>
            <th colspan="5"><h1>SOLICITUDES DE REPORTES (Dirección Planificación y Presupuesto): <?php echo $mes."/".$anio;?></h1></th>
        </tr>
            <thead>
                <tr>
                    <th>Equipo</th>
                    <th>Servicio</th>
                    <th>Dependencia</th>
                    <th>Fecha-I</th>
                    <th>Descripción</th>
                   
                </tr>
            </thead>
            <tbody>
                <?php 
                if(mysqli_num_rows($queryusuarios) === 0) {
                    echo "<tr><td colspan='5'>No hay reportes completados disponibles para este mes y año.</td></tr>";
                } else {
                    while($mostrar = mysqli_fetch_array($queryusuarios)) {      
                        echo "<tr>";    
                        echo "<td>".$mostrar['equipo']."</td>";
                        echo "<td>".$mostrar['servicio']."</td>";  
                        echo "<td>".$mostrar['dependencia']."</td>"; 
                        echo "<td>".$mostrar['fecha']."</td>";
                        echo "<td style='width:26%; max-width: 300px; word-wrap: break-word;'>".$mostrar['descripcion']."</td>";
                       
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
    $nombre_archivo = "reportes_D.P.P_$anio-$mes.pdf";
    $dompdf->stream($nombre_archivo, array("Attachment" => false));
}
?>


