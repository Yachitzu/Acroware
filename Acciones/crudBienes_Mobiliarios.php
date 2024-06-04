<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
class AccionesBienes_mobiliarios
{
    public static function listarBienes_mobiliarios()
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = $conexion->prepare("SELECT bienes_mobiliarios.*, marcas.nombre AS nombre_marca, areas.nombre AS nombre_area,
            ubicaciones.nombre AS nombre_ubicacion
            From bienes_mobiliarios
            LEFT JOIN marcas ON bienes_mobiliarios.id_marca = marcas.id
            LEFT JOIN areas ON bienes_mobiliarios.id_area_per = areas.id
            LEFT JOIN ubicaciones ON bienes_mobiliarios.id_ubi_per = ubicaciones.id
            where bienes_mobiliarios.activo='si'");
            $consulta->execute();
            $dato = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $dato;
            $tabla = '';

            foreach ($dato as $respuesta) {
                $tabla .= '
                    <tr>
                        <td ">' . htmlspecialchars($respuesta['codigo_uta']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['nombre']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['serie']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['nombre_marca']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['modelo']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['color']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['material']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['dimensiones']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['condicion']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['custodio_actual']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['fecha_ingreso']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['valor_contable']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['nombre_area']) . '</td>
                        <td ">' . htmlspecialchars($respuesta['nombre_ubicacion']) . '</td>
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
                        <input type="hidden" class="id_marca" value="' . htmlspecialchars($respuesta['id_marca']) . '">
                        <input type="hidden" class="id_area_per" value="' . htmlspecialchars($respuesta['id_area_per']) . '">
                        <input type="hidden" class="id_ubi_per" value="' . htmlspecialchars($respuesta['id_ubi_per']) . '">
                    </tr>
                ';
            }
            return [
                'codigo' => 0,
                'dato' => $tabla,
            ];
        } catch (PDOException $e) {
            error_log('Error al listar bienes mobiliarios: ' . $e->getMessage());
            return [
                'codigo' => 1,
                'mensaje' => 'Error al listar bienes mobiliarios: ' . $e->getMessage()
            ];
        }
    }

    public static function listarMarcasInsertar()
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = "SELECT * from marcas where activo = 'si'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $dato;
            $tabla = '';

            foreach ($dato as $respuesta) {
                $tabla .= '
                <option value="' . htmlspecialchars($respuesta['id']) . '">' . htmlspecialchars($respuesta['nombre']) . '</option>                ';
            }
            return [
                'codigo' => 0,
                'dato' => $tabla,
            ];
        } catch (PDOException $e) {
            error_log('Error al listar marcas: ' . $e->getMessage());
            return [
                'codigo' => 1,
                'mensaje' => 'Error al listar marcas: ' . $e->getMessage()
            ];
        }
    }

    public static function listarAreasInsertar()
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = "SELECT * from areas where activo = 'si'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $dato;
            $tabla = '';

            foreach ($dato as $respuesta) {
                $tabla .= '
                <option value="' . htmlspecialchars($respuesta['id']) . '">' . htmlspecialchars($respuesta['nombre']) . '</option>                ';
            }
            return [
                'codigo' => 0,
                'dato' => $tabla,
            ];
        } catch (PDOException $e) {
            error_log('Error al listar marcas: ' . $e->getMessage());
            return [
                'codigo' => 1,
                'mensaje' => 'Error al listar marcas: ' . $e->getMessage()
            ];
        }
    }

    public static function listarUbicacionesInsertar()
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = "SELECT * from ubicaciones where activo = 'si'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $dato;
            $tabla = '';

            foreach ($dato as $respuesta) {
                $tabla .= '
                <option value="' . htmlspecialchars($respuesta['id']) . '">' . htmlspecialchars($respuesta['nombre']) . '</option>                ';
            }
            return [
                'codigo' => 0,
                'dato' => $tabla,
            ];
        } catch (PDOException $e) {
            error_log('Error al listar marcas: ' . $e->getMessage());
            return [
                'codigo' => 1,
                'mensaje' => 'Error al listar marcas: ' . $e->getMessage()
            ];
        }
    }

    public static function insertarBienes_mobiliarios($codigo_uta, $nombre, $serie, $id_marca, $modelo, $color, $material, $dimensiones, $condicion, $custodio, $valor, $id_area_per, $id_ubi_per)
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = $conexion->prepare("INSERT INTO bienes_mobiliarios(codigo_uta,nombre,serie,id_marca,modelo,color,material,dimensiones,condicion,custodio_actual,valor_contable,id_area_per,id_ubi_per)
        VALUES (:codigo_uta,:nombre,:serie,:id_marca,:modelo,:color,:material,:dimensiones,:condicion,:custodio_actual,:valor_contable,:id_area_per,:id_ubi_per)");
            $consulta->bindParam(':codigo_uta', $codigo_uta);
            $consulta->bindParam(':nombre', $nombre);
            $consulta->bindParam(':serie', $serie);
            $consulta->bindParam(':id_marca', $id_marca);
            $consulta->bindParam(':modelo', $modelo);
            $consulta->bindParam(':color', $color);
            $consulta->bindParam(':material', $material);
            $consulta->bindParam(':dimensiones', $dimensiones);
            $consulta->bindParam(':condicion', $condicion);
            $consulta->bindParam(':custodio_actual', $custodio);
            $consulta->bindParam(':valor_contable', $valor);
            $consulta->bindParam(':id_area_per', $id_area_per);
            $consulta->bindParam(':id_ubi_per', $id_ubi_per);
            $consulta->execute();
            return 0;
        } catch (PDOException $e) {
            error_log('Error en insertarBienes_mobiliarios: ' . $e->getMessage());
            return 2;
        }
    }

    public static function actualizarBienes_mobiliarios($id,$codigo_uta, $nombre, $serie, $id_marca, $modelo, $color, $material, $dimensiones, $condicion, $custodio, $valor, $id_area_per, $id_ubi_per)
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = $conexion->prepare("UPDATE bienes_mobiliarios SET codigo_uta= :codigo_uta, nombre= :nombre, serie= :serie, id_marca= :id_marca,
        modelo= :modelo, color= :color, material= :material, dimensiones= :dimensiones, condicion= :condicion, custodio_actual= :custodio_actual, valor_contable= :valor_contable, 
        id_area_per= :id_area_per, id_ubi_per= :id_ubi_per WHERE id= :id");
            $consulta->bindParam(':id', $id);
            $consulta->bindParam(':codigo_uta', $codigo_uta);
            $consulta->bindParam(':nombre', $nombre);
            $consulta->bindParam(':serie', $serie);
            $consulta->bindParam(':id_marca', $id_marca);
            $consulta->bindParam(':modelo', $modelo);
            $consulta->bindParam(':color', $color);
            $consulta->bindParam(':material', $material);
            $consulta->bindParam(':dimensiones', $dimensiones);
            $consulta->bindParam(':condicion', $condicion);
            $consulta->bindParam(':custodio_actual', $custodio);
            $consulta->bindParam(':valor_contable', $valor);
            $consulta->bindParam(':id_area_per', $id_area_per);
            $consulta->bindParam(':id_ubi_per', $id_ubi_per);
            $consulta->execute();
            return 0;
        } catch (PDOException $e) {
            error_log('Error en actualizarBienes_mobiliarios: ' . $e->getMessage());
            return 2;
        }
    }

    public static function eliminarBienes_mobiliarios($id)
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = $conexion->prepare("UPDATE bienes_mobiliarios set activo= 'no' WHERE id= :id");
            $consulta->bindParam(':id', $id);
            $consulta->execute();
            return 0;
        } catch (PDOException $e) {
            error_log('Error en eliminarBienes_mobiliarios: ' . $e->getMessage());
            return 2;
        }
    }
}
?>