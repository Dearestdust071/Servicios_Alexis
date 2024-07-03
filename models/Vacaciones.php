<?php
class Vacaciones extends Conectar
{
    public function get_vacaciones()
    {
        try {
            $db = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM Vacaciones";
            $sql = $db->prepare($sql);
            $sql->execute();
            $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
            $Array = [];
    
            foreach ($resultado as $d) {
                $Array[] = [
                    'VacacionesID' => (int)$d->VacacionesID,
                    'TrabajadorID' => (int)$d->TrabajadorID,
                    'FechaInicio' => $d->FechaInicio,
                    'FechaFin' => $d->FechaFin,
                ];
            }
    
            return [
                "error" => false,
                "msg" => $Array
            ];
        } catch (Exception $e) {
            return [
                "error" => true,
                "msg" => $e->getMessage()
            ];
        }
    }

    public function get_vacacion_id($vacacionesID)
    {
        try {
            $db = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM Vacaciones WHERE VacacionesID = ?";
            $sql = $db->prepare($sql);
            $sql->bindValue(1, $vacacionesID);
            $sql->execute();
            $resultado = $sql->fetch(PDO::FETCH_OBJ);
    
            $Array = [
                'VacacionesID' => (int)$resultado->VacacionesID,
                'TrabajadorID' => (int)$resultado->TrabajadorID,
                'FechaInicio' => $resultado->FechaInicio,
                'FechaFin' => $resultado->FechaFin,
            ];
    
            return [
                "error" => false,
                "msg" => $Array
            ];
        } catch (Exception $e) {
            return [
                "error" => true,
                "msg" => $e->getMessage()
            ];
        }
    }

    public function insert_vacacion($trabajadorID, $fechaInicio, $fechaFin)
    {
        try {
            $db = parent::conexion();
            parent::set_names();
            $sql = "INSERT INTO Vacaciones (TrabajadorID, FechaInicio, FechaFin) VALUES (?, ?, ?)";
            $sql = $db->prepare($sql);
            $sql->bindValue(1, $trabajadorID);
            $sql->bindValue(2, $fechaInicio);
            $sql->bindValue(3, $fechaFin);
            $sql->execute();

            return [
                "error" => false,
                "msg" => "Vacación insertada correctamente"
            ];
        } catch (Exception $e) {
            return [
                "error" => true,
                "msg" => $e->getMessage()
            ];
        }
    }

    public function update_vacacion($vacacionesID, $trabajadorID, $fechaInicio, $fechaFin)
    {
        try {
            $db = parent::conexion();
            parent::set_names();
            $sql = "UPDATE Vacaciones SET TrabajadorID=?, FechaInicio=?, FechaFin=? WHERE VacacionesID=?";
            $sql = $db->prepare($sql);
            $sql->bindValue(1, $trabajadorID);
            $sql->bindValue(2, $fechaInicio);
            $sql->bindValue(3, $fechaFin);
            $sql->bindValue(4, $vacacionesID);
            $sql->execute();

            return [
                "error" => false,
                "msg" => "Vacación actualizada correctamente"
            ];
        } catch (Exception $e) {
            return [
                "error" => true,
                "msg" => $e->getMessage()
            ];
        }
    }

    public function delete_vacacion($vacacionesID)
    {
        try {
            $db = parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM Vacaciones WHERE VacacionesID=?";
            $sql = $db->prepare($sql);
            $sql->bindValue(1, $vacacionesID);
            $sql->execute();

            return [
                "error" => false,
                "msg" => "Vacación eliminada correctamente"
            ];
        } catch (Exception $e) {
            return [
                "error" => true,
                "msg" => $e->getMessage()
            ];
        }
    }
}
?>
