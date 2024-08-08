<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Redirigir al usuario al inicio de sesión si no ha iniciado sesión
    header("Location: ../login/index.html");
    exit();
}

// Verificar si el usuario tiene permiso para acceder a esta página según su rol
$usuario_actual = $_SESSION['usuario'];
$permisos = array(
    "todos" => array("admin"), // Usuarios que pueden acceder a despacho1
    
);

// Verificar si el usuario tiene permiso para acceder a esta página
$nombre_pagina = "todos"; // Definir manualmente el nombre de la página


// Verificar si el usuario tiene permiso para acceder a esta página
if (!in_array($usuario_actual, $permisos[$nombre_pagina])) {
    // El usuario no tiene permiso para acceder a esta página, redirigirlo a una página de error o a la página principal
    header("Location: ../cerrar_sesion.php");
    exit();
    
}

include_once("../conexion.php"); 

if(isset($_POST['btnbuscar'])) {
    // Modificar la consulta para incluir el estado
    $estado = $_POST['estado'];
    $equipo = $_POST['equipo'];
    $servicio = $_POST['servicio'];
    $dependencia = $_POST['dependencia'];

    $query = "SELECT id_reporte, equipo, numero, servicio, dependencia, fecha, descripcion, estado, fecha_actualizacion_estado FROM reportes WHERE  archivado = 'No' AND 1";

    // Agregar condiciones según los campos de búsqueda que se hayan proporcionado
    if (!empty($estado)) {
        $query .= " AND estado='$estado'";
    }
    if (!empty($equipo)) {
        $query .= " AND equipo LIKE '%$equipo%'";
    }
    if (!empty($servicio)) {
        $query .= " AND servicio LIKE '%$servicio%'";
    }
    if (!empty($dependencia)) {
        $query .= " AND dependencia LIKE '%$dependencia%'";
    }

    $query .= " ORDER BY fecha DESC";

    $queryusuarios = mysqli_query($conn, $query);
} else {
    $queryusuarios = mysqli_query($conn, "SELECT * FROM reportes WHERE archivado = 'No' ORDER BY fecha DESC");
}
?>

<html>
<head>    
        <title>SIRECET-CEBM: Solicitudes</title>
        <meta charset="UTF-8">
        <link id="themeStyles" rel="stylesheet" href="style.css">

</head>
<body class="<?php echo isset($_SESSION['theme']) ? $_SESSION['theme'] : ''; ?>">


<!-------Aqui el codigo de la barra lateral---->

<header>       
    <div class="barra">
        <a href="../cerrar_sesion.php">
            <img src="../imagenes/poder.png" title="Cerrar Sesión">
            
        </a>     
    </div> 
</header>

<!------aqui empieza el resto del codigo el formulario, y los demas botones, junto con la barra de buscar-->


<table>
     <div id="barrabuscar">
                
        <form method="POST">
            <center>
    <a href="../todos/index.php" class="primera">Recargar &#10227;</a> 
       <a href="../pendientes/index.php" class="primera">Pendientes&#9200;</a>
       <a href="../completado/index.php" class="primera">Completados&#9989;</a>
       <a  class="primera" onclick="abrirpdf()">Exportar &#128209;</a>


       <label class="switch">
        <input type="checkbox" id="input">
        <span class="slider"></span>
        </label>

       </center>  
        </form>
        </div>
    <tr><th colspan="8"><h1>SOLICITUDES DE REPORTES PENDIENTES/COMPLETADOS</h1><th><a style="font-weight: normal; font-size: 14px;" onclick="abrirform()" class="primera">Filtros&#128269;</a></th></tr>

    <tr>
        <th>Equipo</th>
        <th>Numero</th>
        <th>Servicio</th>
        <th>Dependencia</th>
        <th>Fecha-I</th>
        <th>Descripción</th>
        <th>Estado</th>
        <th>Fecha-C</th>
        <th>Acción</th>
    </tr>

<?php 
if(mysqli_num_rows($queryusuarios) === 0) {
    echo "<tr><td colspan='9'>No hay reportes disponibles</td></tr>";
} else {
    while($mostrar = mysqli_fetch_array($queryusuarios)) {      
        echo "<tr>";    
        echo "<td>".$mostrar['equipo']."</td>";
        echo "<td>".$mostrar['numero']."</td>";    
        echo "<td>".$mostrar['servicio']."</td>";  
        echo "<td>".$mostrar['dependencia']."</td>"; 
        echo "<td>".$mostrar['fecha']."</td>";
        echo "<td style='width:26%; max-width: 300px; word-wrap: break-word;'>".$mostrar['descripcion']."</td>";
        echo "<td>".$mostrar['estado']."</td>";
        echo "<td>".$mostrar['fecha_actualizacion_estado']."</td>";
        echo "<td style='width:26%'><a href=\"eliminar.php?id_reporte=$mostrar[id_reporte]\" onClick=\"return confirm('¿Estás Seguro de Eliminar el Reporte ?')\" class='primera'>Eliminar &#128465;&#65039;</a></td>";           
    }
}
?>
</table>

<!---javascript para que nos muestre los campos del filtro al hacerle click--->
<script>
function abrirform() {
  document.getElementById("formregistrar").style.display = "block";  
}

function cancelarform() {
  document.getElementById("formregistrar").style.display = "none";
}
</script>
<!---javascript para que nos muestre los campos del filtro al hacerle click--->

<div class="caja_popup" id="formregistrar">
    <table class="contenedor_popup">
        <tr><th colspan="2">Filtros</th></tr>
        <form method="POST">
          
            <tr> 
                <td>Equipo</td>
                <td><select name="equipo" id="equipo" >
            <option value="">Seleccione un Equipo Tecnológico</option>
            <option value="Computador y Laptop">Computador y Laptop</option>
            <option value="Telefonía">Telefonía</option>
             <option value="Redes">Redes</option>
              <option value="Paginas Web">Paginas Web</option>
               <option value="Impresora y Fotocopiadora">Impresora y Fotocopiadora</option></td>
            </tr>
            <tr> 
                <td>Servicio</td>
                <td><select name="servicio" id="servicio" >
            <option value="">Seleccione el Tipo de Servicio</option>     
            <option value="Asistencia y Soporte Técnico">Asistencia y Soporte Técnico</option>
            <option value="Mantenimiento Correctivo y Preventivo">Mantenimiento Correctivo y Preventivo</option>
            <option value="Administración de Sistemas">Administración de Sistemas</option>
            <option value="Administración de Redes">Administración de Redes</option>
            <option value="Actualización de Página Web">Actualización de Página Web</option></td>
            </tr>
            <tr> 
                <td>Dependencia</td>
                <td><select name="dependencia" id="dependencia">
            <option  value="">Seleccione una Dependencia</option>
            <option value="Dirección de Administración ">Dirección de Administración </option>
            <option value="Dirección de Atención al Ciudadano">Dirección de Atención al Ciudadano</option>
            <option value="Dirección de Bienes y Servicios Generales">Dirección de Bienes y Servicios Generales</option>
            <option value="Dirección de Centro de Desarrollo Integral, Formación y Recreación de la Contraloría">Dirección de Centro de Desarrollo Integral, Formación y Recreación de la Contraloría</option>
            <option value="Dirección de Consultoría Jurídica">Dirección de Consultoría Jurídica</option>
            <option value="Despacho del Contralor">Despacho del Contralor</option>
            <option value="Dirección de Control de la Administración Central y Otro Poder">Dirección de Control de la Administración Central y Otro Poder</option>
            <option value="Dirección de Control de la Administración de Descentralizada">Dirección de Control de la Administración de Descentralizada</option>
            <option value="Dirección de Determinación de Responsabilidades Administrativas">Dirección de Determinación de Responsabilidades Administrativas</option>
            <option value="Dirección del Despacho">Dirección del Despacho </option>
            <option value="Despacho del Subcontralor o Subcontralora">Despacho del Subcontralor o Subcontralora</option>
            <option value="Dirección de Gestión de Talentos Humanos">Dirección de Gestión de Talentos Humanos</option>
            <option value="Dirección de Potestad Investigativa">Dirección de Potestad Investigativa</option>
            <option value="Dirección Planificación y Presupuesto">Dirección Planificación y Presupuesto</option>
            <option value="Dirección de Relaciones Interinstitucionales">Dirección de Relaciones Interinstitucionales</option>
            <option value="Dirección de Salud, Seguridad, Prevención, Investigación y Control de Riesgos">Dirección de Salud, Seguridad, Prevención, Investigación y Control de Riesgos</option>
            <option value="Unidad de Auditoría Interna">Unidad de Auditoría Interna</option>
            <option value="Unidad de Control de Gestión">Unidad de Control de Gestión</option>
            <option value="Unidad Técnica de Proyectos de Ingeniería">Unidad Técnica de Proyectos de Ingeniería</option></td>
            </tr>
              <tr>
                <td>Estado</td>
                <td>
                    <select name="estado" id="estado">
                        <option value="">Seleccionar Estado</option>
                        <option value="Pendiente">Pendiente</option>
                        <option value="Completado">Completado</option>
                    </select>
                </td>
            </tr>
            <tr>    
                <td colspan="2">
                    <button type="button" onclick="cancelarform()" class="primera">Cancelar&#10060</button>
                    <input type="submit" name="btnbuscar" class="primera" value="Buscar &#128270;"> 
                </td>
            </tr>
        </form>
    </table>
</div>

<!---el formulario para generar los pdf por mes y año---->
<script>
function abrirpdf() {
  document.getElementById("generarpdf").style.display = "block";  
}

function cancelarpdf() {
  document.getElementById("generarpdf").style.display = "none";
}
</script>

<div class="caja_popup" id="generarpdf">
    <table class="contenedor_popup">
        <tr><th colspan="2">Exportar PDF</th></tr>
        <form method="POST" action="reporte.php">
          
          <tr> 
                <td>Mes</td>
                <td><select name="mes" required>
            <option value="">Seleccione un Mes</option>
            <option value="1">Enero</option>
            <option value="2">Febrero</option>
             <option value="3">Marzo</option>
             <option value="4">Abril</option>
            <option value="5">Mayo</option>
            <option value="6">Junio</option>
            <option value="7">Julio</option>
            <option value="8">Agosto</option>
            <option value="9">Septiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
           </td>
        </tr>
        <tr> 
                <td>Año</td>
                <td><select name="anio" required>
            <option value="">Seleccione un Año</option>
            <option value="2024">2024</option>
          

           </td>
        </tr>

              
            <tr>    
                <td colspan="2">
                    <button type="button" onclick="cancelarpdf()" class="primera">Cancelar&#10060;</button>
                    <input type="submit" name="btnpdf" class="primera" value="Descargar&#128229;"> 
                </td>
            </tr>
        </form>
    </table>
    
</div>

<!---el formulario para generar los pdf por mes y año---->




 <!-- Slider para cambiar entre modos oscuro y claro -->

<!-- Script para cambiar entre modos oscuro y claro -->



<script>
document.addEventListener("DOMContentLoaded", function() {
    const body = document.body;
    const themeToggle = document.getElementById('input');

    // Verificar y aplicar el tema almacenado en la sesión al cargar la página
    const theme = body.classList.contains('dark') ? 'dark' : 'light';
    if (theme === 'dark') {
        themeToggle.checked = true; // Marcar el botón si el tema es oscuro
    }

    themeToggle.addEventListener('change', () => {
        const newTheme = themeToggle.checked ? 'dark' : 'light';
        
        fetch('../cambiar_tema.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ theme: newTheme }),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Ocurrió un error al cambiar el tema');
            }
            body.className = newTheme;
        })
        .catch(error => {
            console.error('Error:', error);
            themeToggle.checked = !themeToggle.checked;
        });
    });
});
</script>







</body>
</html>