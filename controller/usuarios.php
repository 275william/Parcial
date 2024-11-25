<?php
require_once("../config/conexion.php");
require_once("../models/Usuario.php");

$usuario = new Usuario();

$op = $_GET['op'];

switch ($op) {
    case "listar":
        $datos = $usuario->get_usuarios();
        echo json_encode($datos);
        break;

    case "crear":
        echo $usuario->insert_usuario($_POST["nombre"], $_POST["apep"], $_POST["apem"], $_POST["correo"], $_POST["telf"], $_POST["pass"], $_POST["estado"]) ? 'success' : 'error';
        break;

    case "mostrar":
        $datos = $usuario->get_usuario_by_id($_POST["id"]);
        echo json_encode($datos);
        break;

    case "actualizar":
        echo $usuario->update_usuario($_POST["id"], $_POST["nombre"], $_POST["apep"], $_POST["apem"], $_POST["correo"], $_POST["telf"], $_POST["pass"], $_POST["estado"]) ? 'success' : 'error';
        break;

    case "eliminar":
        echo $usuario->delete_usuario($_POST["id"]) ? 'success' : 'error';
        break;
}
?>
