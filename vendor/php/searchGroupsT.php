<?php
$conexion = new mysqli("localhost", "root", "", "tuzistemaapp");
// Verificar la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

$enrollment = $_GET['enrollment'];

$stmt = $conexion->prepare("SELECT `gT_group` FROM `group_teacher` WHERE gT_enrollment = ?");
$stmt->bind_param("s", $enrollment);

// Ejecutar la consulta
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $lista = array();
    // Salida de datos de cada fila
    while ($row = $result->fetch_assoc()) {
        $lista[] = $row;
    }
    echo json_encode($lista);
}
