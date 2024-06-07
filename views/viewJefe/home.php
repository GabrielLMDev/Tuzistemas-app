<?php
if (!isset($_COOKIE['user'])) {
    header("Location: ../../index.php");
    exit();
} else {
    $cookie_value = $_COOKIE['user']; //obtener cookie.
    $cookie_values = json_decode($cookie_value, true); //obtener los valores de la cookie.
    switch ($cookie_values['role']) {
        case '1':
            $consultMail = $cookie_values['mail'];
            break;
        case '2':
            header("Location: ../../views/viewDocente/home.php");
            break;
        case '3':
            header("Location: ../../views/viewAlumno/home.php");
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
    <link rel="stylesheet" href="../../vendor/css/index-styles.css">
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
                    <a href="#" data-section="section2" class="list-group-item list-group-item-action py-2 ripple"><i class="fa fa-user-tie fa-fw me-3"></i><span>Asignar Grupo</span></a>
                    <a href="#" data-section="section3" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-envelope fa-fw me-3"></i><span>Crear Anuncio</span></a>
                    <a href="#" data-section="section4" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-users fa-fw me-3"></i><span>Mostrar Grupo</span></a>
                    <a href="#" data-section="section5" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-user-check fa-fw me-3"></i><span>Buscar Alumno</span></a>
                    <a href="#" data-section="section6" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-magnifying-glass fa-fw me-3"></i><span>Buscar Docente</span></a>
                </div>
            </div>
            <p class="text-bold p-4" style="position: absolute; bottom: 0;">Version 1.0 - View Boss</p>
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
                <ul class="navbar-nav ms-auto d-flex flex-row">
                    <form action="../../vendor/php/logout.php">
                        <input type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-sm btn-success" style="margin-top: 0.7rem; padding-left: 2.5rem; padding-right: 2.5rem;" value="Cerrar Sesión">
                    </form>
                    <a data-mdb-dropdown-init class="nav-link hidden-arrow d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <img src="../../vendor/assets/icons/boss.svg" class="rounded-circle" height="35" alt="Avatar" loading="lazy" />
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
                if ($_GET['status'] == 'DS') {
                    echo '<div id="alertAccion" class="alert alert-success" role="alert">' . $_GET["ms"] . '</div>';
                } elseif ($_GET['status'] == 'DE') {
                    echo '<div id="alertAccion" class="alert alert-danger" role="alert">' . $_GET["ms"] . '</div>';
                } elseif ($_GET['status'] == 'DD') {
                    echo '<div id="alertAccion" class="alert alert-success" role="alert">' . $_GET["ms"] . '</div>';
                } elseif ($_GET['status'] == 'DDE') {
                    echo '<div id="alertAccion" class="alert alert-danger" role="alert">' . $_GET["ms"] . '</div>';
                } elseif ($_GET['status'] == 'MSS') {
                    echo '<div id="alertAccion" class="alert alert-success" role="alert">' . $_GET["ms"] . '</div>';
                } elseif ($_GET['status'] == 'MSE') {
                    echo '<div id="alertAccion" class="alert alert-danger" role="alert">' . $_GET["ms"] . '</div>';
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
                    <img id="perfilImagen" class="profile-image" src="../../vendor/assets/icons/boss.svg" alt="Avatar" style="background-color: #fff;">
                    <div class="profile-username"><span style="font-size: 20px; color: #000;">Bienvenido, Jefe</span>
                        <span id="nombre"><?php echo $userName ?></span>
                    </div>
                    <div class="profile-description">
                        <span id="mail"><?php echo $userMail ?></span>
                        <span id="phone"><?php echo $userPhone ?></span>
                        <span id="role"><?php echo $uRole ?></span>
                        <span id="role"><?php echo $userEnrollment ?></span>
                    </div>
                </div>
            </section>
            <!-- Seccion 2 Inicio -->
            <section id="section2" class="section container-fluid">
                <div class="upload-container">
                    <?php
                    $conexion = new mysqli("localhost", "root", "", "tuzistemaapp");
                    // Verificar la conexión
                    if ($conexion->connect_error) {
                        die("Error en la conexión: " . $conexion->connect_error);
                    }
                    // Consulta SQL para obtener los datos de la tabla
                    $query = "SELECT U_name, U_enrollment FROM users WHERE U_role = 2";
                    $resultado = $conexion->query($query);
                    if ($resultado) {
                        // Inicializar un array para almacenar los datos
                        $teachers = array();
                        // Recorrer el resultado y almacenar los datos en el array
                        while ($fila = $resultado->fetch_assoc()) {
                            $teachers[] = $fila;
                        }
                    }

                    $query = "SELECT DISTINCT U_group
                    FROM users
                    WHERE U_group IS NOT NULL
                    AND U_group <> 'Sin Grupo'
                    ORDER BY U_group ASC";
                    $resultado = $conexion->query($query);
                    if ($resultado) {
                        // Inicializar un array para almacenar los datos
                        $groups = array();
                        // Recorrer el resultado y almacenar los datos en el array
                        while ($fila = $resultado->fetch_assoc()) {
                            $groups[] = $fila;
                        }
                    }
                    $conexion->close();
                    ?>
                    <p class="h1 text-white pt-1 pb-3" style="text-align: center;">Asignar Grupos:</p>
                    <form action="uploadTeacherGroup.php" method="POST" enctype="multipart/form-data" style="width: 22rem;">
                        <div data-mdb-input-init class="form-outline mb-4">
                            <select name="teacherSelect" class="form-select" required>
                                <option value="" selected>Seleccione Docente</option>
                                <?php
                                foreach ($teachers as $fila) {
                                ?>
                                    <option value="<?php echo $fila['U_enrollment']; ?>"><?php echo $fila['U_enrollment'] . " - " . $fila['U_name']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <select name="groupSelect" class="form-select" required>
                                <option value="" selected>Seleccione grupo</option>
                                <?php
                                foreach ($groups as $fila) {
                                ?>
                                    <option value="<?php echo $fila['U_group']; ?>"><?php echo $fila['U_group']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-success btn-lg mb-2" value="Asignar Grupo">
                    </form>
                    <p class="h3 text-white pt-3 pb-1" style="text-align: center;">Grupo - Docentes Actual:</p>
                    <table class="table align-middle mb-0 bg-transparent">
                        <thead class="bg-transparent text-white">
                            <tr>
                                <th>Grupo</th>
                                <th>Docentes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <a href="http://" target="_blank" rel="noopener noreferrer"></a>
                            <?php
                            $conexion = new mysqli("localhost", "root", "", "tuzistemaapp");
                            /*$sql = "SELECT t.id, t.gT_group, GROUP_CONCAT(CONCAT(t.gT_enrollment, ' - ', u.U_name) ORDER BY t.gT_enrollment ASC SEPARATOR '<br>') AS profesores 
                            FROM group_teacher t 
                            JOIN users u ON t.gT_enrollment = u.U_enrollment 
                            WHERE t.gT_group IS NOT NULL AND t.gT_group <> 'Sin Grupo' 
                            GROUP BY t.gT_group 
                            ORDER BY t.gT_group ASC";*/
                            $sql = "SELECT t.gT_group, 
                            GROUP_CONCAT(t.id ORDER BY t.id ASC SEPARATOR '<br>') AS id, 
                            GROUP_CONCAT(CONCAT('<a href=\"detail.php?id=', t.id, '\" class=\"py-2 ripple text-white\"><i class=\"fas fa-circle-xmark fa-fw me-3\"></i>', t.gT_enrollment, ' - ', u.U_name, '</a>') ORDER BY t.gT_enrollment ASC SEPARATOR '<br>') AS profesores
                            FROM group_teacher t 
                            JOIN users u ON t.gT_enrollment = u.U_enrollment 
                            WHERE t.gT_group IS NOT NULL AND t.gT_group <> 'Sin Grupo' 
                            GROUP BY t.gT_group
                            ";
                            $result = $conexion->query($sql);
                            // Verificar si hay resultados
                            if ($result->num_rows > 0) {
                                // Mostrar resultados en la tabla
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr><td class='fw-normal text-white mb-1'>" . $row["gT_group"] . "</td>" .
                                        "<td class='fw-normal text-white mb-1'>" .
                                        $row["profesores"] .
                                        "</td>" .
                                        "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='2' class='fw-normal text-white mb-1'>No se encontraron resultados</td></tr>";
                            }

                            // Cerrar conexión
                            $conexion->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
            <!-- Seccion 3 Inicio -->
            <section id="section3" class="section container-fluid">
                <div class="container mt-3">
                    <form action="setMessage.php" method="POST" enctype="multipart/form-data">
                        <label for="receiver" class="h4"> Enviar a: </label>
                        <select class="form-select" aria-label="Default select example" id="receiver" name="receiver" required>
                            <option value="" selected>Seleccione</option>
                            <option value="0">Todos</option>
                            <option value="2">Docentes</option>
                            <option value="3">Alumnos</option>
                        </select>
                        <div class="my-2">
                            <label for="subject" class="h4"> Asunto: </label>
                            <input type="text" class="form-control" id="subject" placeholder="Ingrese el asunto" name="subject" required>
                        </div>
                        <div class="my-2">
                            <label for="message" class="h4"> Mensaje: </label>
                            <textarea class="form-control" rows="3" id="message" name="message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success"> Enviar Mensaje </button>
                    </form>
            </section>
            <!-- Seccion 4 Inicio -->
            <section id="section4" class="section container-fluid">
                <div class="upload-container">
                    <p class="h1 text-white pt-1 pb-3" style="text-align: center;">Mostrar Grupo:</p>
                    <form id="search_group_form" style="width: 22rem;">
                        <div data-mdb-input-init class="form-outline mb-4">
                            <select name="groupSelection" id="groupSelection" class="form-select" required>
                                <option value="" selected>Seleccione grupo</option>
                                <?php
                                foreach ($groups as $fila) {
                                ?>
                                    <option value="<?php echo $fila['U_group']; ?>"><?php echo $fila['U_group']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-success btn-lg mb-2" value="Mostrar Alumnos">
                    </form>

                    <style>
                        .hidden {
                            display: none;
                        }
                    </style>

                    <table id="docentesTable" class="hidden table align-middle bg-transparent">
                        <thead class="bg-transparent text-white">
                            <tr>
                                <th>Docentes</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <table id="usuariosTable" class="hidden table align-middle mb-1 bg-transparent">
                        <thead class="bg-transparent text-white">
                            <tr>
                                <th>Nombre</th>
                                <th>Correo Electronico</th>
                                <th>Telefono</th>
                                <th>Matricula</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </section>
            <!-- Seccion 5 Inicio -->
            <section id="section5" class="section container-fluid">
                <div id="buscar_Alumno" style="display: flex; justify-content: center; align-items: center; text-align: center; margin-top: 1.5rem;">
                    <div class="upload-container" style="width: 100%;">
                        <form id="search_student_form">
                            <div class="h5 mb-0 font-weight-bold text-gray-800" style="width: 45vw">
                                <label for="inputNameS" class="h5 text-white text-uppercase" style="margin-bottom: 20px">Buscar Alumno</label>
                                <input type="text" name="inputNameS" id="inputNameS" class="form-control" style="text-align: center" onkeyup="searchStudent()" required />
                                <input type="hidden" id="studentId" name="studentId" class="form-control" />
                                <select id="resultS" onchange="selectionStudent()" style="margin-bottom: 20px; text-align: center; width: 100%" class="form-control"></select>
                            </div>
                        </form>

                        <div class="container d-flex" id="dataStudent" style="text-align:left">
                            <div class="card text-center" style="width: 50%;">
                                <div class="card-header">Datos Publicos</div>
                                <div class="card-body">
                                    <p class="h5">Nombre:</p>
                                    <p class="lead card-text ps-lg-2"><span id="nameS"></span></p>
                                    <p class="h5">Matricula:</p>
                                    <p class="lead ps-lg-2"><span id="enrollmentS"></span></p>
                                    <p class="h5">Grupo:</p>
                                    <p class="lead ps-lg-2"><span id="groupS"></span></p>
                                </div>
                            </div>
                            <div class="card text-center" style="width: 50%;">
                                <div class="card-header">Contacto</div>
                                <div class="card-body">
                                    <p class="h5">Telefono:</p>
                                    <p class="lead ps-lg-2"><span id="phoneS"></span></p>
                                    <p class="h5">Correo:</p>
                                    <p class="lead ps-lg-2"><span id="mailS"></span></p>
                                </div>
                            </div>
                            <div class="card text-center" style="width: 50%;">
                                <div class="card-header">Docentes Asignados</div>
                                <div class="card-body">
                                    <p class="lead ps-lg-2"><span id="teacherS"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Seccion 6 Inicio -->
            <section id="section6" class="section container-fluid">
                <div id="buscar_contrato" style="display: flex; justify-content: center; align-items: center; text-align: center; margin-top: 1.5rem;">
                    <div class="upload-container" style="width: 100%;">
                        <form id="search_teacher_form">
                            <div class="h5 mb-0 font-weight-bold text-gray-800" style="width: 45vw">
                                <label for="inputName" class="h5 text-white text-uppercase" style="margin-bottom: 20px">Buscar Maestro</label>
                                <input type="text" name="inputName" id="inputName" class="form-control" style="text-align: center" onkeyup="searchTeacher()" required />
                                <input type="hidden" id="teacherId" name="teacherId" class="form-control" />
                                <select id="result" onchange="selectionTeacher()" style="margin-bottom: 20px; text-align: center; width: 100%" class="form-control"></select>
                            </div>
                        </form>

                        <div class="container d-flex" id="dataTeacher" style="text-align:left">
                            <div class="card text-center" style="width: 50%;">
                                <div class="card-header">Datos Publicos</div>
                                <div class="card-body">
                                    <p class="h5">Nombre:</p>
                                    <p class="lead card-text ps-lg-2"><span id="nameT"></span></p>
                                    <p class="h5">Matricula:</p>
                                    <p class="lead ps-lg-2"><span id="enrollmentT"></span></p>
                                </div>
                            </div>
                            <div class="card text-center" style="width: 50%;">
                                <div class="card-header">Contacto</div>
                                <div class="card-body">
                                    <p class="h5">Telefono:</p>
                                    <p class="lead ps-lg-2"><span id="phoneT"></span></p>
                                    <p class="h5">Correo:</p>
                                    <p class="lead ps-lg-2"><span id="mailT"></span></p>
                                </div>
                            </div>
                            <div class="card text-center" style="width: 50%;">
                                <div class="card-header">Grupos Designados</div>
                                <div class="card-body" id="listGroup">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!--Vista-->
    <script src="../../vendor/js/viewSections.js?_v=<?php echo rand(1, 15) ?>"></script>
    <script src="../../vendor/js/groupListFunctionBoss.js?_v=<?php echo rand(1, 15) ?>"></script>
    <script src="../../vendor/js/searchTeacher.js?_v=<?php echo rand(1, 15) ?>"></script>
    <script src="../../vendor/js/searchStudent.js?_v=<?php echo rand(1, 15) ?>"></script>
</body>

</html>