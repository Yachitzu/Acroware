<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
class AccionesUbicaciones
{
    public static function listarUbicaciones()
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = "SELECT ubicaciones.*, areas.nombre AS nombre_area from ubicaciones
            INNER JOIN areas ON ubicaciones.id_area_per=areas.id
            WHERE ubicaciones.activo = 'si'";

            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $dato;
            $tabla = '';
            foreach ($dato as $respuesta) {
                $tabla .= '
                    <tr>
                        
                        <td ">' . htmlspecialchars($respuesta['nombre']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['descripcion']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['nombre_area']) . '</td>
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
            error_log('Error al listar Ubicaciones: ' . $e->getMessage());
            return [
                'codigo' => 1,
                'mensaje' => 'Error al listar ubicaciones: ' . $e->getMessage()
            ];
        }
    }

    public static function listarAreasInsertar()
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = "SELECT * FROM areas where activo='si'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $dato;
            $tabla = '';

            foreach ($dato as $respuesta) {
                $tabla .= '
                    <option value="' . htmlspecialchars($respuesta['id']) . '">' . htmlspecialchars($respuesta['nombre']) . '</option>
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

    public static function listarAreasEditar()
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = "SELECT * FROM areas where activo='si'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $dato;
            $tabla = '';

            foreach ($dato as $respuesta) {
                $tabla .= '
                    <option value="' . htmlspecialchars($respuesta['nombre']) . '">' . htmlspecialchars($respuesta['nombre']) . '</option>
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


    public static function insertarUbicaciones($nombre, $descripcion, $id_area_per)
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = "SELECT * FROM ubicaciones where BINARY nombre= :nombre and activo='si'";
            $resultado = $conexion->prepare($consulta);
            $resultado->bindParam(':nombre', $nombre);
            $resultado->execute();
            if ($resultado->fetch()) {
                echo ("La ubicacion ya existe.");
                return 1;
            } else {
                $consulta = $conexion->prepare("INSERT INTO ubicaciones (nombre, descripcion, id_area_per) values (:nombre, :descripcion, :id_area_per)");
                $consulta->bindParam(':nombre', $nombre);
                $consulta->bindParam(':descripcion', $descripcion);
                $consulta->bindParam(':id_area_per', $id_area_per);
                $consulta->execute();
                return 0;
            }
        } catch (PDOException $e) {
            error_log('Error en insertarUbicaciones: ' . $e->getMessage());
            return 2;
        }
    }

    public static function actualizarUbicacion($id, $nombre, $descripcion, $id_area_per)
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = "SELECT * FROM ubicaciones where BINARY nombre= :nombre AND id != :id AND activo='si'";
            $resultado = $conexion->prepare($consulta);
            $resultado->bindParam(':nombre', $nombre);
            $resultado->bindParam(':id', $id);
            $resultado->execute();
            if ($resultado->fetch()) {
                echo ("No se pudo actualizar la ubicación.");
                return 1;
            } else {
                $areas = $conexion->prepare("SELECT id FROM areas WHERE nombre= :nombre_area");
                $areas->bindParam(':nombre_area', $id_area_per);
                $areas->execute();
                $dato = $areas->fetch(PDO::FETCH_ASSOC);

                $consulta = $conexion->prepare("UPDATE ubicaciones SET nombre= :nombre, descripcion= :descripcion, id_area_per= :id_area_per Where id= :id");
                $consulta->bindParam(':id', $id);
                $consulta->bindParam(':nombre', $nombre);
                $consulta->bindParam(':descripcion', $descripcion);
                $consulta->bindParam(':id_area_per', $dato['id']);
                $consulta->execute();
                $consulta;
                return 0;
            }
        } catch (PDOException $e) {
            error_log('Error en actualizarUbicaciones: ' . $e->getMessage());
            return 2;
        }
    }

    public static function eliminarUbicacion($id)
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();

            // Verificar en bienes_informaticos
            $verificacion_informaticos = $conexion->prepare("SELECT COUNT(*) AS referencias FROM bienes_informaticos WHERE id_ubi_per = :id AND activo='si'");
            $verificacion_informaticos->bindParam(':id', $id);
            $verificacion_informaticos->execute();
            $resultado_informaticos = $verificacion_informaticos->fetch(PDO::FETCH_ASSOC);

            // Verificar en bienes_mobiliarios
            $verificacion_mobiliarios = $conexion->prepare("SELECT COUNT(*) AS referencias FROM bienes_mobiliarios WHERE id_ubi_per = :id AND activo='si'");
            $verificacion_mobiliarios->bindParam(':id', $id);
            $verificacion_mobiliarios->execute();
            $resultado_mobiliarios = $verificacion_mobiliarios->fetch(PDO::FETCH_ASSOC);

            if ($resultado_informaticos['referencias'] > 0 || $resultado_mobiliarios['referencias'] > 0) {
                return 1;
            } else {
                $consulta = $conexion->prepare("UPDATE ubicaciones set activo= 'no' where id= :id");
                $consulta->bindParam(':id', $id);
                $consulta->execute();
                return 0;
            }
        } catch (PDOException $e) {
            error_log('Error en eliminarUbicaciones: ' . $e->getMessage());
            return 2;
        }
    }

}
?>