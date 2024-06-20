<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
require 'phpqrcode/qrlib.php';
class AccionesBienes_Informaticos
{
    public static function listarBienes_Informaticos()
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = $conexion->prepare("SELECT bienes_informaticos.*, marcas.nombre AS nombre_marca 
            FROM bienes_informaticos
            LEFT JOIN marcas ON bienes_informaticos.id_marca = marcas.id
            WHERE bienes_informaticos.activo='si'");
            $consulta->execute();
            $dato = $consulta->fetchAll(PDO::FETCH_ASSOC);

            return json_encode([
                'codigo' => 0,
                'datos' => $dato
            ]);
        } catch (PDOException $e) {
            error_log('Error al listar bienes informaticos: ' . $e->getMessage());
            return json_encode([
                'codigo' => 1,
                'mensaje' => 'Error al listar bienes informaticos: ' . $e->getMessage()
            ]);
        }
    }

    public static function obtenerDetalleBienes_Informaticos($id)
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = $conexion->prepare("SELECT bienes_informaticos.*,ubicaciones.nombre AS nombre_ubicacion from bienes_informaticos
            LEFT JOIN ubicaciones ON bienes_informaticos.id_ubi_per = ubicaciones.id where bienes_informaticos.id = :id AND bienes_informaticos.activo='si'");
            $consulta->bindParam(':id', $id);
            $consulta->execute();
            $dato = $consulta->fetch(PDO::FETCH_ASSOC);

            if (!$dato) {
                return [
                    'codigo' => 1,
                    'mensaje' => 'Bien informático no encontrado'
                ];
            }

            // Ajusta el nombre de la columna a la correcta en tu base de datos
            $consultaComponentes = $conexion->prepare("SELECT * FROM componentes WHERE id_bien_infor_per = :id");
            $consultaComponentes->bindParam(':id', $id);
            $consultaComponentes->execute();
            $componentes = $consultaComponentes->fetchAll(PDO::FETCH_ASSOC);

            // Formatear los componentes en una tabla
            $componentsTable = '<table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Serie</th>
                    <th>Especificaciones</th>
                    <th>Repotenciado</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>';

            foreach ($componentes as $componente) {
                $componentsTable .= '<tr>
                <td>' . htmlspecialchars($componente['nombre']) . '</td>
                <td>' . htmlspecialchars($componente['descripcion']) . '</td>
                <td>' . htmlspecialchars($componente['serie']) . '</td>
                <td>' . htmlspecialchars($componente['especificaciones']) . '</td>
                <td>' . htmlspecialchars($componente['repotenciado']) . '</td>
                <td>' . htmlspecialchars($componente['activo']) . '</td>
                <td>
                    <center>
                        <button class="btn btn-warning btn-circle element-white editarComponente" data-id="' . $componente['id'] . '" data-toggle="modal" onclick="showEditarModalComponente(' . $componente['id'] . ')">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-circle eliminarComponente" data-id="' . $componente['id'] . '" data-toggle="modal" onclick="showEliminarModalComponente(' . $componente['id'] . ')" >
                            <i class="fas fa-trash"></i>
                        </button>
                    </center>
                </td>
            </tr>';
            }

            $componentsTable .= '</tbody></table>';

            // Agregar la tabla de componentes al array de datos
            $dato['componentsTable'] = $componentsTable;

            return [
                'codigo' => 0,
                'dato' => $dato,
            ];
        } catch (PDOException $e) {
            error_log('Error al obtener detalle de bienes informaticos: ' . $e->getMessage());
            return [
                'codigo' => 1,
                'mensaje' => 'Error al obtener detalle de bienes informaticos: ' . $e->getMessage()
            ];
        }
    }



    public static function listarMarcasInsertar()
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = "SELECT * from marcas where activo = 'si' AND area='tecnologico'";
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

    public static function insertarBienes_Informaticos($codigo_uta, $nombre, $serie, $id_marca, $modelo, $id_area_per, $id_ubi_per, $ip)
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = $conexion->prepare("INSERT INTO bienes_informaticos(codigo_uta,nombre,serie,id_marca,modelo,id_area_per,id_ubi_per,ip)
        VALUES (:codigo_uta,:nombre,:serie,:id_marca,:modelo,:id_area_per,:id_ubi_per,:ip)");
            $consulta->bindParam(':codigo_uta', $codigo_uta);
            $consulta->bindParam(':nombre', $nombre);
            $consulta->bindParam(':serie', $serie);
            $consulta->bindParam(':id_marca', $id_marca);
            $consulta->bindParam(':modelo', $modelo);
            $consulta->bindParam(':id_area_per', $id_area_per);
            $consulta->bindParam(':id_ubi_per', $id_ubi_per);
            $consulta->bindParam(':ip', $ip);
            $consulta->execute();
            // Obtener el ID del bien informático insertado
            $id_insertado = $conexion->lastInsertId();

            // Generar y guardar el código QR
            /* $qr_path =  */
            self::generarYGuardarQR($id_insertado);
            return 0;
        } catch (PDOException $e) {
            error_log('Error en insertarBienes_Informaticos: ' . $e->getMessage());
            return 2;
        }
    }

    public static function actualizarBienes_Informaticos($id, $codigo_uta, $nombre, $serie, $id_marca, $modelo, $id_area_per, $id_ubi_per, $ip)
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = $conexion->prepare("UPDATE bienes_informaticos SET codigo_uta= :codigo_uta, nombre= :nombre, serie= :serie, id_marca= :id_marca,
        modelo= :modelo, id_area_per= :id_area_per, id_ubi_per= :id_ubi_per, ip= :ip WHERE id= :id");
            $consulta->bindParam(':id', $id);
            $consulta->bindParam(':codigo_uta', $codigo_uta);
            $consulta->bindParam(':nombre', $nombre);
            $consulta->bindParam(':serie', $serie);
            $consulta->bindParam(':id_marca', $id_marca);
            $consulta->bindParam(':modelo', $modelo);
            $consulta->bindParam(':id_area_per', $id_area_per);
            $consulta->bindParam(':id_ubi_per', $id_ubi_per);
            $consulta->bindParam(':ip', $ip);
            $consulta->execute();
            return 0;
        } catch (PDOException $e) {
            error_log('Error en actualizarBienes_Informaticos: ' . $e->getMessage());
            return 2;
        }
    }

    public static function eliminarBienes_Informaticos($id)
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = $conexion->prepare("UPDATE bienes_informaticos set activo= 'no' WHERE id= :id");
            $consulta->bindParam(':id', $id);
            $consulta->execute();
            return 0;
        } catch (PDOException $e) {
            error_log('Error en eliminarBienes_Informaticos: ' . $e->getMessage());
            return 2;
        }
    }

    public static function generarYGuardarQR($id)
    {
        // Directorio donde se guardarán los códigos QR
        $directorio_qr = '../qr/';
        if (!file_exists($directorio_qr)) {
            mkdir($directorio_qr);
        }

        $file_name = $directorio_qr . 'qr_' . $id . '.png';
        $tamanio = 10;
        $level = 'M';
        $frameSize = 3;
        $contenido =  'http://localhost/Acroware/pages/others/QR.php?id=' . $id;
        QRcode::png($contenido, $file_name, $level, $tamanio, $frameSize);
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = $conexion->prepare("UPDATE bienes_informaticos SET qr= :qr WHERE id= :id");
            $consulta->bindParam(':qr', $file_name);
            $consulta->bindParam(':id', $id);
            $consulta->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function listarQR($id)
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = $conexion->prepare("SELECT 
                                                bi.*
                                               
                                            FROM 
                                                bienes_informaticos bi
                                            
                                            WHERE bi.id = :id");
            $consulta->bindParam(':id', $id, PDO::PARAM_INT);
            $consulta->execute();
            $dato = $consulta->fetch(PDO::FETCH_ASSOC);

            if ($dato) {
                return json_encode([
                    'codigo' => 0,
                    'datos' => $dato
                ]);
            } else {
                return json_encode([
                    'codigo' => 1,
                    'mensaje' => 'No se encontró ningún bien informático con el ID proporcionado.'
                ]);
            }
        } catch (PDOException $e) {
            error_log('Error al obtener bien informático: ' . $e->getMessage());
            return json_encode([
                'codigo' => 1,
                'mensaje' => 'Error al obtener bien informático: ' . $e->getMessage()
            ]);
        }
    }
}
