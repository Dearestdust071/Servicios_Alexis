<?php
require_once("../config/conexion.php");
require_once("../models/Bancos.php");

$banco = new Bancos();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {
    case "GetAll":
        $datos = $banco->get_bancos();
        echo json_encode($datos);
        break;

    case "GetId":
        $datos = $banco->get_banco_id($body["BancoID"]);
        echo json_encode($datos);
        break;

    case "Insert":
        $datos = $banco->insert_banco($body["Nombre"], $body["statuss"]);
        echo json_encode($datos);
        break;

    case "Update":
        $datos = $banco->update_banco($body["BancoID"], $body["Nombre"], $body["statuss"]);
        echo json_encode($datos);
        break;

    case "Delete":
        $datos = $banco->delete_banco($body["BancoID"]);
        echo json_encode($datos);
        break;
}
?>
