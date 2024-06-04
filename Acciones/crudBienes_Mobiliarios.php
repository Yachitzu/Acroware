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
}
?>