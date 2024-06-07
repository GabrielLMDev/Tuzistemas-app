<?php
// Configuración de la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$data_base = 'tuzistemaapp';

$conexion = new mysqli($host, $user, $password, $data_base);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta para obtener el archivo
    $sql = "DELETE FROM `group_teacher` WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $mensaje = "Docente Eliminado correctamente.";
        header("Location: home.php?status=DD&ms=" . $mensaje);
    } else {
        $mensaje = "Error al Eliminar docente: " . $stmt->error;
        header("Location: home.php?status=DDE&ms=" . $mensaje);
    }
    // Cerrar la declaración
    $stmt->close();
} else {
    echo "ID de archivo no especificado.";
}

// Cerrar la conexión
$conexion->close();
