<?php
require_once("../config/conexion.php");
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (isset($_POST["enviar"]) && $_POST["enviar"] == "si") {
  require_once("../models/Usuario.php");
  $usuario = new Usuario();
  $correo = $_POST["correo"];
  $passwd = $_POST["passwd"];

  if (!empty($correo) && !empty($passwd)) {
      $usuario->cambiarClaveUsuario($correo, $passwd); // Ya maneja los mensajes
      header("Location: cambiar_clave.php");
  } else {
      $_SESSION['mensaje'] = ['tipo' => 'warning', 'texto' => 'Todos los campos son obligatorios.'];
      header("Location: cambiar_clave.php");
  }
  exit; // Detener ejecución después del redireccionamiento
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Restablecer Contraseña</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
  
    <div class="card">
      <div class="card-body login-card-body">

        <form action="cambiar_clave.php" method="post">
          <div class="input-group mb-3">
            <input type="email" name="correo" class="form-control" placeholder="Correo electrónico" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="passwd" class="form-control" placeholder="Nueva contraseña" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <input type="hidden" name="enviar" value="si">
              <button type="submit" class="btn btn-primary btn-block">Restablecer</button>
            </div>
          </div>
        </form>

        <!-- Alertas de mensaje -->
        <?php
        if (isset($_SESSION['mensaje'])) {
          $mensaje = $_SESSION['mensaje'];
          echo '<div class="alert alert-' . htmlspecialchars($mensaje['tipo']) . ' mt-3" role="alert">' . htmlspecialchars($mensaje['texto']) . '</div>';
          if ($mensaje['tipo'] === 'success') {
            echo '<a href="/PaginaWiliam/views/login.php" class="btn btn-primary btn-block">Iniciar Sesión</a>';
          }
          unset($_SESSION['mensaje']); // Limpiar mensaje después de mostrarlo
        }
        ?>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3/dist/js/adminlte.min.js"></script>
</body>

</html>
