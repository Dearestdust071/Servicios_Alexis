<?php
require_once("../config/conexion.php");
require_once("../models/Areas.php");

$areas = new Areas();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {
    case "GetAll":
        $datos = $areas->get_areas();
        echo json_encode($datos);
        break;

    case "GetId":
        $datos = $areas->get_area_id($body["AreaID"]);
        echo json_encode($datos);
        break;

    case "Insert":
        $datos = $areas->insert_area($body["NombreArea"], $body["EncargadoID"], $body["statuss"]);
        echo json_encode($datos);
        break;

    case "Update":
        $datos = $areas->update_area($body["AreaID"], $body["NombreArea"], $body["EncargadoID"], $body["statuss"]);
        echo json_encode($datos);
        break;

    case "Delete":
        $datos = $areas->delete_area($body["AreaID"]);
        echo json_encode($datos);
        break;
}
?>
