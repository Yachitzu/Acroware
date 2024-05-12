<?php
include_once ("C:/xampp/htdocs/SOA/sistemas/DAS/Front/Acroware/patrones/Singleton/Conexion.php");

class AccionesBloques
{
    public static function listarBloques()
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = "SELECT bloques.*, facultades.nombre AS nombre_facultad 
            FROM bloques 
            INNER JOIN facultades ON bloques.id_facultad_per = facultades.id";
            /* LEFT JOIN facultades ON bloques.id_facultad_per = facultades.id"; */
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
                        <td ">' . htmlspecialchars($respuesta['nombre_facultad']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['pisos']) . '</td>
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
            error_log('Error al listar bloques: ' . $e->getMessage());
            return [
                'codigo' => 1,
                'mensaje' => 'Error al listar bloques: ' . $e->getMessage()
            ];
        }
    }

    public static function listarFacultadesInsertar()
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

    public static function listarFacultadesEditar()
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


    public static function insertarbloques($nombre, $descripcion, $id_facultad_per, $pisos)
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = "SELECT * FROM bloques where nombre = :nombre";
            $resultado = $conexion->prepare($consulta);
            $resultado->bindParam(':nombre', $nombre);
            $resultado->execute();
            if ($resultado->fetch()) {
                echo ("El bloque ya existe");
                return 1;
            } else {
                $consulta = $conexion->prepare("INSERT INTO bloques (nombre, descripcion, id_facultad_per, pisos) values (:nombre, :descripcion, :id_facultad_per, :pisos)");
                $consulta->bindParam(':nombre', $nombre);
                $consulta->bindParam(':id_facultad_per', $id_facultad_per);
                $consulta->bindParam(':descripcion', $descripcion);
                $consulta->bindParam(':pisos', $pisos);
                $consulta->execute();
                return 0;
            }
        } catch (PDOException $e) {
            error_log('Error en insertarbloques: ' . $e->getMessage());
            return 2;
        }
    }


    public static function actualizarBloques($id, $nombre, $descripcion, $id_facultad_per, $pisos)
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = "SELECT * FROM bloques where nombre = :nombre AND id != :id";
            $resultado = $conexion->prepare($consulta);
            $resultado->bindParam(':nombre', $nombre);
            $resultado->bindParam(':id', $id);
            $resultado->execute();
            if ($resultado->fetch()) {
                echo ("El bloque ya existe");
                return 1;
            } else {
                $facultad = $conexion->prepare("SELECT id FROM facultades WHERE nombre= :nombre_facultad");
                $facultad->bindParam(':nombre_facultad', $id_facultad_per);
                $facultad->execute();
                $dato = $facultad->fetch(PDO::FETCH_ASSOC);
                $consulta = $conexion->prepare("UPDATE bloques  set nombre= :nombre, descripcion= :descripcion, id_facultad_per= :id_facultad_per, pisos= :pisos where id=:id");
                $consulta->bindParam(':id', $id);
                $consulta->bindParam(':nombre', $nombre);
                $consulta->bindParam(':descripcion', $descripcion);
                $consulta->bindParam(':id_facultad_per', $dato['id']);
                $consulta->bindParam(':pisos', $pisos);
                $consulta->execute();
                return 0;
            }
        } catch (PDOException $e) {
            error_log('Error en actualizarBloques: ' . $e->getMessage());
            return 2;
        }
    }

    public static function eliminarBloque($id)
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = $conexion->prepare("DELETE FROM bloques where id=:id");
            $consulta->bindParam(':id', $id);
            $consulta->execute();
            return 0;
        } catch (PDOException $e) {
            error_log('Error en eliminarBloques: ' . $e->getMessage());
            return 2;
        }
    }
}
?>