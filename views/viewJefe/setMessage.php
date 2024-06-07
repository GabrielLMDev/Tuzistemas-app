<?php
// Configuración de la base de datos
$host = 'localhost';
$usuario = 'root';
$contraseña = '';
$base_de_datos = 'tuzistemaapp';
$cookie_value = $_COOKIE['user']; //obtener cookie.
$cookie_values = json_decode($cookie_value, true); //obtener los valores de la cookie.
// Conexión a la base de datos
$conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['receiver']) && isset($_POST['subject']) && isset($_POST['message'])) {
    $receiver = $_POST['receiver'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $sender = $cookie_values['enrollment'];
    // Consulta para insertar el archivo en la base de datos
    $stmt = $conexion->prepare("INSERT INTO `notifications`(`n_Sender`, `n_Receiver`, `n_Subject`, `n_Message`) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $sender, $receiver, $subject, $message);

    if ($stmt->execute()) {
        $mensaje = "Mensaje correctamente.";
        header("Location: home.php?status=MSS&ms=" . $mensaje);
    } else {
        $mensaje = "Error al enviar Mensaje: " . $stmt->error;
        header("Location: home.php?status=MSE&ms=" . $mensaje);
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    $mensaje = "Error al enviar Mensaje: " . $stmt->error;
    header("Location: home.php?status=MSE&ms=" . $mensaje);
}

// Cerrar la conexión
$conexion->close();
