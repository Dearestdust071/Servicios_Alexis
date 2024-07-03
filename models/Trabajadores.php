<?php
class Trabajadores extends Conectar
{
    // Obtener todos los trabajadores con JOIN para incluir nombres de áreas y bancos
    public function get_trabajadores()
    {

        try {
            $db = parent::conexion();
            parent::set_names();
            $sql = "SELECT 
                        t.*, 
                        a.NombreArea, 
                        b.Nombre AS Nombre_banco 
                    FROM 
                        Trabajadores AS t 
                    LEFT JOIN 
                        Areas AS a ON a.AreaID = t.AreaID 
                    LEFT JOIN 
                        Banco AS b ON t.BancoID = b.BancoID";
            $sql = $db->prepare($sql);
            $sql->execute();
            $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
            $Array = [];
            
            foreach ($resultado as $d) {
                $Array[] = [
                    'TrabajadorID' => (int)$d->TrabajadorID,
                    'Nombre' => $d->Nombre,
                    'Apellido_paterno' => $d->Apellido_paterno,
                    'Apellido_materno' => $d->Apellido_materno,
                    'FechaNacimiento' => $d->FechaNacimiento,
                    'Calle' => $d->Calle,
                    'Numero' => (int)$d->Numero,
                    'Colonia' => $d->Colonia,
                    'Codigo_postal' => $d->Codigo_postal,
                    'Puesto' => $d->Puesto,
                    'Sueldo' => (float)$d->Sueldo,
                    'Cuenta_banco' => $d->Cuenta_banco,
                    'FechaIngreso' => $d->FechaIngreso,
                    'FechaSalida' => $d->FechaSalida,
                    'AreaID' => (int)$d->AreaID,
                    'BancoID' => (int)$d->BancoID,
                    'SupervisorID' => (int)$d->SupervisorID,
                    'DiasVacacionesPermitidos' => (int)$d->DiasVacacionesPermitidos,
                    'DiasVacacionesRestantes' => (int)$d->DiasVacacionesRestantes,
                ];
            }
            return [ // No hay error
                "error" => false,
                "msg" => $Array
            ];
        } catch (Exception $e) {
            return [ // Sí hay error
                "error" => true,
                "msg" => $e->getMessage()
            ];
        }
    }
    
    // Obtener trabajador por ID
    public function get_trabajadores_id($trabajadorID)
    {
        try {
            $db = parent::conexion();
            parent::set_names();
            $sql = "SELECT 
                        t.*, 
                        a.NombreArea, 
                        b.Nombre AS Nombre_banco 
                    FROM 
                        Trabajadores t 
                    LEFT JOIN 
                        Areas a ON t.AreaID = a.AreaID 
                    LEFT JOIN 
                        Banco b ON t.BancoID = b.BancoID 
                    WHERE 
                        t.TrabajadorID = ?";
    
            $stmt = $db->prepare($sql);
            $stmt->bindValue(1, $trabajadorID);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_OBJ);
    
            $Array = [
                'TrabajadorID' => (int)$resultado->TrabajadorID,
                'Nombre' => $resultado->Nombre,
                'Apellido_paterno' => $resultado->Apellido_paterno,
                'Apellido_materno' => $resultado->Apellido_materno,
                'FechaNacimiento' => $resultado->FechaNacimiento,
                'Calle' => $resultado->Calle,
                'Numero' => (int)$resultado->Numero,
                'Colonia' => $resultado->Colonia,
                'Codigo_postal' => $resultado->Codigo_postal,
                'Puesto' => $resultado->Puesto,
                'Sueldo' => (float)$resultado->Sueldo,
                'Cuenta_banco' => $resultado->Cuenta_banco,
                'FechaIngreso' => $resultado->FechaIngreso,
                'FechaSalida' => $resultado->FechaSalida,
                'AreaID' => (int)$resultado->AreaID,
                'BancoID' => (int)$resultado->BancoID,
                'SupervisorID' => (int)$resultado->SupervisorID,
                'DiasVacacionesPermitidos' => (int)$resultado->DiasVacacionesPermitidos,
                'DiasVacacionesRestantes' => (int)$resultado->DiasVacacionesRestantes,
            ];
    
            return [ // No hay error
                "error" => false,
                "msg" => $Array
            ];
        } catch (Exception $e) {
            return [ // Sí hay error
                "error" => true,
                "msg" => $e->getMessage()
            ];
        }
    }

    // Obtener trabajadores por área
    public function get_trabajadores_por_area($AreaID)
    {
        try {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT 
                        t.* 
                    FROM 
                        Trabajadores t 
                    WHERE 
                        t.AreaID = ?";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $AreaID);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
            
            $Array = [];
            
            foreach ($resultado as $d) {
                $Array[] = [
                    'TrabajadorID' => (int)$d->TrabajadorID,
                    'Nombre' => $d->Nombre,
                    'Apellido_paterno' => $d->Apellido_paterno,
                    'Apellido_materno' => $d->Apellido_materno,
                    'FechaNacimiento' => $d->FechaNacimiento,
                    'Calle' => $d->Calle,
                    'Numero' => (int)$d->Numero,
                    'Colonia' => $d->Colonia,
                    'Codigo_postal' => $d->Codigo_postal,
                    'Puesto' => $d->Puesto,
                    'Sueldo' => (float)$d->Sueldo,
                    'Cuenta_banco' => $d->Cuenta_banco,
                    'FechaIngreso' => $d->FechaIngreso,
                    'FechaSalida' => $d->FechaSalida,
                    'AreaID' => (int)$d->AreaID,
                    'BancoID' => (int)$d->BancoID,
                    'SupervisorID' => (int)$d->SupervisorID,
                    'DiasVacacionesPermitidos' => (int)$d->DiasVacacionesPermitidos,
                    'DiasVacacionesRestantes' => (int)$d->DiasVacacionesRestantes,
                ];
            }
            return [ // No hay error
                "error" => false,
                "msg" => $Array
            ];
        } catch (Exception $e) {
            return [ // Sí hay error
                "error" => true,
                "msg" => $e->getMessage()
            ];
        }
    }

    // Insertar un nuevo trabajador
    public function insert_trabajadores($nombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $calle, $numero, $colonia, $codigoPostal, $puesto, $sueldo, $cuentaBanco, $fechaIngreso, $areaID, $bancoID, $supervisorID, $diasVacacionesPermitidos, $diasVacacionesRestantes)
    {
        try {
            $db = parent::conexion();
            parent::set_names();

            $sql = "INSERT INTO Trabajadores (
                        Nombre, Apellido_paterno, Apellido_materno, FechaNacimiento, Calle, Numero, Colonia, Codigo_postal, Puesto, Sueldo, Cuenta_banco, FechaIngreso, AreaID, BancoID, SupervisorID, DiasVacacionesPermitidos, DiasVacacionesRestantes
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $sql = $db->prepare($sql);
            $sql->bindValue(1, $nombre);
            $sql->bindValue(2, $apellidoPaterno);
            $sql->bindValue(3, $apellidoMaterno);
            $sql->bindValue(4, $fechaNacimiento);
            $sql->bindValue(5, $calle);
            $sql->bindValue(6, $numero);
            $sql->bindValue(7, $colonia);
            $sql->bindValue(8, $codigoPostal);
            $sql->bindValue(9, $puesto);
            $sql->bindValue(10, $sueldo);
            $sql->bindValue(11, $cuentaBanco);
            $sql->bindValue(12, $fechaIngreso);
            $sql->bindValue(13, $areaID);
            $sql->bindValue(14, $bancoID);
            $sql->bindValue(15, $supervisorID);
            $sql->bindValue(16, $diasVacacionesPermitidos);
            $sql->bindValue(17, $diasVacacionesRestantes);

            $sql->execute();

            return [ // No hay error
                "error" => false,
                "msg" => "Trabajador insertado correctamente"
            ];
        } catch (Exception $e) {
            return [ // Sí hay error
                "error" => true,
                "msg" => $e->getMessage()
            ];
        }
    }

    // Actualizar un trabajador existente
    public function update_trabajadores($trabajadorID, $nombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $calle, $numero, $colonia, $codigoPostal, $puesto, $sueldo, $cuentaBanco, $fechaIngreso, $fechaSalida, $areaID, $bancoID, $supervisorID, $diasVacacionesPermitidos, $diasVacacionesRestantes)
    {
        try {
            $db = parent::conexion();
            parent::set_names();

            $sql = "UPDATE Trabajadores 
                    SET Nombre = ?, Apellido_paterno = ?, Apellido_materno = ?, FechaNacimiento = ?, Calle = ?, Numero = ?, Colonia = ?, Codigo_postal = ?, Puesto = ?, Sueldo = ?, Cuenta_banco = ?, FechaIngreso = ?, FechaSalida = ?, AreaID = ?, BancoID = ?, SupervisorID = ?, DiasVacacionesPermitidos = ?, DiasVacacionesRestantes = ? 
                    WHERE TrabajadorID = ?";
            $sql = $db->prepare($sql);
            $sql->bindValue(1, $nombre);
            $sql->bindValue(2, $apellidoPaterno);
            $sql->bindValue(3, $apellidoMaterno);
            $sql->bindValue(4, $fechaNacimiento);
            $sql->bindValue(5, $calle);
            $sql->bindValue(6, $numero);
            $sql->bindValue(7, $colonia);
            $sql->bindValue(8, $codigoPostal);
            $sql->bindValue(9, $puesto);
            $sql->bindValue(10, $sueldo);
            $sql->bindValue(11, $cuentaBanco);
            $sql->bindValue(12, $fechaIngreso);
            $sql->bindValue(13, $fechaSalida);
            $sql->bindValue(14, $areaID);
            $sql->bindValue(15, $bancoID);
            $sql->bindValue(16, $supervisorID);
            $sql->bindValue(17, $diasVacacionesPermitidos);
            $sql->bindValue(18, $diasVacacionesRestantes);
            $sql->bindValue(19, $trabajadorID);

            $sql->execute();

            return [ // No hay error
                "error" => false,
                "msg" => "Trabajador actualizado correctamente"
            ];
        } catch (Exception $e) {
            return [ // Sí hay error
                "error" => true,
                "msg" => $e->getMessage()
            ];
        }
    }

    // Eliminar un trabajador por ID
    public function delete_trabajadores($trabajadorID)
    {
        try {
            $db = parent::conexion();
            parent::set_names();

            $sql = "DELETE FROM Trabajadores WHERE TrabajadorID = ?";
            $sql = $db->prepare($sql);
            $sql->bindValue(1, $trabajadorID);
            $sql->execute();

            return [ // No hay error
                "error" => false,
                "msg" => "Trabajador eliminado correctamente"
            ];
        } catch (Exception $e) {
            return [ // Sí hay error
                "error" => true,
                "msg" => $e->getMessage()
            ];
        }
    }
}
?>
