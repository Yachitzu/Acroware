<?php
// Incluimos el archivo de conexión
include_once ($_SERVER['DOCUMENT_ROOT'] . '/Acroware/patrones/Singleton/Conexion.php');

function contarLaboratoristas() {
    try {
        // Obtenemos una instancia de la conexión
        $conexion = Conexion::getInstance()->getConexion();
        
        // Consulta para contar el número de laboratoristas
        $query = "SELECT COUNT(*) as total FROM usuarios WHERE rol = 'laboratorista' AND activo = 'si'";
        $stmt = $conexion->prepare($query);
        $stmt->execute();
        
        // Obtenemos el resultado
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Devolvemos el total
        return $result['total'];
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, 'app_errors.log');
        // Manejo de errores
        return -1; // Retornamos un valor negativo para indicar un error
    }
}

function contarSoftware() {
    try {
        // Obtenemos una instancia de la conexión
        $conexion = Conexion::getInstance()->getConexion();
        
        // Consulta para contar el número de software
        $query = "SELECT COUNT(*) as total FROM software WHERE activado = 'si'";
        $stmt = $conexion->prepare($query);
        $stmt->execute();
        
        // Obtenemos el resultado
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Devolvemos el total
        return $result['total'];
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, 'app_errors.log');
        // Manejo de errores
        return -1; // Retornamos un valor negativo para indicar un error
    }
}

function contarComponentes() {
    try {
        // Obtenemos una instancia de la conexión
        $conexion = Conexion::getInstance()->getConexion();
        
        // Consulta para contar el número de componentes
        $query = "SELECT COUNT(*) as total FROM componentes WHERE activo = 'si'";
        $stmt = $conexion->prepare($query);
        $stmt->execute();
        
        // Obtenemos el resultado
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Devolvemos el total
        return $result['total'];
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, 'app_errors.log');
        // Manejo de errores
        return -1; // Retornamos un valor negativo para indicar un error
    }
}

function contarBienesInformaticos() {
    try {
        // Obtenemos una instancia de la conexión
        $conexion = Conexion::getInstance()->getConexion();
        
        // Consulta para contar el número de bienes informáticos
        $query = "SELECT COUNT(*) as total FROM bienes_informaticos WHERE activo = 'si'";
        $stmt = $conexion->prepare($query);
        $stmt->execute();
        
        // Obtenemos el resultado
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Devolvemos el total
        return $result['total'];
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, 'app_errors.log');
        // Manejo de errores
        return -1; // Retornamos un valor negativo para indicar un error
    }
}

function obtenerBienesMobiliariosRecientes() {
    try {
        // Obtenemos una instancia de la conexión
        $conexion = Conexion::getInstance()->getConexion();

        // Consulta para obtener los últimos 7 registros de bienes mobiliarios
        $query = "SELECT codigo_uta, nombre, modelo, material, id_ubi_per, activo 
                  FROM bienes_mobiliarios
                  ORDER BY fecha_ingreso DESC 
                  LIMIT 7";
        $stmt = $conexion->prepare($query);
        $stmt->execute();

        // Obtenemos el resultado
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, 'app_errors.log');
        // Manejo de errores
        return [];
    }
}

function obtenerRecordatoriosPendientes($usuario_id) {
    try {
        // Obtenemos una instancia de la conexión
        $conexion = Conexion::getInstance()->getConexion();

        // Consulta para obtener los recordatorios pendientes
        $query = "SELECT id, actividad, estado FROM recordatorio WHERE estado = 'pendiente' AND usuario_id = :usuario_id";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();

        // Obtenemos el resultado
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    } catch (PDOException $e) {
        // Manejo de errores: registrar el error en un log para depuración
        error_log($e->getMessage(), 3, 'app_errors.log');

        // Retornar un array vacío para evitar errores
        return [];
    }
}

function obtenerAreasPorBloque($bloqueId) {
    try {
        // Obtenemos una instancia de la conexión
        $conexion = Conexion::getInstance()->getConexion();

        // Consulta SQL para obtener los detalles de las áreas correspondientes al bloque seleccionado
        $queryAreas = "SELECT areas.id, areas.nombre, areas.descripcion, areas.piso, bloques.nombre AS nombre_bloque,
                  (SELECT COUNT(*) FROM ubicaciones WHERE ubicaciones.id_area_per = areas.id) AS total_ubicaciones
                  FROM areas
                  INNER JOIN bloques ON areas.id_bloque_per = bloques.id
                  WHERE areas.id_bloque_per = :bloqueId";

        $stmtAreas = $conexion->prepare($queryAreas);
        $stmtAreas->bindParam(':bloqueId', $bloqueId, PDO::PARAM_INT);
        $stmtAreas->execute();

        $areasPorPiso = array();

        // Verificar si se encontraron áreas
        if ($stmtAreas->rowCount() > 0) {
            // Recorrer los resultados y agregarlos al array $areasPorPiso
            while ($row = $stmtAreas->fetch(PDO::FETCH_ASSOC)) {
                // Usar el valor de piso directamente
                $nombre_piso = $row['piso'];
                if (!isset($areasPorPiso[$nombre_piso])) {
                    $areasPorPiso[$nombre_piso] = array();
                }
                $areasPorPiso[$nombre_piso][] = $row;
            }
        }

        // Consulta SQL para obtener la nueva funcionalidad: áreas agrupadas por encargado y piso
        $queryEncargados = "SELECT 
                                areas.piso, 
                                usuarios.nombre AS encargado, 
                                COUNT(*) AS total_areas 
                            FROM areas 
                            JOIN usuarios ON areas.id_usu_encargado = usuarios.id 
                            WHERE areas.id_bloque_per = :bloqueId 
                            GROUP BY areas.piso, usuarios.nombre";

        $stmtEncargados = $conexion->prepare($queryEncargados);
        $stmtEncargados->bindParam(':bloqueId', $bloqueId, PDO::PARAM_INT);
        $stmtEncargados->execute();

        $areasPorEncargado = array();

        // Recorrer los resultados y agregarlos al array $areasPorEncargado
        while ($row = $stmtEncargados->fetch(PDO::FETCH_ASSOC)) {
            $piso = $row['piso'];
            $encargado = $row['encargado'];
            $total_areas = $row['total_areas'];

            if (!isset($areasPorEncargado[$piso])) {
                $areasPorEncargado[$piso] = [];
            }
            $areasPorEncargado[$piso][] = ['encargado' => $encargado, 'total_areas' => $total_areas];
        }

        // Combinar los datos en un solo array
        $resultado = array(
            'areasPorPiso' => $areasPorPiso,
            'areasPorEncargado' => $areasPorEncargado
        );

        // Devolver los detalles en formato JSON
        return json_encode($resultado);
    } catch (PDOException $e) {
        // Manejo de errores: registrar el error en un log para depuración
        error_log($e->getMessage(), 3, 'app_errors.log');

        // Retornar un array vacío para evitar errores
        return json_encode([]);
    }
}

// Ejemplo de uso de la función para obtener detalles de áreas por bloque
if (isset($_GET['bloque'])) {
    $bloqueId = $_GET['bloque'];
    echo obtenerAreasPorBloque($bloqueId);
}


?>
