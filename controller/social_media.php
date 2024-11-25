<?php
    require_once("../config/conexion.php");
    require_once("../models/SocialMedia.php");
    $social_media = new SocialMedia();

    switch($_GET["op"]){
        case "actualizar":
            if (isset($_POST["socmed_id"]) && isset($_POST["socmed_icono"]) && isset($_POST["socmed_url"])) {
                $result = $social_media->update_socialMedia($_POST["socmed_id"], $_POST["socmed_icono"], $_POST["socmed_url"]);
                echo $result ? 'success' : 'error';
            } else {
                echo 'error';
            }
            break;
        
        case "crear":
            if (isset($_POST["socmed_icono"]) && isset($_POST["socmed_url"])) {
                $result = $social_media->insert_socialMedia($_POST["socmed_icono"], $_POST["socmed_url"]);
                echo $result ? 'success' : 'error';
            } else {
                echo 'error';
            }
            break;
        

            
        case "mostrar":
            if (isset($_POST["socmed_id"])) {
                $datos = $social_media->get_socialMediaxid($_POST["socmed_id"]);
                
                if (is_array($datos) && !empty($datos)) {
                    $output = array(
                        "socmed_icono" => $datos["socmed_icono"],
                        "socmed_url" => $datos["socmed_url"],
                        "est" => $datos["est"]
                    );
                    echo json_encode($output);
                } else {
                    echo json_encode(array("error" => "No se encontraron datos."));
                }
            } else {
                echo json_encode(array("error" => "ID inválido."));
            }
            break;

        case "listar":
            $datos=$social_media->get_socialMedia();
            if ($datos) {
                header('Content-Type: application/json');

                echo json_encode($datos);
            } else {
                echo json_encode([]);
            }
            break;


        case "eliminar":
           $resultado = $social_media->delete_socialMedia($_POST['id']);
        
            if ($resultado == 'success') {
                echo 'success';
            } else {
                echo 'error';
            }

            break;
            

        
    }
?>