<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
class AccionesAreas
{
    public static function listarAreas()
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = $conexion->prepare("SELECT areas.*, bloques.nombre AS nombre_bloque, facultades.nombre AS nombre_facultad, usuarios.nombre AS nombre_usuario 
            FROM areas 
            LEFT JOIN bloques ON areas.id_bloque_per = bloques.id
            LEFT JOIN facultades ON bloques.id_facultad_per = facultades.id
            LEFT JOIN usuarios ON areas.id_usu_encargado = usuarios.id
            ");
            /* FROM areas INNER JOIN facultades ON areas.id_facultad_per = facultades.id"); */
            $consulta->execute();
            $dato = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $dato;
            $tabla = '';
            foreach ($dato as $respuesta) {
                $tabla .= '
                    <tr>
                        
                        <td ">' . htmlspecialchars($respuesta['nombre']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['descripcion']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['nombre_facultad']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['nombre_bloque']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['piso']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['nombre_usuario']) . '</td>
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
            error_log('Error al listar Areas: ' . $e->getMessage());
            return [
                'codigo' => 1,
                'mensaje' => 'Error al listar áreas: ' . $e->getMessage()
            ];
        }

    }

    public static function listarBloquesInsertar()
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = "SELECT bloques.*, facultades.nombre AS nombre_facultad 
            FROM bloques 
            INNER JOIN facultades ON bloques.id_facultad_per = facultades.id";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $dato;
            $tabla = '';

            foreach ($dato as $respuesta) {
                $tabla .= '
                    <option value="' . htmlspecialchars($respuesta['id']) . '">' . htmlspecialchars($respuesta['nombre']).'-'.htmlspecialchars($respuesta['nombre_facultad']).'</option>
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

    public static function listarBloquesEditar()
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = "SELECT bloques.*, facultades.nombre AS nombre_facultad 
            FROM bloques 
            INNER JOIN facultades ON bloques.id_facultad_per = facultades.id";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $dato;
            $tabla = '';

            foreach ($dato as $respuesta) {
                $tabla .= '
                    <option value="' . htmlspecialchars($respuesta['nombre']) . '">' . htmlspecialchars($respuesta['nombre']).'-'.htmlspecialchars($respuesta['nombre_facultad']).'</option>
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

    public static function listarUsuariosInsertar()
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = "SELECT * FROM usuarios";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $dato;
            $tabla = '';

            foreach ($dato as $respuesta) {
                $tabla .= '
                    <option value="' . htmlspecialchars($respuesta['id']) . '">' . htmlspecialchars($respuesta['nombre']).'</option>
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

    public static function listarUsuariosEditar()
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = "SELECT * FROM usuarios";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $dato;
            $tabla = '';

            foreach ($dato as $respuesta) {
                $tabla .= '
                    <option value="' . htmlspecialchars($respuesta['nombre']) . '">' . htmlspecialchars($respuesta['nombre']).'</option>
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

    public static function actualizarArea($id, $nombre, $descripcion, $piso, $id_bloque_per, $id_usu_encargado)
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = $conexion->prepare("SELECT * FROM areas WHERE nombre= :nombre AND id != :id");
            $consulta->bindParam(":nombre", $nombre);
            $consulta->bindParam(":id", $id);
            $consulta->execute();
            if ($consulta->fetch()) {
                echo ("El área ya existe.");
                return 1;
            } else {
                $bloques = $conexion->prepare("SELECT id FROM bloques WHERE nombre= :nombre_bloque");
                $bloques->bindParam(':nombre_bloque', $id_bloque_per);
                $bloques->execute();
                $dato_bloque = $bloques->fetch(PDO::FETCH_ASSOC);

                $usuario = $conexion->prepare("SELECT id FROM usuarios WHERE nombre= :nombre_usuario");
                $usuario->bindParam(':nombre_usuario', $id_usu_encargado);
                $usuario->execute();
                $dato_usuario = $usuario->fetch(PDO::FETCH_ASSOC);
                
                $consulta = $conexion->prepare("UPDATE areas SET nombre= :nombre, descripcion= :descripcion, piso= :piso, id_bloque_per= :id_bloque_per, id_usu_encargado= :id_usu_encargado WHERE id=:id");
                $consulta->bindParam(":id", $id);
                $consulta->bindParam(":nombre", $nombre);
                $consulta->bindParam(':descripcion', $descripcion);
                $consulta->bindParam(':piso', $piso);
                $consulta->bindParam(':id_bloque_per', $dato_bloque['id']);
                $consulta->bindParam(':id_usu_encargado', $dato_usuario['id']);
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