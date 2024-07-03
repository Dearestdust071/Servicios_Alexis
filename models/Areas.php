<?php
class Areas extends Conectar
{
    public function get_areas()
    {
        try {
            $db = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM Areas";
            $sql = $db->prepare($sql);
            $sql->execute();
            $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
            $Array = [];
    
            foreach ($resultado as $d) {
                $Array[] = [
                    'AreaID' => (int)$d->AreaID,
                    'NombreArea' => $d->NombreArea,
                    'EncargadoID' => (int)$d->EncargadoID,
                    'statuss' => (int)$d->statuss,
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

    public function get_area_id($areaID)
    {
        try {
            $db = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM Areas WHERE AreaID = ?";
            $sql = $db->prepare($sql);
            $sql->bindValue(1, $areaID);
            $sql->execute();
            $resultado = $sql->fetch(PDO::FETCH_OBJ);
    
            $Array = [
                'AreaID' => (int)$resultado->AreaID,
                'NombreArea' => $resultado->NombreArea,
                'EncargadoID' => (int)$resultado->EncargadoID,
                'statuss' => (int)$resultado->statuss,
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

    public function insert_area($nombreArea, $encargadoID, $statuss)
    {
        try {
            $db = parent::conexion();
            parent::set_names();
            $sql = "INSERT INTO Areas (NombreArea, EncargadoID, statuss) VALUES (?, ?, ?)";
            $sql = $db->prepare($sql);
            $sql->bindValue(1, $nombreArea);
            $sql->bindValue(2, $encargadoID);
            $sql->bindValue(3, $statuss);
            $sql->execute();

            return [
                "error" => false,
                "msg" => "Área insertada correctamente"
            ];
        } catch (Exception $e) {
            return [
                "error" => true,
                "msg" => $e->getMessage()
            ];
        }
    }

    public function update_area($areaID, $nombreArea, $encargadoID, $statuss)
    {
        try {
            $db = parent::conexion();
            parent::set_names();
            $sql = "UPDATE Areas SET NombreArea=?, EncargadoID=?, statuss=? WHERE AreaID=?";
            $sql = $db->prepare($sql);
            $sql->bindValue(1, $nombreArea);
            $sql->bindValue(2, $encargadoID);
            $sql->bindValue(3, $statuss);
            $sql->bindValue(4, $areaID);
            $sql->execute();

            return [
                "error" => false,
                "msg" => "Área actualizada correctamente"
            ];
        } catch (Exception $e) {
            return [
                "error" => true,
                "msg" => $e->getMessage()
            ];
        }
    }

    public function delete_area($areaID)
    {
        try {
            $db = parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM Areas WHERE AreaID=?";
            $sql = $db->prepare($sql);
            $sql->bindValue(1, $areaID);
            $sql->execute();

            return [
                "error" => false,
                "msg" => "Área eliminada correctamente"
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
