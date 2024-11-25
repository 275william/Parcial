<?php
require_once("../config/conexion.php");
require_once("../models/Menu.php");
$menu = new Menu();

switch ($_GET["op"]) {
    case "listar":
        $datos = $menu->get_menu();
        echo json_encode($datos ?: []);
        break;

    case "crear":
        echo $menu->insert_menu($_POST["opcion"], $_POST["url"]) ? 'success' : 'error';
        break;

    case "actualizar":
        echo $menu->update_menu($_POST["id"], $_POST["opcion"], $_POST["url"]) ? 'success' : 'error';
        break;

    case "mostrar":
        $datos = $menu->get_menu_by_id($_POST["id"]);
        echo json_encode($datos ?: []);
        break;

    case "eliminar":
        echo $menu->delete_menu($_POST["id"]) ? 'success' : 'error';
        break;
}
?>
