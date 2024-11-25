<?php

// Define la URL base de tu proyecto
if (!defined("BASE_URL")) {
  define("BASE_URL", "/PaginaWiliam/views/");
}

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
  <title>Menú</title>

  <?php require_once("modulos/css.php"); ?>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php require_once("modulos/header.php"); ?>
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
        <?php require_once("modulos/menu.php"); ?>

    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Administración de Menú</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Menú</li>
              </ol>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Listado de Opciones del Menú</h3>
              <button class="btn btn-success btn-sm float-right" onclick="mostrarModalCrear()">
                <i class="fas fa-plus"></i> Agregar Opción
              </button>
            </div>
            <div class="card-body">
              <table id="tablaMenu" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Opción</th>
                    <th>URL</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </section>

      <!-- Modal -->
      <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalAddLabel">Agregar Opción</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form>
              <input type="hidden" id="menu_id">
              <div class="modal-body">
                <div class="form-group">
                  <label for="menu_opcion">Opción</label>
                  <input type="text" id="menu_opcion" class="form-control" placeholder="Opción del Menú">
                </div>
                <div class="form-group">
                  <label for="menu_url">URL</label>
                  <input type="url" id="menu_url" class="form-control" placeholder="https://...">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" onclick="guardarMenu()">Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php require_once("modulos/footer.php"); ?>
  </div>

  <?php require_once("modulos/js.php"); ?>
  <script src="../views/js/menu.js"></script>
</body>

</html>
