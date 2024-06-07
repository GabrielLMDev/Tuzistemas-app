<?php

require("bd_Conection.php");

$uMail = $_POST['mail'];
$uPassword = $_POST['password'];

$records = $conn->prepare('SELECT * FROM users WHERE U_mail = :user');
$records->bindParam(':user', $uMail);
$records->execute();

$results = $records->fetch(PDO::FETCH_ASSOC);
if ($results > 0) {
    $view = $results['U_role'];
    if (password_verify($uPassword, $results['U_password'])) {

        $cookie_name = "user";
        $cookie_values = array(
            "name" => $results['U_name'],
            "mail" => $results['U_mail'],
            "role" => $results['U_role'],
            "enrollment" => $results['U_enrollment'],
            "groupLeader" => $results['U_boss'],
            "groupClass" => $results['U_group']

        );
        $cookie_value = json_encode($cookie_values);
        $expiration_time = time() + (86400 * 10); // La cookie dura 10 días
        $path = "/"; // Ruta (disponible en todo el sitio)

        switch ($view) {
            case '1':
                setcookie($cookie_name, $cookie_value, $expiration_time, $path);
                header("Location: ../../views/viewJefe/home.php");
                break;
            case '2':
                setcookie($cookie_name, $cookie_value, $expiration_time, $path);
                header("Location: ../../views/viewDocente/home.php");
                break;
            case '3':
                setcookie($cookie_name, $cookie_value, $expiration_time, $path);
                header("Location: ../../views/viewAlumno/home.php");
                break;
            default:
                header("Location: ../../index.php");
                break;
        }
    } else {
        echo json_encode('Error con la contraseña');
    }
} else {
    echo json_encode('Error en la consulta');
}
