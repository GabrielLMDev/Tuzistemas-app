<?php
// Configuración de la base de datos
$host = 'localhost';
$usuario = 'root';
$contraseña = '';
$base_de_datos = 'tuzistemaapp';

// Conexión a la base de datos
$conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$cookie_value = $_COOKIE['user']; //obtener cookie.
$cookie_values = json_decode($cookie_value, true); //obtener los valores de la cookie.
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['File']) && $_FILES['File']['error'] == UPLOAD_ERR_OK) {
    $userEnrollment = $cookie_values['enrollment'];
    $group = strtoupper($_POST['groupFile']);
    $nombreArchivo = "Horario - ". $group;
    $tipoArchivo = $_FILES['File']['type'];
    $tamañoArchivo = $_FILES['File']['size'];
    $contenidoArchivo = file_get_contents($_FILES['File']['tmp_name']);

    // Consulta para insertar el archivo en la base de datos
    $stmt = $conexion->prepare("INSERT INTO schedule (S_Name, S_Type, S_Size, S_Content, S_Group, S_Autor) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $nombreArchivo, $tipoArchivo, $tamañoArchivo, $contenidoArchivo, $group, $userEnrollment);

    if ($stmt->execute()) {
        $mensaje = "Archivo enviado correctamente.";
        header("Location: home.php?status=successUpload");
    } else {
        $mensaje = "Error al enviar el archivo: " . $stmt->error;
        header("Location: home.php?status=errorUpload");
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    echo "Error en la subida del archivo.";
}

// Cerrar la conexión
$conexion->close();
