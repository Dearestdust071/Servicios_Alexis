<?php
class Bancos extends Conectar
{
    public function get_bancos()
    {
        try {
            $db = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM Banco";
            $sql = $db->prepare($sql);
            $sql->execute();
            $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
            $Array = [];
    
            foreach ($resultado as $d) {
                $Array[] = [
                    'BancoID' => (int)$d->BancoID,
                    'Nombre' => $d->Nombre,
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

    public function get_banco_id($bancoID)
    {
        try {
            $db = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM Banco WHERE BancoID = ?";
            $sql = $db->prepare($sql);
            $sql->bindValue(1, $bancoID);
            $sql->execute();
            $resultado = $sql->fetch(PDO::FETCH_OBJ);
    
            $Array = [
                'BancoID' => (int)$resultado->BancoID,
                'Nombre' => $resultado->Nombre,
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

    public function insert_banco($nombre, $statuss)
    {
        try {
            $db = parent::conexion();
            parent::set_names();
            $sql = "INSERT INTO Banco (Nombre, statuss) VALUES (?, ?)";
            $sql = $db->prepare($sql);
            $sql->bindValue(1, $nombre);
            $sql->bindValue(2, $statuss);
            $sql->execute();

            return [
                "error" => false,
                "msg" => "Banco insertado correctamente"
            ];
        } catch (Exception $e) {
            return [
                "error" => true,
                "msg" => $e->getMessage()
            ];
        }
    }

    public function update_banco($bancoID, $nombre, $statuss)
    {
        try {
            $db = parent::conexion();
            parent::set_names();
            $sql = "UPDATE Banco SET Nombre=?, statuss=? WHERE BancoID=?";
            $sql = $db->prepare($sql);
            $sql->bindValue(1, $nombre);
            $sql->bindValue(2, $statuss);
            $sql->bindValue(3, $bancoID);
            $sql->execute();

            return [
                "error" => false,
                "msg" => "Banco actualizado correctamente"
            ];
        } catch (Exception $e) {
            return [
                "error" => true,
                "msg" => $e->getMessage()
            ];
        }
    }

    public function delete_banco($bancoID)
    {
        try {
            $db = parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM Banco WHERE BancoID=?";
            $sql = $db->prepare($sql);
            $sql->bindValue(1, $bancoID);
            $sql->execute();

            return [
                "error" => false,
                "msg" => "Banco eliminado correctamente"
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
