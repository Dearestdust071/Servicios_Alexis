<?php
class Usuarios extends Conectar
{
    public function get_usuarios()
    {
        try {
            $db = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM Usuarios";
            $sql = $db->prepare($sql);
            $sql->execute();
            $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
            $Array = [];
    
            foreach ($resultado as $d) {
                $Array[] = [
                    'UsuarioID' => (int)$d->UsuarioID,
                    'TrabajadorID' => (int)$d->TrabajadorID,
                    'NombreUsuario' => $d->NombreUsuario,
                    'Contrasena' => $d->Contrasena,
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

    public function get_usuario_id($usuarioID)
    {
        try {
            $db = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM Usuarios WHERE UsuarioID = ?";
            $sql = $db->prepare($sql);
            $sql->bindValue(1, $usuarioID);
            $sql->execute();
            $resultado = $sql->fetch(PDO::FETCH_OBJ);
    
            $Array = [
                'UsuarioID' => (int)$resultado->UsuarioID,
                'TrabajadorID' => (int)$resultado->TrabajadorID,
                'NombreUsuario' => $resultado->NombreUsuario,
                'Contrasena' => $resultado->Contrasena,
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

    public function insert_usuario($trabajadorID, $nombreUsuario, $contrasena)
    {
        try {
            $db = parent::conexion();
            parent::set_names();
            $hashed_password = password_hash($contrasena, PASSWORD_BCRYPT);
            $sql = "INSERT INTO Usuarios (TrabajadorID, NombreUsuario, Contrasena) VALUES (?, ?, ?)";
            $sql = $db->prepare($sql);
            $sql->bindValue(1, $trabajadorID);
            $sql->bindValue(2, $nombreUsuario);
            $sql->bindValue(3, $hashed_password);
            $sql->execute();

            return [
                "error" => false,
                "msg" => "Usuario insertado correctamente"
            ];
        } catch (Exception $e) {
            return [
                "error" => true,
                "msg" => $e->getMessage()
            ];
        }
    }

    public function update_usuario($usuarioID, $trabajadorID, $nombreUsuario, $contrasena)
    {
        try {
            $db = parent::conexion();
            parent::set_names();
            $hashed_password = password_hash($contrasena, PASSWORD_BCRYPT);
            $sql = "UPDATE Usuarios SET TrabajadorID=?, NombreUsuario=?, Contrasena=? WHERE UsuarioID=?";
            $sql = $db->prepare($sql);
            $sql->bindValue(1, $trabajadorID);
            $sql->bindValue(2, $nombreUsuario);
            $sql->bindValue(3, $hashed_password);
            $sql->bindValue(4, $usuarioID);
            $sql->execute();

            return [
                "error" => false,
                "msg" => "Usuario actualizado correctamente"
            ];
        } catch (Exception $e) {
            return [
                "error" => true,
                "msg" => $e->getMessage()
            ];
        }
    }

    public function delete_usuario($usuarioID)
    {
        try {
            $db = parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM Usuarios WHERE UsuarioID=?";
            $sql = $db->prepare($sql);
            $sql->bindValue(1, $usuarioID);
            $sql->execute();

            return [
                "error" => false,
                "msg" => "Usuario eliminado correctamente"
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
