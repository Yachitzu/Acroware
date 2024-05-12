<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
class AccionesAreas
{
    public static function listarAreas()
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = $conexion->prepare("SELECT * FROM areas");
            $consulta->execute();
            $dato = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $dato;
            $tabla = '';
            foreach ($dato as $respuesta) {
                $tabla .= '
                    <tr>
                        <td ">' . htmlspecialchars($respuesta['id']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['nombre']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['descripcion']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['id_bloque_per']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['piso']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['id_usu_encargado']) . '</td>
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
            error_log('Error al listar Areas: ' . $e->getMessage());
            return [
                'codigo' => 1,
                'mensaje' => 'Error al listar áreas: ' . $e->getMessage()
            ];
        }

    }

    public static function insertarAreas($nombre, $descripcion, $piso, $id_bloque_per, $id_usu_encargado)
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = $conexion->prepare("SELECT * FROM areas WHERE nombre= :nombre");
            $consulta->bindParam(":nombre", $nombre);
            $consulta->execute();
            if ($consulta->fetch()) {
                echo ("El área ya existe.");
                return 1;
            } else {
                $consulta = $conexion->prepare("INSERT INTO areas(nombre,descripcion,piso,id_bloque_per,id_usu_encargado) values (:nombre,:descripcion,:piso,:id_bloque_per,:id_usu_encargado)");
                $consulta->bindParam(":nombre", $nombre);
                $consulta->bindParam(':descripcion', $descripcion);
                $consulta->bindParam(':piso', $piso);
                $consulta->bindParam(':id_bloque_per', $id_bloque_per);
                $consulta->bindParam(':id_usu_encargado', $id_usu_encargado);
                $consulta->execute();
                return 0;
            }
        } catch (PDOException $e) {
            error_log('Error en insertarAreas: ' . $e->getMessage());
            return 2;
        }
    }

    public static function actualizarArea($id, $nombre,$descripcion, $piso, $id_bloque_per, $id_usu_encargado)
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = $conexion->prepare("SELECT * FROM areas WHERE nombre= :nombre AND id != :id");
            $consulta->bindParam(":nombre", $nombre);
            $consulta->execute();
            if ($consulta->fetch()) {
                echo ("El área ya existe.");
                return 1;
            } else {
                $consulta = $conexion->prepare("UPDATE areas SET nombre= :nombre, descripcion= :descripcion, piso= :piso, id_bloque_per= :id_bloque_per, id_usu_encargado= :id_usu_encargado WHERE id=:id");
                $consulta->bindParam(":id", $id);
                $consulta->bindParam(":nombre", $nombre);
                $consulta->bindParam(':descripcion', $descripcion);
                $consulta->bindParam(':piso', $piso);
                $consulta->bindParam(':id_bloque_per', $id_bloque_per);
                $consulta->bindParam(':id_usu_encargado', $id_usu_encargado);
                $consulta->execute();
                return 0;
            }
        } catch (PDOException $e) {
            error_log('Error en actualizarAreas: ' . $e->getMessage());
            return 2;
        }

    }

    public static function eliminarArea($id)
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = $conexion->prepare("DELETE FROM areas WHERE id=:id");
            $consulta->bindParam(":id", $id);
            $consulta->execute();
            return 0;
        } catch (PDOException $e) {
            error_log('Error en eliminarArea: ' . $e->getMessage());
            return 2;
        }
    }
}
?>