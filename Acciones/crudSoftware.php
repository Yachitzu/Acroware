<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
class AccionesSoftware
{
    public static function listarSoftware()
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = "SELECT * FROM software";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $dato;
            $tabla = '';

            foreach ($dato as $respuesta) {
                $tabla .= '
                    <tr>
                        
                        <td ">' . htmlspecialchars($respuesta['nombre_software']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['activado']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['tipo_licencia']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['fecha_adqui']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['fecha_activacion']) . '</td>
                        <td class="mdl-data-table__cell">
                            <center>
                            <button class="btn btn-warning btn-circle element-white editar" data-id="' . $respuesta['id'] . '" id="editar">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-circle eliminar" data-id="' . $respuesta['id'] . '" id="eliminar">
                            <i class="fas fa-trash"></i>
                        </button>
                            </center>
                        </td>
                    </tr>
                ';
            }
            return [
                'codigo' => 0,
                'dato' => $tabla,
            ];
        } catch (PDOException $e) {
            error_log('Error al listar software: ' . $e->getMessage());
            return [
                'codigo' => 1,
                'mensaje' => 'Error al listar software: ' . $e->getMessage()
            ];
        }
    }

    public static function insertarSoftware($nombre_software, $activado, $tipo_licencia, $fecha_adqui, $fecha_activacion)
{
    try {
        $conexion = Conexion::getInstance()->getConexion();
        $consulta = "SELECT * FROM software where BINARY nombre_software = :nombre";
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':nombre', $nombre_software);
        $resultado->execute();
        if ($resultado->rowCount() > 0) {
            http_response_code(409);
            echo json_encode(['error' => 'Ya existe el software']);
            exit();
        } else {
            $consulta = $conexion->prepare("INSERT INTO software (nombre_software, activado, tipo_licencia, fecha_adqui, fecha_activacion) values (:nombre_software, :activado, :tipo_licencia, :fecha_adqui, :fecha_activacion)");
            $consulta->bindParam(':nombre_software', $nombre_software);
            $consulta->bindParam(':tipo_licencia', $tipo_licencia);
            $consulta->bindParam(':activado', $activado);
            $consulta->bindParam(':fecha_adqui', $fecha_adqui);
            $consulta->bindParam(':fecha_activacion', $fecha_activacion);
            $consulta->execute();
            return 0;
        }
    } catch (PDOException $e) {
        error_log('Error en insertar Software: '. $e->getMessage());
        return 2;
    }
}

    public static function actualizarSoftware($id, $nombre_software, $activado, $tipo_licencia, $fecha_adqui, $fecha_activacion)
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = "SELECT * FROM software where BINARY nombre_software = :nombre and id!=:id";
            $resultado = $conexion->prepare($consulta);
            $resultado->bindParam(':nombre', $nombre_software);
            $resultado->bindParam(':id', $id);
            $resultado->execute();
            if ($resultado->rowCount() > 0) {
                http_response_code(409);
                echo json_encode(['error' => 'Ya existe el software']);
                exit();
            } else {
                $consulta = $conexion->prepare("UPDATE software  set nombre_software = :nombre_software, activado = :activado, tipo_licencia = :tipo_licencia, fecha_adqui = :fecha_adqui, fecha_activacion = :fecha_activacion where id = :id");
                $consulta->bindParam(':id', $id);
                $consulta->bindParam(':nombre_software', $nombre_software);
                $consulta->bindParam(':tipo_licencia', $tipo_licencia);
                $consulta->bindParam(':activado', $activado);
                $consulta->bindParam(':fecha_adqui', $fecha_adqui);
                $consulta->bindParam(':fecha_activacion', $fecha_activacion);
                $consulta->execute();
            return 0;
            }
        } catch (PDOException $e) {
            error_log('Error en actualizar software: ' . $e->getMessage());
            return 2;
        }
    }

    public static function eliminarSoftware($id)
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
                $consulta = $conexion->prepare("UPDATE software  set activado= 'No' where id=:id");
                $consulta->bindParam(':id', $id);
                $consulta->execute();
                return 0;
           
        } catch (PDOException $e) {
            error_log('Error en eliminar Software: ' . $e->getMessage());
            return 2;
        }
    }

}
?>