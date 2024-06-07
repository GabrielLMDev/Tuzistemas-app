<?php
if (!isset($_COOKIE['user'])) {
} else {
  $cookie_value = $_COOKIE['user']; //obtener cookie.
  $cookie_values = json_decode($cookie_value, true); //obtener los valores de la cookie.
  switch ($cookie_values['role']) {
    case '1':
      header("Location: views/viewJefe/home.php");
      break;
    case '2':
      header("Location: views/viewDocente/home.php");
      break;
    case '3':
      header("Location: views/viewAlumno/home.php");
      break;
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | Tuzistemas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="vendor/css/login-styles.css">
  <link rel="shortcut icon" href="vendor/assets/icons/icon.ico" type="image/x-icon">
</head>

<body>
  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="vendor/assets/backgrounds/li.gif" class="img-fluid" alt="wellcome">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 bg-white p-5">
          <form action="vendor/php/User_Login.php" method="POST">
            <div class="d-flex flex-row align-items-center justify-content-center">
              <p class="lead fw-normal mb-0 me-3">Iniciar Sesión con </p>
              <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-floating mx-1">
                <i class="fab fa-facebook-f"></i>
              </button>

              <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-floating mx-1">
                <i class="fab fa-google"></i>
              </button>
            </div>

            <div class="divider d-flex align-items-center my-4">
              <p class="text-center fw-bold mx-3 mb-0">O con un usuario</p>
            </div>

            <!-- Input del Correo -->
            <div data-mdb-input-init class="form-outline mb-4">
              <input type="email" id="inputMail" name="mail" class="form-control form-control-lg" placeholder="Ingresa tu correo" required />
              <label class="form-label" for="inputMail">Correo Registrado</label>
            </div>
            <!-- Input de la Contraseña -->
            <div data-mdb-input-init class="form-outline mb-3">
              <input type="password" id="inputPassword" name="password" class="form-control form-control-lg" placeholder="Ingresa tu contraseña" required />
              <label class="form-label" for="inputPassword">Contraseña</label>
            </div>

            <div class="d-flex justify-content-between align-items-center">
              <div class="form-check mb-0">
                <input class="form-check-input me-2" type="checkbox" value="" id="showPassword" />
                <label class="form-check-label" for="showPassword">
                  Mostrar Contraseña
                </label>
              </div>
              <a href="#!" class="text-body">¿Olvidaste tu contraseña?</a>
            </div>
            <div class="text-center mt-4 pt-2">
              <input type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;" value="Iniciar Sesión">
            </div>

          </form>
        </div>
      </div>
    </div>

    <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-success">
      <!-- Copyright -->
      <div class="text-white mb-3 mb-md-0">
        Copyright ©Tuzistemas 2024. Todos los Derechos Reservados.
      </div>
    </div>
  </section>
  <script>
    document.getElementById('showPassword').addEventListener('change', function() {
      var passwordInput = document.getElementById('inputPassword');
      if (this.checked) {
        passwordInput.type = 'text';
      } else {
        passwordInput.type = 'password';
      }
    });
  </script>X
</body>

</html>