<?php
require_once("../config/conexion.php");
require_once("../models/Vacaciones.php");

$vacaciones = new Vacaciones();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {
    case "GetAll":
        $datos = $vacaciones->get_vacaciones();
        echo json_encode($datos);
        break;

    case "GetId":
        $datos = $vacaciones->get_vacacion_id($body["VacacionesID"]);
        echo json_encode($datos);
        break;

    case "Insert":
        $datos = $vacaciones->insert_vacacion($body["TrabajadorID"], $body["FechaInicio"], $body["FechaFin"]);
        echo json_encode($datos);
        break;

    case "Update":
        $datos = $vacaciones->update_vacacion($body["VacacionesID"], $body["TrabajadorID"], $body["FechaInicio"], $body["FechaFin"]);
        echo json_encode($datos);
        break;

    case "Delete":
        $datos = $vacaciones->delete_vacacion($body["VacacionesID"]);
        echo json_encode($datos);
        break;
}
?>
