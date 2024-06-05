<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');
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

        $tabla = '';

        foreach ($dato as $respuesta) {
            $tabla .= '
                <tr>
                    <td>
                        <center>
                        <button class="btn btn-info btn-circle element-white mas" id="mas" data-id="' . htmlspecialchars($respuesta['id']) . '">
                            <i class="fas fa-plus"></i>
                        </button>
                        </center>
                    </td>
                    <td>' . htmlspecialchars($respuesta['codigo_uta']) . '</td>
                    <td>' . htmlspecialchars($respuesta['nombre']) . '</td>
                    <td>' . htmlspecialchars($respuesta['modelo']) . '</td>
                    <td>' . htmlspecialchars($respuesta['nombre_marca']) . '</td>
                    <td class="mdl-data-table__cell">
                        <center>
                        <button class="btn btn-warning btn-circle element-white editar" data-id="' . htmlspecialchars($respuesta['id']) . '">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-circle eliminar" data-id="' . htmlspecialchars($respuesta['id']) . '">
                            <i class="fas fa-trash"></i>
                        </button>
                        </center>
                    </td>
                    <input type="hidden" class="serie" value="' . htmlspecialchars($respuesta['serie']) . '">
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
        error_log('Error al listar bienes informaticos: ' . $e->getMessage());
        return [
            'codigo' => 1,
            'mensaje' => 'Error al listar bienes informaticos: ' . $e->getMessage()
        ];
    }
}

public static function obtenerDetalleBienes_Informaticos($id)
{
    try {
        $conexion = Conexion::getInstance()->getConexion();
        $consulta = $conexion->prepare("SELECT * FROM bienes_informaticos WHERE id = :id");
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
                    <th>Código UTA</th>
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
                <td>' . htmlspecialchars($componente['codigo_adi_uta']) . '</td>
                <td>' . htmlspecialchars($componente['activo']) . '</td>
                <td>
                    <center>
                        <button class="btn btn-warning btn-circle element-white editarComponente" data-id="' . $componente['id'] . '" data-toggle="modal" data-target="#modalCrudEditarComponente">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-circle eliminarComponente" data-id="' . $componente['id'] . '" data-toggle="modal" data-target="#modalCrudEliminarComponente">
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
}
?>