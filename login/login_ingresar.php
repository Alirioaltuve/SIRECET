<?php
include("../conexion.php");

// Verificar si se han enviado datos por el método POST
if (isset($_POST["btningresar"])) {
    $nombre = $_POST["usuario"];
    $pass = $_POST["password"];

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Preparar la consulta
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nombre_usuario = ? AND contrasena = ?");
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ss", $nombre, $pass);

    // Ejecutar la consulta
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró el usuario
    if ($result && $result->num_rows == 1) {
        session_start();
        $_SESSION['usuario'] = $nombre;

        // Obtener información del usuario
        $filas = $result->fetch_assoc();

        // Validar el rol del usuario
        switch ($filas['id_cargo']) {
            case 1:
                echo "<script> alert('Bienvenid@ Administrador $nombre'); window.location='../pendientes/index.php'</script>";
                break;
            case 2:
                echo "<script> alert('Bienvenid@ $nombre'); window.location='../comun/despacho1/index.php'</script>";
                break;
            case 3:
                echo "<script> alert('Bienvenid@ $nombre'); window.location='../comun/despacho2/index.php'</script>";
                break;
            case 4:
                echo "<script> alert('Bienvenid@ $nombre'); window.location='../comun/despacho3/index.php'</script>";
                break;
            case 5:
                echo "<script> alert('Bienvenid@ $nombre'); window.location='../comun/despacho4/index.php'</script>";
                break;
            case 6:
                echo "<script> alert('Bienvenid@ $nombre'); window.location='../comun/despacho5/index.php'</script>";
                break;
            case 7:
                echo "<script> alert('Bienvenid@ $nombre'); window.location='../comun/despacho6/index.php'</script>";
                break;
            case 8:
                echo "<script> alert('Bienvenid@ $nombre'); window.location='../comun/despacho7/index.php'</script>";
                break;
            case 9:
                echo "<script> alert('Bienvenid@ $nombre'); window.location='../comun/despacho8/index.php'</script>";
                break;
            case 10:
                echo "<script> alert('Bienvenid@ $nombre'); window.location='../comun/despacho9/index.php'</script>";
                break;
            case 11:
                echo "<script> alert('Bienvenid@ $nombre'); window.location='../comun/despacho10/index.php'</script>";
                break;
            case 12:
                echo "<script> alert('Bienvenid@ $nombre'); window.location='../comun/despacho11/index.php'</script>";
                break;
            case 13:
                echo "<script> alert('Bienvenid@ $nombre'); window.location='../comun/despacho12/index.php'</script>";
                break;
            case 14:
                echo "<script> alert('Bienvenid@ $nombre'); window.location='../comun/despacho13/index.php'</script>";
                break;
            case 15:
                echo "<script> alert('Bienvenid@ $nombre'); window.location='../comun/despacho14/index.php'</script>";
                break;
            case 16:
                echo "<script> alert('Bienvenid@ $nombre'); window.location='../comun/despacho15/index.php'</script>";
                break;
            case 17:
                echo "<script> alert('Bienvenid@ $nombre'); window.location='../comun/despacho16/index.php'</script>";
                break;
            case 18:
                echo "<script> alert('Bienvenid@ $nombre'); window.location='../comun/despacho17/index.php'</script>";
                break;
            case 19:
                echo "<script> alert('Bienvenid@ $nombre'); window.location='../comun/despacho18/index.php'</script>";
                break;
            case 20:
                echo "<script> alert('Bienvenid@ $nombre'); window.location='../comun/despacho19/index.php'</script>";
                break;
            default:
                echo "<script> alert('Usuario o contraseña incorrectos'); window.location='index.html'</script>";
                break;
        }
    } else {
        // Si no se encuentra el usuario o la autenticación falla
        echo "<script> alert('Usuario o contraseña incorrectos'); window.location='index.html'</script>";
    }
    $stmt->close();
    $conn->close();
}
?>
