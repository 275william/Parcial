<?php
  require_once("../config/conexion.php");
  if(isset($_POST["enviar"]) and $_POST["enviar"] == "ok"){
    require_once("../models/Usuario.php");
    $usuario = new usuario();
    $usuario->login();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <?php require_once("modulos/css.php"); ?> 
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in para iniciar tu sesion</p>

      <form method="post">
        <?php
          if(isset($_GET["m"])){
              switch($_GET["m"]){
                case "1":
        ?>            
                  <div class="alert text-danger" role="alert">
                    Los datos del formulario son incorrectos
                    </div>
        <?php     break;
                
                case "2":
                  ?>
                  <div class="alert text-warning" role="alert">
                    El formulario esta vacio!
                    </div>
        <?php            
                  break;
              }
          }
        ?>
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Recuerdame
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <input type="hidden" name="enviar" value="ok">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="/PaginaWiliam/views/cambiar_clave.php">Olvide la Contraseña</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Registrar usuario nuevo</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<?php require_once("modulos/js.php"); ?>  
</html>
