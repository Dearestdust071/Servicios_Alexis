<?php
require_once("../config/conexion.php");
require_once("../models/Usuarios.php");

$usuarios = new Usuarios();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {
    case "GetAll":
        $datos = $usuarios->get_usuarios();
        echo json_encode($datos);
        break;

    case "GetId":
        $datos = $usuarios->get_usuario_id($body["UsuarioID"]);
        echo json_encode($datos);
        break;

    case "Insert":
        $datos = $usuarios->insert_usuario($body["TrabajadorID"], $body["NombreUsuario"], $body["Contrasena"]);
        echo json_encode($datos);
        break;

    case "Update":
        $datos = $usuarios->update_usuario($body["UsuarioID"], $body["TrabajadorID"], $body["NombreUsuario"], $body["Contrasena"]);
        echo json_encode($datos);
        break;

    case "Delete":
        $datos = $usuarios->delete_usuario($body["UsuarioID"]);
        echo json_encode($datos);
        break;
}
?>
