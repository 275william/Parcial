<?php
require_once("../config/conexion.php");
require_once("../models/Estudios.php");
$estudios = new Estudios();

switch ($_GET["op"]) {
    case "listar":
        $datos = $estudios->get_estudios();
        echo json_encode($datos ?: []);
        break;

    case "crear":
        echo $estudios->insert_estudio($_POST["titulo"], $_POST["institucion"], $_POST["fecha_inicio"], $_POST["fecha_fin"], $_POST["descripcion"]) ? 'success' : 'error';
        break;

    case "mostrar":
        $datos = $estudios->get_estudio_by_id($_POST["id"]);
        echo json_encode($datos);
        break;

    case "actualizar":
        echo $estudios->update_estudio($_POST["id"], $_POST["titulo"], $_POST["institucion"], $_POST["fecha_inicio"], $_POST["fecha_fin"], $_POST["descripcion"]) ? 'success' : 'error';
        break;

    case "eliminar":
        echo $estudios->delete_estudio($_POST["id"]) ? 'success' : 'error';
        break;
}
?>
