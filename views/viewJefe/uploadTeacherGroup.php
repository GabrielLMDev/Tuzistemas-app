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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['groupSelect']) && isset($_POST['teacherSelect'])) {
    $group = $_POST['groupSelect'];
    $teacher = $_POST['teacherSelect'];
    // Consulta para insertar el archivo en la base de datos
    $stmt = $conexion->prepare("INSERT INTO group_teacher (gT_enrollment, gT_group) VALUES (?, ?)");
    $stmt->bind_param("ss", $teacher, $group);

    if ($stmt->execute()) {
        $mensaje = "Docente asigando correctamente.";
        header("Location: home.php?status=DS&ms=" . $mensaje);
    } else {
        $mensaje = "Error al asignar docente: " . $stmt->error;
        header("Location: home.php?status=DE&ms=" . $mensaje);
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    echo "Error en la subida del archivo.";
}

// Cerrar la conexión
$conexion->close();
