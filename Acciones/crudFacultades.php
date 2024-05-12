<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
class AccionesFacultades
{
    public static function listarFacultades()
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = "SELECT * FROM facultades";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $dato;
            $tabla = '';

            foreach ($dato as $respuesta) {
                $tabla .= '
                    <tr>
                        <td ">' . htmlspecialchars($respuesta['id']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['nombre']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['descripcion']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['campus']) . '</td>
                        <td class="mdl-data-table__cell">
                            <center>
                            <button class="btn btn-warning btn-circle element-white editar" data-id="' . $respuesta['id'] . '" id="editar">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-circle eliminar" id="eliminar">
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
            error_log('Error al listar Facultades: ' . $e->getMessage());
            return [
                'codigo' => 1,
                'mensaje' => 'Error al listar facultades: ' . $e->getMessage()
            ];
        }
    }

    public static function insertarFacultades($nombre, $descripcion, $campus)
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = "SELECT * FROM facultades where nombre = :nombre";
            $resultado = $conexion->prepare($consulta);
            $resultado->bindParam(':nombre', $nombre);
            $resultado->execute();
            if ($resultado->fetch()) {
                echo ("La facultad ya existe");
                return 1;
            } else {
                $consulta = $conexion->prepare("INSERT INTO facultades (nombre, descripcion, campus) values (:nombre, :descripcion, :campus)");
                $consulta->bindParam(':nombre', $nombre);
                $consulta->bindParam(':descripcion', $descripcion);
                $consulta->bindParam(':campus', $campus);
                $consulta->execute();
                return 0;
            }
        } catch (PDOException $e) {
            error_log('Error en insertarFacultades: ' . $e->getMessage());
            return 2;
        }
    }

    public static function actualizarFacultades($id, $nombre, $descripcion, $campus)
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = "SELECT * FROM facultades where nombre = :nombre AND id != :id";
            $resultado = $conexion->prepare($consulta);
            $resultado->bindParam(':nombre', $nombre);
            $resultado->bindParam(':id', $id);
            $resultado->execute();
            if ($resultado->fetch()) {
                echo ("La facultad ya existe");
                return 1;
            } else {
                $consulta = $conexion->prepare("UPDATE facultades  set nombre= :nombre, descripcion= :descripcion , campus=:campus where id=:id");
                $consulta->bindParam(':id', $id);
                $consulta->bindParam(':nombre', $nombre);
                $consulta->bindParam(':descripcion', $descripcion);
                $consulta->bindParam(':campus', $campus);
                $consulta->execute();
                return 0;
            }
        } catch (PDOException $e) {
            error_log('Error en actualizarFacultades: ' . $e->getMessage());
            return 2;
        }
    }

    public static function eliminarFacultad($id)
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = $conexion->prepare("DELETE FROM facultades where id=:id");
            $consulta->bindParam(':id', $id);
            $consulta->execute();
            return 0;
        } catch (PDOException $e) {
            error_log('Error en eliminarFacultad: ' . $e->getMessage());
            return 2;
        }
    }

}
?>