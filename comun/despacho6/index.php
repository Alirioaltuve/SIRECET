<?php 

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Redirigir al usuario al inicio de sesión si no ha iniciado sesión
    header("Location: ../../login/index.html");
    exit();
}

// Verificar si el usuario tiene permiso para acceder a esta página según su rol
$usuario_actual = $_SESSION['usuario'];
$permisos = array(
    "despacho6" => array("despacho6"), // Usuarios que pueden acceder a despacho1
    
);

// Verificar si el usuario tiene permiso para acceder a esta página
$nombre_pagina = "despacho6"; // Definir manualmente el nombre de la página


// Verificar si el usuario tiene permiso para acceder a esta página
if (!in_array($usuario_actual, $permisos[$nombre_pagina])) {
    // El usuario no tiene permiso para acceder a esta página, redirigirlo a una página de error o a la página principal
    header("Location: ../../cerrar_sesion.php");
    exit();
}


include_once("../../conexion.php"); 

if(isset($_POST['btnbuscar'])) {
    // Modificar la consulta para incluir el estado
    
    $equipo = $_POST['equipo'];
    $servicio = $_POST['servicio'];
    

    $query = "SELECT id_reporte, equipo, numero, servicio, dependencia, fecha, descripcion FROM reportes WHERE dependencia = 'Despacho del Contralor' AND archivado = 'No'  AND 1";


    // Agregar condiciones según los campos de búsqueda que se hayan proporcionado
    if (!empty($equipo)) {
        $query .= " AND equipo LIKE '%$equipo%'";
    }
    if (!empty($servicio)) {
        $query .= " AND servicio LIKE '%$servicio%'";
    }

    $query .= " ORDER BY fecha DESC";

    $queryusuarios = mysqli_query($conn, $query);
} else {
    $queryusuarios = mysqli_query($conn, "SELECT * FROM reportes WHERE dependencia = 'Despacho del Contralor' AND archivado = 'No' ORDER BY fecha DESC");
}
?>

<html>
<head>    
        <title>SIRECET-CEBM: Reportes/DC</title>
        <meta charset="UTF-8">
        <link id="themeStyles" rel="stylesheet" href="style.css">

</head>
<body class="<?php echo isset($_SESSION['theme7']) ? $_SESSION['theme7'] : ''; ?>">

<!-------Aqui el codigo de la barra lateral---->

<header>       
    <div class="barra">
        <a href="../../cerrar_sesion.php">
            <img src="../../imagenes/poder.png" title="Cerrar Sesión">
            
        </a>     
    </div> 
</header>

<!------aqui empieza el resto del codigo el formulario, y los demas botones, junto con la barra de buscar-->


<table>
     <div id="barrabuscar">
                
        <form method="POST">
            <center>
    <a href="index.php" class="primera">Recargar &#10227;</a>
     <a  class="primera" onclick="abrirpdf()">Exportar &#128209;</a> 
       

       <label class="switch">
        <input type="checkbox" id="input">
        <span class="slider"></span>
        </label>

       </center>  
        </form>
        </div>
    <tr><th colspan="5"><h1>REPORTES/DC</h1><th><a style="font-weight: normal; font-size: 14px;" onclick="abrirform()" class="primera">Filtros&#128269;</a>|<a style="font-weight: normal; font-size: 14px;" onclick="abrirform2()" class="primera">&#10133;Nuevo</a></th></tr>

    <tr>
        <th>Equipo</th>
        <th>Numero</th>
        <th>Servicio</th>
        <th>Dependencia</th>
        <th>Fecha</th>
        <th>Descripción</th>
        
        
    </tr>

<?php 
if(mysqli_num_rows($queryusuarios) === 0) {
    echo "<tr><td colspan='8'>No hay reportes disponibles</td></tr>";
} else {
    while($mostrar = mysqli_fetch_array($queryusuarios)) {      
        echo "<tr>";    
        echo "<td>".$mostrar['equipo']."</td>";
        echo "<td>".$mostrar['numero']."</td>";    
        echo "<td>".$mostrar['servicio']."</td>";  
        echo "<td>".$mostrar['dependencia']."</td>"; 
        echo "<td>".$mostrar['fecha']."</td>";
         echo "<td style='width:26%; max-width: 300px; word-wrap: break-word;'>".$mostrar['descripcion']."</td>";
        
                  
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
                <td colspan="2">
                    <button type="button" onclick="cancelarform()" class="primera">Cancelar&#10060;</button>
                    <input type="submit" name="btnbuscar" class="primera" value="Buscar&#128270;"> 
                </td>
            </tr>
        </form>
    </table>
</div>


<!---javascript para que nos muestre los campos del filtro al hacerle click--->
<script>
function abrirform2() {
  document.getElementById("formregistrar2").style.display = "block";  
}

function cancelarform2() {
  document.getElementById("formregistrar2").style.display = "none";
}
</script>
<!---javascript para que nos muestre los campos del filtro al hacerle click--->

<div class="caja_popup" id="formregistrar2">
  <form action="agregar.php" method="POST">
        <table class="contenedor_popup" >
        <tr><th colspan="1">Nuevo Reporte</th></tr>
            <tr> 
                <td>Equipo Tecnológico <br><br><select name="txtequipo" required>
            <option value="">Seleccione un Equipo Tecnológico</option>
            <option value="Computador y Laptop">Computador y Laptop</option>
            <option value="Telefonía">Telefonía</option>
             <option value="Redes">Redes</option>
              <option value="Paginas Web">Paginas Web</option>
               <option value="Impresora y Fotocopiadora">Impresora y Fotocopiadora</option></td>
                
            </tr>

            <tr> 
    <td>Numero de Bien <br><br>
        <select name="posee_numero" onchange="mostrarInput(this)" required>
            <option value="">¿Posee Número de Bien?</option>
            <option value="si">Sí</option>
            <option value="no">No</option>
        </select>
        <input type="text" name="txtnumero" oninput="checkPrefix(this)" style="display: none;">
    </td>
</tr>
<script>
  function checkPrefix(input) {
    // Verificar si el valor comienza con "cem-"
    if (!input.value.startsWith('cem-')) {
      // Si no comienza con "cem-", restablecerlo a "cem-"
      input.value = 'cem-';
    }
  }
</script>
<script>
    function mostrarInput(selectElement) {
        var inputNumeroBien = selectElement.parentNode.parentNode.querySelector('input[name="txtnumero"]');
        if (selectElement.value === 'si') {
            inputNumeroBien.style.display = 'inline-block'; // Muestra el cuadro de texto cuando se selecciona "Sí"
            inputNumeroBien.value = 'cem-'; // Limpia el valor del cuadro de texto si se selecciona "Sí"
        } else {
            inputNumeroBien.style.display = 'none'; // Oculta el cuadro de texto cuando se selecciona "No"
            inputNumeroBien.value = 'No Posee'; // Asigna el valor 'no posee' al cuadro de texto cuando se selecciona "No"
        }
    }
</script>
            
            <tr> 
                <td>Tipo de Servicio <br><br><select name="txtservicio" required>
            <option value="">Seleccione el Tipo de Servicio</option>     
            <option value="Asistencia y Soporte Técnico">Asistencia y Soporte Técnico</option>
            <option value="Mantenimiento Correctivo y Preventivo">Mantenimiento Correctivo y Preventivo</option>
            <option value="Administración de Sistemas">Administración de Sistemas</option>
            <option value="Administración de Redes">Administración de Redes</option>
            <option value="Actualización de Página Web">Actualización de Página Web</option></td>
                
            </tr>
            <tr> 
                <td>Dependencia <br><br><select name="txtdependencia" required>
            <option  value="">Seleccione una Dependencia</option>
            <option value="Despacho del Contralor">Despacho del Contralor</option>
            </td>

             
            </tr>
            <tr> 
                <td>Descripción de la Falla <br><br>
                    <textarea name="txtdescripcion" id="txtdescripcion" rows="4" maxlength="200" required style="width: 300px; resize: none;"></textarea>
<p>Caracteres restantes: <span id="contador">200</span></p>

<script type="text/javascript">
    const textarea = document.getElementById('txtdescripcion');
const contador = document.getElementById('contador');
const maxLength = 200;

textarea.addEventListener('input', function() {
  const remaining = maxLength - this.value.length;
  contador.textContent = remaining;
});
</script> </td>
            
            </tr>

            <tr>    
               <td colspan="1">
                   <button type="button" onclick="cancelarform2()" class="primera">Cancelar&#10060;</button>
                   <input type="submit" name="btnregistrar" class="primera" value="Enviar&#128233;" onClick="javascript: return confirm('¿Deseas Enviar la Solicitud de tu Reporte?');">
            </td>
            </tr>
        </table>
    </form>
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
    const theme7Toggle = document.getElementById('input');

    // Verificar y aplicar el tema almacenado en la sesión al cargar la página
    const theme7 = body.classList.contains('dark') ? 'dark' : 'light';
    if (theme7 === 'dark') {
        theme7Toggle.checked = true; // Marcar el botón si el tema es oscuro
    }

    theme7Toggle.addEventListener('change', () => {
        const newtheme7 = theme7Toggle.checked ? 'dark' : 'light';
        
        fetch('cambiar_tema.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ theme7: newtheme7 }),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Ocurrió un error al cambiar el tema');
            }
            body.className = newtheme7;
        })
        .catch(error => {
            console.error('Error:', error);
            theme7Toggle.checked = !theme7Toggle.checked;
        });
    });
});
</script>






</body>
</html>