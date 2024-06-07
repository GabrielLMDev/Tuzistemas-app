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
if (isset($_POST['group'])) {
    $group = $_POST['group'];

    // Consulta para obtener el archivo
    $stmt = $conexion->prepare("SELECT S_Name, S_Type, S_Content, S_Size FROM schedule WHERE S_Group = ?");
    $stmt->bind_param("s", $group);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($fileName, $fileType, $contentFile, $fileSize);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        $fileName = $fileName . '.pdf';
        /*
        echo "Archivo encontrado en la base de datos.<br>";
        echo "Nombre del archivo: $nombreArchivo<br>";
        echo "Tipo de archivo: $tipoArchivo<br>";
        echo "Tamaño del archivo: $tamañoArchivo bytes<br>";
        echo $contenidoArchivo;
        */

        header("Content-Type: $fileType");
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Content-Length: $fileSize");
        echo $contentFile;
    } else {
        echo "Archivo no encontrado en la base de datos.";
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    echo "ID de archivo no válido.";
}

// Cerrar la conexión
$conexion->close();