<?php
require_once("../config/conexion.php");
require_once("../models/Trabajadores.php");

$trabajadores = new Trabajadores();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {

    case "GetAll":
        $datos = $trabajadores->get_trabajadores();
        echo json_encode($datos);
        break;

    case "GetId":
        $datos = $trabajadores->get_trabajadores_id($body["TrabajadorID"]);
        echo json_encode($datos);
        break;

    case "GetByArea":
        $datos = $trabajadores->get_trabajadores_por_area($body["AreaID"]);
        echo json_encode($datos);
        break;

    case "Insert":
        $datos = $trabajadores->insert_trabajadores(
            $body["Nombre"], 
            $body["Apellido_paterno"], 
            $body["Apellido_materno"], 
            $body["FechaNacimiento"], 
            $body["Calle"], 
            $body["Numero"], 
            $body["Colonia"], 
            $body["Codigo_postal"], 
            $body["Puesto"], 
            $body["Sueldo"], 
            $body["Cuenta_banco"], 
            $body["FechaIngreso"], 
            $body["AreaID"], 
            $body["BancoID"], 
            $body["SupervisorID"], 
            $body["DiasVacacionesPermitidos"], 
            $body["DiasVacacionesRestantes"]
        );
        echo json_encode($datos);
        break;

    case "Update":
        $datos = $trabajadores->update_trabajadores(
            $body["TrabajadorID"], 
            $body["Nombre"], 
            $body["Apellido_paterno"], 
            $body["Apellido_materno"], 
            $body["FechaNacimiento"], 
            $body["Calle"], 
            $body["Numero"], 
            $body["Colonia"], 
            $body["Codigo_postal"], 
            $body["Puesto"], 
            $body["Sueldo"], 
            $body["Cuenta_banco"], 
            $body["FechaIngreso"], 
            $body["FechaSalida"], 
            $body["AreaID"], 
            $body["BancoID"], 
            $body["SupervisorID"], 
            $body["DiasVacacionesPermitidos"], 
            $body["DiasVacacionesRestantes"]
        );
        echo json_encode($datos);
        break;

    case "Delete":
        $datos = $trabajadores->delete_trabajadores($body["TrabajadorID"]);
        echo json_encode($datos);
        break;
}
?>
