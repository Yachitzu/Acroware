<?php
include_once ("../patrones/Singleton/Conexion.php");
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
                'dato' => $dato,
            ];
        } catch (PDOException $e) {
            error_log('Error al listar Areas: ' . $e->getMessage());
            return [
                'codigo' => 1,
                'mensaje' => 'Error al listar áreas: ' . $e->getMessage()
            ];
        }

    }
}
?>