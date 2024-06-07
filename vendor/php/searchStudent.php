<?php
// Configuración de la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$data_base = 'tuzistemaapp';

$conn = new mysqli($host, $user, $password, $data_base);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$nombre = $_GET['nombre'];
if ($nombre == '') {
    header('Content-Type: application/json');
    echo json_encode('');
} else {
    // Consulta SQL dinámica
    $sql = "SELECT `u_id`, `U_name`, `U_mail`, `U_phone`, `U_enrollment` FROM users WHERE U_name LIKE '%" . $nombre . "%' AND U_role = 3";
    $result = $conn->query($sql);

    $resultados = array();

    if ($result->num_rows > 0) {
        // Almacena los resultados en un arreglo
        while ($row = $result->fetch_assoc()) {
            $resultados[] = array('U_id' => $row['u_id'], 'U_name' => $row['U_name'], 'U_mail' => $row['U_mail'], 'U_phone' => $row['U_phone'], 'U_enrollment' => $row['U_enrollment']);
        }
    }

    // Devuelve los resultados en formato JSON
    header('Content-Type: application/json');
    echo json_encode($resultados);
}



$conn->close();
