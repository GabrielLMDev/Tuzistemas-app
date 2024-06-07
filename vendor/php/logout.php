<?php
// Eliminar la cookie estableciendo una fecha de expiración en el pasado
setcookie("user", "", time() - 3600, "/");

// Redirigir al formulario de login
header("Location: ../../index.php");
exit();
?>
