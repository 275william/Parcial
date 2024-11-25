<?php
require_once("../config/conexion.php");
require_once("../models/Experiencia.php");
$experiencia = new Experiencia();

switch ($_GET["op"]) {
    case "listar":
        $datos = $experiencia->get_experiencia();
        echo json_encode($datos ?: []);
        break;

    case "crear":
        echo $experiencia->insert_experiencia($_POST["empresa"], $_POST["puesto"], $_POST["fecha_inicio"], $_POST["fecha_fin"], $_POST["descripcion"]) ? 'success' : 'error';
        break;

    case "mostrar":
        $datos = $experiencia->get_experiencia_by_id($_POST["id"]);
        echo json_encode($datos);
        break;

    case "actualizar":
        echo $experiencia->update_experiencia($_POST["id"], $_POST["empresa"], $_POST["puesto"], $_POST["fecha_inicio"], $_POST["fecha_fin"], $_POST["descripcion"]) ? 'success' : 'error';
        break;

    case "eliminar":
        echo $experiencia->delete_experiencia($_POST["id"]) ? 'success' : 'error';
        break;
}
?>
