<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
class AccionesBienes_mobiliarios
{
    public static function listarBienes_mobiliarios()
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = $conexion->prepare(
                "SELECT bienes_mobiliarios.*, 
                        marcas.nombre AS nombre_marca, 
                        areas.nombre AS nombre_area,
                        ubicaciones.nombre AS nombre_ubicacion,
                        usuarios.nombre AS nombre_custodio, 
                        usuarios.apellido AS apellido_custodio,
                        bloques.nombre AS nombre_bloque
                        
                FROM bienes_mobiliarios
                LEFT JOIN marcas ON bienes_mobiliarios.id_marca = marcas.id
                LEFT JOIN areas ON bienes_mobiliarios.id_area_per = areas.id
                LEFT JOIN ubicaciones ON bienes_mobiliarios.id_ubi_per = ubicaciones.id
                LEFT JOIN usuarios ON bienes_mobiliarios.custodio_actual = usuarios.id
                LEFT JOIN bloques ON bienes_mobiliarios.id_blo_per = bloques.id
                WHERE bienes_mobiliarios.activo = 'si'"
            );
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
    public static function listarMarcasInsertar()
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = "SELECT * from marcas where activo = 'si' AND area='mobiliario'";
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

    public static function listarUsuariosInsertar()
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            $consulta = "SELECT id, nombre, apellido FROM usuarios WHERE activo = 'si'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $tabla = '';

            foreach ($dato as $respuesta) {
                $nombreCompleto = htmlspecialchars($respuesta['nombre']) . ' ' . htmlspecialchars($respuesta['apellido']);
                $tabla .= '
            <option value="' . htmlspecialchars($respuesta['id']) . '">' . $nombreCompleto . '</option>';
            }

            return [
                'codigo' => 0,
                'dato' => $tabla,
            ];
        } catch (PDOException $e) {
            error_log('Error al listar usuarios: ' . $e->getMessage());
            return [
                'codigo' => 1,
                'mensaje' => 'Error al listar usuarios: ' . $e->getMessage()
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
            // Obtener el bloque_id desde el área
            $consultaArea = $conexion->prepare("SELECT id_bloque_per FROM areas WHERE id = :id_area");
            $consultaArea->bindParam(':id_area', $id_area_per, PDO::PARAM_INT);
            $consultaArea->execute();
            $area = $consultaArea->fetch(PDO::FETCH_ASSOC);

            if (!$area) {
                throw new PDOException("Área no encontrada");
            }

            $bloque_id = $area['id_bloque_per'];
            $consulta = $conexion->prepare("INSERT INTO bienes_mobiliarios(codigo_uta,nombre,serie,id_marca,modelo,color,material,dimensiones,condicion,custodio_actual,valor_contable,id_area_per,id_ubi_per,id_blo_per)
        VALUES (:codigo_uta,:nombre,:serie,:id_marca,:modelo,:color,:material,:dimensiones,:condicion,:custodio_actual,:valor_contable,:id_area_per,:id_ubi_per, :bloqueID)");
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
            $consulta->bindParam(':bloqueID', $bloque_id);
            $consulta->execute();
            return 0;
        } catch (PDOException $e) {
            error_log('Error en insertarBienes_mobiliarios: ' . $e->getMessage());
            return 2;
        }
    }

    public static function actualizarBienes_mobiliarios($id, $codigo_uta, $nombre, $serie, $id_marca, $modelo, $color, $material, $dimensiones, $condicion, $custodio, $valor, $id_area_per, $id_ubi_per)
    {
        try {
            $conexion = Conexion::getInstance()->getConexion();
            // Obtener el bloque_id desde el área
            $consultaArea = $conexion->prepare("SELECT id_bloque_per FROM areas WHERE id = :id_area");
            $consultaArea->bindParam(':id_area', $id_area_per, PDO::PARAM_INT);
            $consultaArea->execute();
            $area = $consultaArea->fetch(PDO::FETCH_ASSOC);

            if (!$area) {
                throw new PDOException("Área no encontrada");
            }

            $bloque_id = $area['id_bloque_per'];
            $consulta = $conexion->prepare("UPDATE bienes_mobiliarios SET codigo_uta= :codigo_uta, nombre= :nombre, serie= :serie, id_marca= :id_marca,
        modelo= :modelo, color= :color, material= :material, dimensiones= :dimensiones, condicion= :condicion, custodio_actual= :custodio_actual, valor_contable= :valor_contable, 
        id_area_per= :id_area_per, id_ubi_per= :id_ubi_per, id_blo_per= :bloqueID WHERE id= :id");
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
            $consulta->bindParam(':bloqueID', $bloque_id);
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