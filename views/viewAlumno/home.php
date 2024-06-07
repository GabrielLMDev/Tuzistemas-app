<?php
if (!isset($_COOKIE['user'])) {
    header("Location: ../../index.php");
    exit();
} else {
    $cookie_value = $_COOKIE['user']; //obtener cookie.
    $cookie_values = json_decode($cookie_value, true); //obtener los valores de la cookie.
    switch ($cookie_values['role']) {
        case '1':
            header("Location: ../../views/viewJefe/home.php");
            break;
        case '2':
            header("Location: ../../views/viewDocente/home.php");
            break;
        case '3':
            $consultMail = $cookie_values['mail'];
            break;
        default:
            header("Location: ../../index.php");
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Index | Tuzistemas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../vendor/css/index-styles.css?_v=<?php echo rand(1, 15) ?>">
    <link rel="shortcut icon" href="../../vendor/assets/icons/icon.ico" type="image/x-icon">
</head>

<body>
    <script>
        // Espera 2 segundos y luego oculta el mensaje de alerta
        setTimeout(function() {
            var alerta = document.getElementById('alertAccion');
            if (alerta) {
                alerta.style.transition = 'opacity 0.5s';
                alerta.style.opacity = '0';
                setTimeout(function() {
                    alerta.remove();
                }, 500); // Tiempo extra para la transición de desaparición
            }
        }, 2000);
    </script>
    <!--Menu de Navegación-->
    <header>
        <!-- Barra Lateral -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4" id="sidebar">
                    <a href="#" data-section="section1" class="list-group-item list-group-item-action py-2 ripple active" aria-current="true"><i class="fas fa-house fa-fw me-3"></i><span>Inicio</span></a>
                    <a href="#" data-section="section2" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-upload fa-fw me-3"></i><span>Cargar Archivo</span></a>
                    <a href="#" data-section="section3" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-file fa-fw me-3"></i><span>Archivos</span></a>
                    <a href="#" data-section="section4" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-school fa-fw me-3"></i><span>Archivos de Clase</span></a>
                    <a href="#" data-section="section5" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-trash fa-fw me-3"></i><span>Eliminar Archivos</span></a>
                    <a href="#" data-section="section6" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-clock fa-fw me-3"></i><span>Horario</span></a>
                </div>
            </div>
            <p class="text-bold p-4" style="position: absolute; bottom: 0;">Version 1.0 - View Student</p>
        </nav>
        <!-- Barra Lateral -->

        <!-- Navbar -->
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <button data-mdb-button-init class="navbar-toggler" type="button" data-mdb-collapse-init data-mdb-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <a class="navbar-brand px-3">
                    <img src="../../vendor/assets/icons/icon.png" height="25" alt="Tuzistemas Logo" loading="lazy" />
                    Tuzistemas App
                </a>
                <div id="sidebar">
                    <?php
                    require("../../vendor/php/bd_Conection.php");
                    $count;
                    $records = $conn->prepare('SELECT COUNT(*) AS count
                    FROM `notifications`
                    WHERE `n_Receiver` = :typeUser OR `n_Receiver`= 0');
                    $records->bindParam(':typeUser', $cookie_values['role']);
                    $records->execute();
                    $results = $records->fetch(PDO::FETCH_ASSOC);
                    if ($results > 0) {
                        $count = $results['count'];
                    }
                    ?>
                    <a href="#" data-section="section7" class="btn btn-success position-relative">
                        Mensajes
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill btn-danger">
                            <?php
                            echo $count
                            ?>
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </a>
                </div>
                <ul class="navbar-nav ms-auto d-flex flex-row">
                    <form action="../../vendor/php/logout.php">
                        <input type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-sm btn-success" style="margin-top: 0.7rem; padding-left: 2.5rem; padding-right: 2.5rem;" value="Cerrar Sesión">
                    </form>
                    <a data-mdb-dropdown-init class="nav-link hidden-arrow d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <img src="../../vendor/assets/icons/undraw_profile.svg" class="rounded-circle" height="35" alt="Avatar" loading="lazy" />
                    </a>
                </ul>
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <!--Menu Navegacion-->
    <style>
        .section {
            display: none;
        }

        .active-section {
            display: block;
        }

        .table-container {
            padding: 40px;
            background: rgba(255, 255, 255, 0.22);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        .upload-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 30px;
            background: rgba(255, 255, 255, 0.22);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        /* Estilo para el contenedor del perfil */
        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 40px;
            background: rgba(255, 255, 255, 0.22);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        /* Estilo para la imagen de perfil */
        .profile-image {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            /* Forma redonda para la imagen de perfil */
            border: 5px solid #fff;
            /* Borde blanco alrededor de la imagen */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            /* Sombra suave */
        }

        /* Estilo para el nombre de usuario */
        .profile-username {
            font-size: 30px;
            margin-top: 10px;
            color: #000;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        /* Estilo para la descripción del perfil */
        .profile-description {
            font-size: 20px;
            margin-top: 10px;
            color: #000;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
    </style>
    <!--Vista-->
    <main style="margin-top: 58px;">
        <div class="container pt-4" id="content">
            <?php
            if (isset($_GET['status'])) {
                if ($_GET['status'] == 'successDelete') {
                    echo '<div id="alertAccion" class="alert alert-success" role="alert">Archivo eliminado correctamente.</div>';
                } elseif ($_GET['status'] == 'errorDelete') {
                    echo '<div id="alertAccion" class="alert alert-danger" role="alert">Error al eliminar el archivo. Por favor, inténtelo de nuevo.</div>';
                } elseif ($_GET['status'] == 'successUpload') {
                    echo '<div id="alertAccion" class="alert alert-success" role="alert">Archivo enviado correctamente.</div>';
                } elseif ($_GET['status'] == 'errorUpload') {
                    echo '<div id="alertAccion" class="alert alert-danger" role="alert">Error al enviar el archivo. Por favor, inténtelo de nuevo.</div>';
                }
            }
            ?>
            <!-- Seccion 1 Inicio -->
            <section id="section1" class="section container-fluid active-section">

                <?php
                require("../../vendor/php/bd_Conection.php");
                $records = $conn->prepare('SELECT * FROM users WHERE U_mail = :user');
                $records->bindParam(':user', $consultMail);
                $records->execute();
                $results = $records->fetch(PDO::FETCH_ASSOC);
                if ($results > 0) {
                    $userGroupLeader = array(
                        "0" => "Alumno Regular",
                        "1" => "Jefe de Grupo",
                    );
                    $userName = $results['U_name'];
                    $userMail = $results['U_mail'];
                    $userPhone = $results['U_phone'];
                    $userRole = $results['U_role'];
                    $userGroup = $results['U_group'];
                    $userEnrollment = $results['U_enrollment'];
                    $GroupLeader = $userGroupLeader[$results['U_boss']];
                    switch ($userRole) {
                        case '1':
                            $uRole = "Jefe de Carrera";
                            break;
                        case '2':
                            $uRole = "Personal Docente";
                            break;
                        case '3':
                            $uRole = "Alumno Matriculado";
                            break;
                        default:
                            $uRole = "Rol Indefinido";
                            break;
                    }
                }
                ?>

                <div class="profile-container">
                    <img id="perfilImagen" class="profile-image" src="../../vendor/assets/icons/undraw_profile.svg" alt="Avatar">
                    <div class="profile-username"><span style="font-size: 20px; color: #000;">Bienvenido</span>
                        <span id="nombre"><?php echo $userName ?></span>
                    </div>
                    <div class="profile-description">
                        <span id="mail"><?php echo $userMail ?></span>
                        <span id="phone"><?php echo $userPhone ?></span>
                        <span id="role"><?php echo $uRole ?></span>
                        <span id="role"><?php echo $userEnrollment ?></span>
                        <span id="role"><?php echo $userGroup ?></span>
                        <span id="role"><?php echo $GroupLeader ?></span>
                    </div>
                </div>
            </section>
            <!-- Seccion 2 Cargar Archivo -->
            <section id="section2" class="section container-fluid">
                <div class="upload-container">
                    <p class="h1 text-white pt-1 pb-3" style="text-align: center;">Subir Archivos:</p>

                    <form action="uploadFileFunction.php" method="POST" enctype="multipart/form-data" style="width: 26rem;">
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" id="enrollment" name="enrollment" class="form-control" value="<?php echo $userEnrollment ?>" disabled />
                            <label class="form-label fw-bold text-white" for="enrollment">Alumno</label>
                        </div>
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" id="nameFile" name="nameFile" class="form-control" required />
                            <label class="form-label fw-bold text-white" for="nameFile">Nombre del Archivo</label>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold text-white" for="customFile">Elija el archivo:</label>
                            <input type="file" class="form-control" id="customFile" name="File" accept=".jpg, .jpeg, .png, .mp4, .pdf" required />
                        </div>
                        <input type="submit" class="btn btn-success btn-lg mb-2" value="Enviar">
                    </form>

                </div>
            </section>
            <!-- Seccion 3 Mostrar Archivos -->
            <section id="section3" class="section container-fluid">
                <div class="table-container">
                    <p class="h1 text-white pt-4 pb-4" style="text-align: center;">Archivos Enviados:</p>
                    <table class="table align-middle mb-0 bg-transparent">
                        <thead class="bg-transparent text-white">
                            <tr>
                                <th>Alumno</th>
                                <th>Nombre Archivo</th>
                                <th>Tipo</th>
                                <th>Descargar</th>
                                <th>Fecha de Subida</th>
                                <th>Grupo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $conexion = new mysqli("localhost", "root", "", "tuzistemaapp");

                            // Verificar la conexión
                            if ($conexion->connect_error) {
                                die("Error en la conexión: " . $conexion->connect_error);
                            }
                            // Consulta SQL para obtener los datos de la tabla
                            $query = "SELECT * FROM uploaded_files WHERE UP_Enrollment =" . $cookie_values['enrollment'];
                            $resultado = $conexion->query($query);
                            if ($resultado) {
                                // Inicializar un array para almacenar los datos
                                $datos = array();

                                // Recorrer el resultado y almacenar los datos en el array
                                while ($fila = $resultado->fetch_assoc()) {
                                    $datos[] = $fila;
                                }
                                // Cerrar la conexión a la base de datos
                                $conexion->close();
                            } else {
                                echo "Error en la consulta: " . $conexion->error;
                            ?>
                                <tr>
                                    <td>SIN DATOS</td>
                                </tr>
                            <?php
                            }
                            ?>
                            <?php
                            foreach ($datos as $fila) { ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="../../vendor/assets/icons/undraw_profile.svg" alt="Avatar" style="width: 45px; height: 45px" class="rounded-circle" />
                                            <div class="ms-3">
                                                <p class="fw-bold text-white mb-1"><?php echo $userName ?></p>
                                                <p class="text-white mb-0"><?php echo $userMail ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="fw-normal text-white mb-1"><?php echo $fila['UP_nameFile']; ?></p>
                                    </td>
                                    <td>
                                        <p class="fw-normal text-white mb-1"><?php echo $fila['UP_Type']; ?></p>
                                    </td>
                                    <td>
                                        <a href="downloadFileFunction.php?id=<?php echo $fila['UP_Id']; ?>" class="py-2 ripple text-white"><i class="fas fa-download fa-fw me-3"></i></a>
                                    </td>
                                    <td class="text-white"><?php echo $fila['UP_dateFile']; ?></td>
                                    <td class="text-white"><?php echo $fila['UP_group']; ?></td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
            <!-- Seccion 4 Archivos de Clase -->
            <section id="section4" class="section container-fluid">
                <div class="table-container">
                    <p class="h1 text-white pt-4 pb-4" style="text-align: center;">Archivos Grupales Enviados:</p>
                    <table class="table align-middle mb-0 bg-transparent">
                        <thead class="bg-transparent text-white">
                            <tr>
                                <th>Alumno</th>
                                <th>Nombre Archivo</th>
                                <th>Tipo</th>
                                <th>Acciones</th>
                                <th>Fecha de Subida</th>
                                <th>Grupo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $conexion = new mysqli("localhost", "root", "", "tuzistemaapp");

                            // Verificar la conexión
                            if ($conexion->connect_error) {
                                die("Error en la conexión: " . $conexion->connect_error);
                            }
                            // Validar y preparar la entrada
                            $groupClass = isset($cookie_values['groupClass']) ? intval($cookie_values['groupClass']) : 0;
                            $query = "SELECT * FROM uploaded_files WHERE UP_group = $groupClass";
                            $resultado = $conexion->query($query);
                            if ($resultado) {
                                // Inicializar un array para almacenar los datos
                                $datos = array();

                                // Recorrer el resultado y almacenar los datos en el array
                                while ($fila = $resultado->fetch_assoc()) {
                                    $datos[] = $fila;
                                }
                                // Cerrar la conexión a la base de datos
                                $conexion->close();
                            } else {
                                echo "Error en la consulta: " . $conexion->error;
                            ?>
                                <tr>
                                    <td>SIN DATOS</td>
                                </tr>
                            <?php
                            }
                            ?>
                            <?php
                            foreach ($datos as $fila) { ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="../../vendor/assets/icons/undraw_profile.svg" alt="Avatar" style="width: 45px; height: 45px" class="rounded-circle" />
                                            <div class="ms-3">
                                                <?php
                                                $records = $conn->prepare('SELECT * FROM users WHERE U_enrollment = :user');
                                                $records->bindParam(':user', $fila['UP_Enrollment']);
                                                $records->execute();

                                                $results = $records->fetch(PDO::FETCH_ASSOC);
                                                if ($results > 0) {
                                                    $name = $results['U_name'];
                                                    $mail = $results['U_mail'];
                                                } ?>
                                                <p class="fw-bold text-white mb-1"><?php echo $name ?></p>
                                                <p class="text-white mb-0"><?php echo $mail ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="fw-normal text-white mb-1"><?php echo $fila['UP_nameFile']; ?></p>
                                    </td>
                                    <td>
                                        <p class="fw-normal text-white mb-1"><?php echo $fila['UP_Type']; ?></p>
                                    </td>
                                    <td>
                                        <?php
                                        if ($cookie_values['groupLeader'] > 0) {
                                        ?>
                                            <a href="downloadFileFunction.php?id=<?php echo $fila['UP_Id']; ?>" class="py-2 ripple text-white"><i class="fas fa-download fa-fw me-3"></i></a>
                                            <a href="deleteFileFunction.php?id=<?php echo $fila['UP_Id']; ?>" class="py-2 ripple text-white"><i class="fas fa-circle-xmark fa-fw me-3"></i></a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="downloadFileFunction.php?id=<?php echo $fila['UP_Id']; ?>" class="py-2 ripple text-white"><i class="fas fa-download fa-fw me-3"></i></a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td class="text-white"><?php echo $fila['UP_dateFile']; ?></td>
                                    <td class="text-white"><?php echo $fila['UP_group']; ?></td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
            <!-- Seccion 5 Eliminar Archivos -->
            <section id="section5" class="section container-fluid">
                <div class="table-container">
                    <p class="h1 text-white pt-4 pb-4" style="text-align: center;">Archivos Enviados:</p>
                    <table class="table align-middle mb-0 bg-transparent">
                        <thead class="bg-transparent text-white">
                            <tr>
                                <th>Alumno</th>
                                <th>Nombre Archivo</th>
                                <th>Tipo</th>
                                <th>Accion</th>
                                <th>Fecha de Subida</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $conexion = new mysqli("localhost", "root", "", "tuzistemaapp");

                            // Verificar la conexión
                            if ($conexion->connect_error) {
                                die("Error en la conexión: " . $conexion->connect_error);
                            }
                            // Consulta SQL para obtener los datos de la tabla
                            $query = "SELECT * FROM uploaded_files WHERE UP_Enrollment =" . $cookie_values['enrollment'];
                            $resultado = $conexion->query($query);
                            if ($resultado) {
                                // Inicializar un array para almacenar los datos
                                $datos = array();

                                // Recorrer el resultado y almacenar los datos en el array
                                while ($fila = $resultado->fetch_assoc()) {
                                    $datos[] = $fila;
                                }
                                // Cerrar la conexión a la base de datos
                                $conexion->close();
                            } else {
                                echo "Error en la consulta: " . $conexion->error;
                            ?>
                                <tr>
                                    <td>SIN DATOS</td>
                                </tr>
                            <?php
                            }
                            ?>
                            <?php
                            foreach ($datos as $fila) { ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="../../vendor/assets/icons/undraw_profile.svg" alt="Avatar" style="width: 45px; height: 45px" class="rounded-circle" />
                                            <div class="ms-3">
                                                <p class="fw-bold text-white mb-1"><?php echo $userName ?></p>
                                                <p class="text-white mb-0"><?php echo $userMail ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="fw-normal text-white mb-1"><?php echo $fila['UP_nameFile']; ?></p>
                                    </td>
                                    <td>
                                        <p class="fw-normal text-white mb-1"><?php echo $fila['UP_Type']; ?></p>
                                    </td>
                                    <td>
                                        <?php
                                        if ($cookie_values['groupLeader'] > 0) {
                                        ?>
                                            <a href="deleteFileFunction.php?id=<?php echo $fila['UP_Id']; ?>" class="py-2 ripple text-white"><i class="fas fa-circle-xmark fa-fw me-3"></i></a>
                                        <?php
                                        } else {
                                        ?>
                                            <a class="py-2 ripple text-white"><i class="fas fa-circle-xmark fa-fw me-3"></i>Sin permisos</a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td class="text-white"><?php echo $fila['UP_dateFile']; ?></td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
            <!-- Seccion 6 Descargar Horarios -->
            <section id="section6" class="section container-fluid">
                <?php
                $conexion = new mysqli("localhost", "root", "", "tuzistemaapp");
                // Verificar la conexión
                if ($conexion->connect_error) {
                    die("Error en la conexión: " . $conexion->connect_error);
                }
                // Consulta SQL para obtener los datos de la tabla
                $query = "SELECT S_Group FROM schedule";
                $resultado = $conexion->query($query);
                if ($resultado) {
                    // Inicializar un array para almacenar los datos
                    $groupS = array();
                    // Recorrer el resultado y almacenar los datos en el array
                    while ($fila = $resultado->fetch_assoc()) {
                        $groupS[] = $fila;
                    }
                }
                ?>
                <div class="upload-container">
                    <p class="h1 text-white pt-1 pb-3" style="text-align: center;">Busca y Descarga tu Horario:</p>
                    <form action="downloadScheduleFunction.php" method="POST" enctype="multipart/form-data" style="width: 22rem;">
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" id="uGroup" class="form-control" value="<?php echo $cookie_values['groupClass'] ?>" disabled />
                            <label class="form-label" for="uGroup">Tu grupo</label>
                        </div>
                        <div data-mdb-input-init class="form-outline mb-4">
                            <select class="form-select" aria-label="Default select example" name="group">
                                <option selected>Seleccione grupo</option>
                                <?php
                                foreach ($groupS as $fila) {
                                ?>
                                    <option value="<?php echo $fila['S_Group']; ?>"><?php echo $fila['S_Group']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-success btn-lg mb-2" value="Descargar">
                    </form>
                </div>
            </section>
            <section id="section7" class="section container-fluid">
                <?php
                $conexion = new mysqli("localhost", "root", "", "tuzistemaapp");
                if ($conexion->connect_error) {
                    die("Error en la conexión: " . $conexion->connect_error);
                }
                $query = "SELECT n.*, 
                    CONCAT(u.U_name) AS sender_full_name
                    FROM notifications n
                    LEFT JOIN 
                    users u ON n.n_Sender = u.U_enrollment
                    WHERE `n_Receiver` =" . $cookie_values['role'] . " OR `n_Receiver`= 0";
                $resultado = $conexion->query($query);
                if ($resultado) {
                    $datos = array();
                    while ($fila = $resultado->fetch_assoc()) {
                        $datos[] = $fila;
                        echo "<div class='card text-center mb-3'>" .
                            "<div class='card-header alert-success'>Enviado por: " . $fila['sender_full_name'] . "</div>" .
                            "<div class='card-body'>" .
                            "<h5 class='card-title'>" . $fila['n_Subject'] . "</h5>" .
                            "<p class='card-text'>" . $fila['n_Message'] . ".</p>" .
                            "</div>" .
                            "<div class='card-footer text-muted alert-success'>Enviado: " . $fila['n_Date'] . "</div>" .
                            "</div>";
                    }
                    $conexion->close();
                } else {
                    echo "Error en la consulta: " . $conexion->error;
                }
                ?>

            </section>
        </div>
    </main>
    <!--Vista-->
    <script src="../../vendor/js/viewSections.js?_v=<?php echo rand(1, 15) ?>"></script>
</body>

</html>