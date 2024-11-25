<?php

// Define la URL base de tu proyecto
define("BASE_URL", "/PaginaWiliam/views/");

// Llama al archivo de conexión
require_once("../config/conexion.php");

// Inicia la sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Verifica si el usuario está logueado
if (!isset($_SESSION["usu_id"])) {
  // Si no está logueado, redirige a 404.php
  header("Location: " . Conectar::ruta() . "views/404.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Redes Sociales</title>

  <?php require_once("modulos/css.php"); ?>


</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <?php require_once("modulos/header.php"); ?>

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../../index3.html" class="brand-link">
        <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->


        <!-- Sidebar Menu -->
        <?php require_once("modulos/menu.php"); ?>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Home</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Administracion</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <div class="container-fluid">
          <!-- Tabla -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Listado de Redes Sociales</h3>
              <button class="btn btn-success btn-sm float-right" onclick="mostrarModalCrear()">
                <i class="fas fa-plus"></i> Agregar Red Social
              </button>
            </div>
            <div class="card-body">
              <table id="tablaRedesSociales" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10%;">ID</th>
                    <th style="width: 20%;">Ícono</th>
                    <th style="width: 35%;">URL</th>
                    <th style="width: 20%;">Estado</th>
                    <th style="width: 15%;">Acciones</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>


      </section>

      <!-- Modal para agregar red social -->
      <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalAddLabel">Agregar Red Social</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form>
              <input type="hidden" id="socmed_id">
              <div class="modal-body">
                <div class="form-group">
                  <label for="socmed_icono">Ícono</label>
                  <input type="text" id="socmed_icono" class="form-control" placeholder="fab fa-facebook">
                </div>
                <div class="form-group">
                  <label for="socmed_url">URL</label>
                  <input type="url" id="socmed_url" class="form-control" placeholder="https://...">
                </div>
                <div class="form-group">
                  <label for="est">Estado</label>
                  <select id="est" class="form-control">
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" onclick="guardarSocialMedia()">Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>

    <?php require_once("modulos/footer.php"); ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->


  <?php require_once("modulos/js.php"); ?>
  <script src="../views/js/socialMedia.js"></script>


</body>

</html>